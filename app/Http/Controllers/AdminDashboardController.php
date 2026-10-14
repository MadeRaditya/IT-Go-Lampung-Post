<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\TicketLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with(['user', 'category', 'technician'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ticket_code', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('device_name', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($u) use ($search) {
                        $u->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $tickets = $query->paginate(10)->withQueryString();

        $stats = [
            'total'       => Ticket::count(),
            'pending'     => Ticket::where('status', 'pending')->count(),
            'in_progress' => Ticket::where('status', 'in_progress')->count(),
            'resolved'    => Ticket::where('status', 'resolved')->count(),
        ];

        $categories = Category::all();

        return view('admin.dashboard', compact('tickets', 'stats', 'categories'));
    }

    public function show($id)
    {
        $ticket = Ticket::with(['user', 'category', 'technician', 'logs.user'])->findOrFail($id);
        
        $technicians = User::where('role', 'admin')->get();

        return view('admin.show', compact('ticket', 'technicians'));
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $validated = $request->validate([
            'status'      => ['required', 'in:pending,in_progress,resolved,closed'],
            'assigned_to' => ['nullable', 'exists:users,id'],
            'comment'     => ['nullable', 'string'],
        ], [
            'status.required'  => 'Status tiket wajib dipilih.',
            'assigned_to.exists' => 'Teknisi yang dipilih tidak valid.',
        ]);

        $oldStatus = $ticket->status;
        $newStatus = $validated['status'];

        $resolvedAt = ($newStatus === 'resolved' || $newStatus === 'closed') ? now() : $ticket->resolved_at;

        $ticket->update([
            'status'      => $newStatus,
            'assigned_to' => $validated['assigned_to'] ?? $ticket->assigned_to,
            'resolved_at' => $resolvedAt,
        ]);

        TicketLog::create([
            'ticket_id'   => $ticket->id,
            'user_id'     => Auth::id(),
            'status_from' => $oldStatus,
            'status_to'   => $newStatus,
            'comment'     => $validated['comment'] ?? 'Status tiket diperbarui oleh ' . Auth::user()->name,
        ]);

        return redirect()->route('admin.tickets.show', $ticket->id)->with('success', 'Status & data tiket berhasil diperbarui.');
    }
}
