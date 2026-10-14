@extends('layouts.app')

@section('title', 'Daftar Tiket Saya - IT-Go')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-blue-950">Daftar Tiket Laporan Saya</h1>
            <p class="text-slate-500 text-sm">Pantau riwayat dan status penanganan kerusakan komputer Anda secara berkala.</p>
        </div>
        <a href="{{ route('user.tickets.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow-md transition flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Buat Laporan Baru
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        @if($tickets->isEmpty())
            <div class="p-12 text-center">
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Belum Ada Laporan Tiket</h3>
                <p class="text-slate-500 text-sm mt-1">Anda belum pernah membuat laporan kerusakan komputer.</p>
                <a href="{{ route('user.tickets.create') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg text-sm transition">
                    Buat Laporan Pertama
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-600 text-xs uppercase tracking-wider border-b border-slate-200">
                            <th class="py-3 px-4">Kode Tiket</th>
                            <th class="py-3 px-4">Judul & Perangkat</th>
                            <th class="py-3 px-4">Kategori</th>
                            <th class="py-3 px-4">Prioritas</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Teknisi IT</th>
                            <th class="py-3 px-4">Tanggal</th>
                            <th class="py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @foreach($tickets as $ticket)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3 px-4 font-bold text-blue-700">
                                    {{ $ticket->ticket_code }}
                                </td>
                                <td class="py-3 px-4">
                                    <div class="font-semibold text-slate-800">{{ $ticket->title }}</div>
                                    <div class="text-xs text-slate-500">{{ $ticket->device_name }} ({{ $ticket->location }})</div>
                                </td>
                                <td class="py-3 px-4 text-slate-600">
                                    {{ $ticket->category->name }}
                                </td>
                                <td class="py-3 px-4">
                                    @php
                                        $priorityColors = [
                                            'low' => 'bg-slate-100 text-slate-700',
                                            'medium' => 'bg-blue-100 text-blue-700',
                                            'high' => 'bg-orange-100 text-orange-700',
                                            'urgent' => 'bg-red-100 text-red-700 font-bold',
                                        ];
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold capitalize {{ $priorityColors[$ticket->priority] }}">
                                        {{ $ticket->priority }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    @php
                                        $statusBadges = [
                                            'pending' => 'bg-amber-100 text-amber-800 border-amber-300',
                                            'in_progress' => 'bg-blue-100 text-blue-800 border-blue-300',
                                            'resolved' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
                                            'closed' => 'bg-slate-100 text-slate-600 border-slate-300',
                                        ];
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-md text-xs font-semibold border {{ $statusBadges[$ticket->status] }}">
                                        {{ str_replace('_', ' ', strtoupper($ticket->status)) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-slate-600">
                                    {{ $ticket->technician ? $ticket->technician->name : '-' }}
                                </td>
                                <td class="py-3 px-4 text-xs text-slate-500">
                                    {{ $ticket->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <a href="{{ route('user.tickets.show', $ticket->id) }}" class="inline-flex items-center gap-1 text-xs bg-blue-50 text-blue-700 hover:bg-blue-100 font-semibold px-3 py-1.5 rounded-md transition">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="p-4 border-t border-slate-100">
                {{ $tickets->links() }}
            </div>
        @endif
    </div>
</div>
@endsection