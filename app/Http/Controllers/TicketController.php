<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\TicketLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['category', 'technician'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
        
        return view('user.tickets.index', compact('tickets'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('user.tickets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'device_name' => ['required', 'string', 'max:255'],
            'location'    => ['required', 'string', 'max:255'],
            'priority'    => ['required', 'in:low,medium,high,urgent'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'attachment'  => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ], [
            'category_id.required' => 'Pilih kategori kerusakan.',
            'device_name.required' => 'Nama/ID Perangkat wajib diisi.',
            'location.required'    => 'Lokasi perangkat wajib diisi.',
            'priority.required'    => 'Pilih tingkat prioritas.',
            'title.required'       => 'Judul laporan wajib diisi.',
            'description.required' => 'Deskripsi masalah wajib diisi.',
            'attachment.image'     => 'Lampiran harus berupa gambar.',
            'attachment.max'       => 'Ukuran gambar maksimal 2MB.',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('tickets', 'public');
        }

        $today = date('Ymd');
        $countToday = Ticket::whereDate('created_at', now()->toDateString())->count() + 1;
        $ticketCode = 'ITGO-' . $today . '-' . str_pad($countToday, 3, '0', STR_PAD_LEFT);

        $ticket = Ticket::create([
            'ticket_code' => $ticketCode,
            'user_id'     => Auth::id(),
            'category_id' => $validated['category_id'],
            'device_name' => $validated['device_name'],
            'location'    => $validated['location'],
            'priority'    => $validated['priority'],
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'attachment'  => $attachmentPath,
            'status'      => 'pending',
        ]);

        TicketLog::create([
            'ticket_id'   => $ticket->id,
            'user_id'     => Auth::id(),
            'status_from' => null,
            'status_to'   => 'pending',
            'comment'     => 'Tiket laporan kerusakan berhasil dibuat.',
        ]);

        return redirect()->route('user.tickets.index')->with('success', 'Laporan kerusakan berhasil dikirim dengan kode: ' . $ticketCode);
    }

    public function show($id)
    {
        $ticket = Ticket::with(['category', 'technician', 'logs.user'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('user.tickets.show', compact('ticket'));
    }
}
