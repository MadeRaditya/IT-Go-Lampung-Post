@extends('layouts.app')

@section('title', 'Detail Tiket ' . $ticket->ticket_code . ' - IT-Go')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('user.tickets.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center gap-1">
            &larr; Kembali ke Daftar Tiket Saya
        </a>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 mt-2">
            <div>
                <h1 class="text-2xl font-bold text-blue-950 flex items-center gap-3">
                    {{ $ticket->title }}
                    <span class="text-sm px-3 py-1 bg-blue-100 text-blue-800 rounded-full font-mono font-semibold">
                        {{ $ticket->ticket_code }}
                    </span>
                </h1>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 space-y-4">
                <h3 class="text-base font-bold text-slate-800 border-b border-slate-100 pb-3">Rincian Laporan Kerusakan</h3>
                
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-slate-400 block text-xs uppercase font-semibold">Kategori</span>
                        <span class="font-medium text-slate-800">{{ $ticket->category->name }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-xs uppercase font-semibold">Perangkat & Lokasi</span>
                        <span class="font-medium text-slate-800">{{ $ticket->device_name }} ({{ $ticket->location }})</span>
                    </div>
                </div>

                <div>
                    <span class="text-slate-400 block text-xs uppercase font-semibold mb-1">Deskripsi Permasalahan</span>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-slate-700 whitespace-pre-line text-sm leading-relaxed">
                        {{ $ticket->description }}
                    </div>
                </div>

                @if($ticket->attachment)
                    <div>
                        <span class="text-slate-400 block text-xs uppercase font-semibold mb-2">Foto / Bukti Kerusakan</span>
                        <a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank" class="inline-block group">
                            <img src="{{ asset('storage/' . $ticket->attachment) }}" alt="Bukti Kerusakan" class="w-48 h-36 object-cover rounded-xl border border-slate-200 shadow-sm group-hover:opacity-90 transition">
                            <span class="text-xs text-blue-600 group-hover:underline mt-1 block">Klik untuk memperbesar</span>
                        </a>
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-base font-bold text-slate-800 border-b border-slate-100 pb-3 mb-4">Riwayat Progres Penanganan</h3>
                
                <div class="space-y-4 relative before:absolute before:inset-0 before:left-3.5 before:w-0.5 before:bg-slate-200">
                    @foreach($ticket->logs as $log)
                        <div class="relative flex gap-4 items-start pl-8">
                            <div class="absolute left-1.5 top-1.5 w-4 h-4 rounded-full bg-blue-600 border-2 border-white ring-2 ring-blue-100"></div>
                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 w-full">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="font-semibold text-slate-800 text-sm">{{ $log->user->name }}</span>
                                    <span class="text-xs text-slate-400">{{ $log->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                <div class="text-xs text-blue-700 font-semibold mb-1">
                                    Status: {{ strtoupper(str_replace('_', ' ', $log->status_to)) }}
                                </div>
                                @if($log->comment)
                                    <p class="text-sm text-slate-600 mt-1">{{ $log->comment }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 space-y-4">
                <h3 class="text-base font-bold text-slate-800 border-b border-slate-100 pb-3">Status Laporan</h3>

                <div>
                    <span class="text-slate-400 block text-xs uppercase font-semibold">Status Saat Ini</span>
                    <span class="inline-block mt-1 px-3 py-1 rounded-md text-xs font-bold border 
                        {{ $ticket->status === 'pending' ? 'bg-amber-100 text-amber-800 border-amber-300' : '' }}
                        {{ $ticket->status === 'in_progress' ? 'bg-blue-100 text-blue-800 border-blue-300' : '' }}
                        {{ $ticket->status === 'resolved' ? 'bg-emerald-100 text-emerald-800 border-emerald-300' : '' }}
                        {{ $ticket->status === 'closed' ? 'bg-slate-100 text-slate-600 border-slate-300' : '' }}">
                        {{ strtoupper(str_replace('_', ' ', $ticket->status)) }}
                    </span>
                </div>

                <div>
                    <span class="text-slate-400 block text-xs uppercase font-semibold">Teknisi IT Penanggung Jawab</span>
                    <p class="font-medium text-slate-800 text-sm mt-0.5">
                        {{ $ticket->technician ? $ticket->technician->name : 'Belum ditugaskan' }}
                    </p>
                </div>

                <div>
                    <span class="text-slate-400 block text-xs uppercase font-semibold">Tingkat Urgensi</span>
                    <span class="capitalize font-semibold text-sm text-slate-700">{{ $ticket->priority }}</span>
                </div>

                <div>
                    <span class="text-slate-400 block text-xs uppercase font-semibold">Tanggal Dibuat</span>
                    <p class="text-sm text-slate-700">{{ $ticket->created_at->format('d M Y, H:i') }} WIB</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection