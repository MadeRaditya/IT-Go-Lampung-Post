@extends('layouts.app')

@section('title', 'Daftar Tiket Saya - IT-Go')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        {{-- Header Bar --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-[#10172a] p-5 sm:p-7 rounded-2xl border border-[#1e293b] shadow-xs">
            <div>
                <div class="flex items-center gap-2 mb-1.5">
                    <span class="px-2.5 py-0.5 rounded-md text-[11px] font-bold uppercase tracking-wider bg-blue-950/60 text-blue-400 border border-blue-800/60">
                        Tiket Pribadi
                    </span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold text-white tracking-tight">Daftar Tiket Laporan Saya</h1>
                <p class="text-slate-400 text-xs sm:text-sm mt-0.5">Pantau status pengerjaan perbaikan komputer dan perangkat kantor Anda.</p>
            </div>
            <a href="{{ route('user.tickets.create') }}"
                class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-500 text-white font-semibold px-4 py-2.5 rounded-xl text-xs sm:text-sm transition shadow-sm shadow-blue-500/25 shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                Buat Laporan Baru
            </a>
        </div>

        @if (!$tickets->isEmpty())
            <div class="flex items-center justify-between text-xs text-slate-400 px-1">
                <span>Menampilkan <strong class="text-white font-semibold">{{ $tickets->count() }}</strong> dari <strong class="text-white font-semibold">{{ $tickets->total() }}</strong> tiket</span>
                <span class="hidden sm:inline-flex items-center gap-1.5 text-slate-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Tim IT aktif melayani
                </span>
            </div>
        @endif

        {{-- Main Table / Mobile Card Container --}}
        <div class="bg-[#10172a] rounded-2xl border border-[#1e293b] shadow-xs overflow-hidden">
            @if ($tickets->isEmpty())
                <div class="py-14 px-4 text-center max-w-sm mx-auto">
                    <div class="w-12 h-12 bg-[#162036] text-slate-400 rounded-xl flex items-center justify-center mx-auto mb-3 border border-[#1e293b]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-white">Belum Ada Tiket Kendala</h3>
                    <p class="text-slate-400 text-xs mt-1 leading-relaxed">
                        Saat ini Anda belum memiliki tiket laporan kerusakan yang tercatat.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('user.tickets.create') }}"
                            class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-500 text-white font-semibold px-4 py-2 rounded-xl text-xs transition shadow-sm shadow-blue-500/20">
                            Buat Laporan Sekarang
                        </a>
                    </div>
                </div>
            @else
                {{-- Desktop View --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#0d1527] text-slate-400 text-[11px] font-semibold uppercase tracking-wider border-b border-[#1e293b]">
                                <th class="py-3.5 px-5">Kode</th>
                                <th class="py-3.5 px-5">Kendala & Perangkat</th>
                                <th class="py-3.5 px-5">Kategori</th>
                                <th class="py-3.5 px-5">Urgensi</th>
                                <th class="py-3.5 px-5">Status</th>
                                <th class="py-3.5 px-5">Teknisi</th>
                                <th class="py-3.5 px-5">Waktu Lapor</th>
                                <th class="py-3.5 px-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#1e293b] text-xs sm:text-sm">
                            @foreach ($tickets as $ticket)
                                @php
                                    $pMap = [
                                        'low' => ['label' => 'Rendah', 'dot' => 'bg-slate-400', 'badge' => 'bg-slate-800 text-slate-300 border-slate-700'],
                                        'medium' => ['label' => 'Sedang', 'dot' => 'bg-blue-400', 'badge' => 'bg-blue-950/50 text-blue-300 border-blue-800/60'],
                                        'high' => ['label' => 'Tinggi', 'dot' => 'bg-orange-400', 'badge' => 'bg-orange-950/50 text-orange-300 border-orange-800/60'],
                                        'urgent' => ['label' => 'Darurat', 'dot' => 'bg-rose-400', 'badge' => 'bg-rose-950/50 text-rose-300 border-rose-800/60 font-bold'],
                                    ];
                                    $currP = $pMap[$ticket->priority] ?? ['label' => $ticket->priority, 'dot' => 'bg-slate-400', 'badge' => 'bg-slate-800 text-slate-300 border-slate-700'];
                                @endphp
                                <tr class="hover:bg-[#162036]/60 transition">
                                    <td class="py-3.5 px-5 font-mono font-bold whitespace-nowrap">
                                        <span class="bg-[#162036] px-2.5 py-1 rounded text-xs text-blue-300 border border-blue-900/60">
                                            {{ $ticket->ticket_code }}
                                        </span>
                                    </td>

                                    <td class="py-3.5 px-5 max-w-xs">
                                        <a href="{{ route('user.tickets.show', $ticket->id) }}"
                                            class="font-semibold text-white hover:text-blue-400 transition block leading-snug">
                                            {{ $ticket->title }}
                                        </a>
                                        <div class="text-[11px] text-slate-500 mt-0.5">
                                            {{ $ticket->device_name }} • {{ $ticket->location }}
                                        </div>
                                    </td>

                                    <td class="py-3.5 px-5 text-xs text-slate-300 whitespace-nowrap">
                                        {{ $ticket->category->name }}
                                    </td>

                                    <td class="py-3.5 px-5 whitespace-nowrap">
                                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-xs border {{ $currP['badge'] }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $currP['dot'] }}"></span>
                                            {{ $currP['label'] }}
                                        </span>
                                    </td>

                                    <td class="py-3.5 px-5 whitespace-nowrap">
                                        @if ($ticket->status === 'pending')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-medium bg-amber-950/40 text-amber-300 border border-amber-800/50">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span> Menunggu IT
                                            </span>
                                        @elseif($ticket->status === 'in_progress')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-medium bg-blue-950/50 text-blue-300 border border-blue-800/60">
                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span> Dikerjakan
                                            </span>
                                        @elseif($ticket->status === 'resolved')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-medium bg-emerald-950/40 text-emerald-300 border border-emerald-800/50">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Selesai
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-medium bg-slate-800 text-slate-300 border border-slate-700">
                                                Ditutup
                                            </span>
                                        @endif
                                    </td>

                                    <td class="py-3.5 px-5 text-xs text-slate-300 whitespace-nowrap">
                                        @if ($ticket->technician)
                                            <span class="font-medium text-slate-200">{{ $ticket->technician->name }}</span>
                                        @else
                                            <span class="text-slate-500 italic">Antrian</span>
                                        @endif
                                    </td>

                                    <td class="py-3.5 px-5 text-xs text-slate-400 whitespace-nowrap">
                                        {{ $ticket->created_at->format('d M Y') }}
                                        <span class="block text-[11px] text-slate-500">{{ $ticket->created_at->format('H:i') }} WIB</span>
                                    </td>

                                    <td class="py-3.5 px-5 text-right whitespace-nowrap">
                                        <a href="{{ route('user.tickets.show', $ticket->id) }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-[#162036] hover:bg-blue-600 text-slate-200 hover:text-white font-semibold text-xs transition border border-[#1e293b]">
                                            Rincian &rarr;
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Mobile Card View (< md screens) --}}
                <div class="block md:hidden divide-y divide-[#1e293b]">
                    @foreach ($tickets as $ticket)
                        @php
                            $pMap = [
                                'low' => ['label' => 'Rendah', 'dot' => 'bg-slate-400', 'badge' => 'bg-slate-800 text-slate-300 border-slate-700'],
                                'medium' => ['label' => 'Sedang', 'dot' => 'bg-blue-400', 'badge' => 'bg-blue-950/50 text-blue-300 border-blue-800/60'],
                                'high' => ['label' => 'Tinggi', 'dot' => 'bg-orange-400', 'badge' => 'bg-orange-950/50 text-orange-300 border-orange-800/60'],
                                'urgent' => ['label' => 'Darurat', 'dot' => 'bg-rose-400', 'badge' => 'bg-rose-950/50 text-rose-300 border-rose-800/60 font-bold'],
                            ];
                            $currP = $pMap[$ticket->priority] ?? ['label' => $ticket->priority, 'dot' => 'bg-slate-400', 'badge' => 'bg-slate-800 text-slate-300 border-slate-700'];
                        @endphp
                        <div class="p-4 space-y-2.5">
                            <div class="flex items-center justify-between gap-2">
                                <span class="font-mono text-xs font-bold bg-[#162036] px-2 py-0.5 rounded border border-blue-900/60 text-blue-300">
                                    {{ $ticket->ticket_code }}
                                </span>
                                <div class="flex items-center gap-1.5">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] border {{ $currP['badge'] }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $currP['dot'] }}"></span>
                                        {{ $currP['label'] }}
                                    </span>
                                    @if ($ticket->status === 'pending')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-medium bg-amber-950/40 text-amber-300 border border-amber-800/50">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span> Menunggu
                                        </span>
                                    @elseif($ticket->status === 'in_progress')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-medium bg-blue-950/50 text-blue-300 border border-blue-800/60">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span> Proses
                                        </span>
                                    @elseif($ticket->status === 'resolved')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-medium bg-emerald-950/40 text-emerald-300 border border-emerald-800/50">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Selesai
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-medium bg-slate-800 text-slate-300 border border-slate-700">
                                            Tutup
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <h3 class="font-bold text-white text-sm leading-snug">
                                    <a href="{{ route('user.tickets.show', $ticket->id) }}" class="hover:text-blue-400">
                                        {{ $ticket->title }}
                                    </a>
                                </h3>
                                <p class="text-xs text-slate-400 mt-0.5">
                                    {{ $ticket->device_name }} • {{ $ticket->location }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-2 border-t border-[#1e293b] text-xs">
                                <div class="text-slate-400 text-[11px]">
                                    Teknisi: <strong class="text-slate-200 font-medium">{{ $ticket->technician ? $ticket->technician->name : 'Menunggu antrian' }}</strong>
                                </div>
                                <a href="{{ route('user.tickets.show', $ticket->id) }}"
                                    class="bg-blue-600 hover:bg-blue-500 text-white font-semibold px-3 py-1.5 rounded-lg text-xs transition">
                                    Lihat Rincian &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="p-3.5 sm:p-5 border-t border-[#1e293b]">
                    {{ $tickets->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
