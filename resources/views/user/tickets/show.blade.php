@extends('layouts.app')

@section('title', 'Detail Tiket ' . $ticket->ticket_code . ' - IT-Go')

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        {{-- Navigation & Title Header --}}
        <div>
            <a href="{{ route('user.tickets.index') }}"
                class="inline-flex items-center gap-1.5 text-slate-400 hover:text-white text-xs font-semibold uppercase tracking-wider transition mb-2">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Tiket Saya
            </a>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mt-1">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-white tracking-tight flex flex-wrap items-center gap-2">
                        {{ $ticket->title }}
                        <span class="text-xs px-2.5 py-0.5 bg-[#162036] text-blue-300 border border-blue-900/60 rounded font-mono font-bold">
                            {{ $ticket->ticket_code }}
                        </span>
                    </h1>
                    <p class="text-slate-400 text-xs sm:text-sm mt-0.5">
                        Dilaporkan: {{ $ticket->created_at->format('d F Y, H:i') }} WIB • Ruangan: <strong class="text-slate-200">{{ $ticket->location }}</strong>
                    </p>
                </div>

                <div class="shrink-0">
                    @if ($ticket->status === 'pending')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-amber-950/40 text-amber-300 border border-amber-800/50">
                            <span class="w-2 h-2 rounded-full bg-amber-400"></span> Menunggu Penanganan
                        </span>
                    @elseif($ticket->status === 'in_progress')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-blue-950/50 text-blue-300 border border-blue-800/60">
                            <span class="w-2 h-2 rounded-full bg-blue-400"></span> Sedang Dikerjakan
                        </span>
                    @elseif($ticket->status === 'resolved')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-emerald-950/40 text-emerald-300 border border-emerald-800/50">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span> Selesai Diperbaiki
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-slate-800 text-slate-300 border border-slate-700">
                            Tiket Ditutup
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Progress Timeline --}}
        <div class="bg-[#10172a] rounded-2xl p-5 sm:p-6 border border-[#1e293b] shadow-xs">
            <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400 block mb-4">Tahapan Perbaikan:</span>

            @php
                $currentStep = match ($ticket->status) {
                    'pending' => 1,
                    'in_progress' => 2,
                    'resolved' => 3,
                    'closed' => 4,
                    default => 1,
                };
            @endphp

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
                {{-- Step 1 --}}
                <div class="flex items-center sm:flex-col sm:text-center gap-2.5">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg flex items-center justify-center font-bold text-xs shrink-0 {{ $currentStep >= 1 ? 'bg-blue-600 text-white' : 'bg-[#162036] text-slate-500' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-white leading-tight">1. Laporan Masuk</h4>
                        <p class="text-[11px] text-slate-400">Antrian IT</p>
                    </div>
                </div>

                {{-- Step 2 --}}
                <div class="flex items-center sm:flex-col sm:text-center gap-2.5">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg flex items-center justify-center font-bold text-xs shrink-0 {{ $currentStep >= 2 ? 'bg-blue-600 text-white' : 'bg-[#162036] text-slate-500' }}">
                        @if ($currentStep >= 2)
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                        @else
                            2
                        @endif
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-white leading-tight">2. Penanganan</h4>
                        <p class="text-[11px] text-slate-400">Pemeriksaan teknisi</p>
                    </div>
                </div>

                {{-- Step 3 --}}
                <div class="flex items-center sm:flex-col sm:text-center gap-2.5">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg flex items-center justify-center font-bold text-xs shrink-0 {{ $currentStep >= 3 ? 'bg-emerald-600 text-white' : 'bg-[#162036] text-slate-500' }}">
                        @if ($currentStep >= 3)
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                        @else
                            3
                        @endif
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-white leading-tight">3. Selesai</h4>
                        <p class="text-[11px] text-slate-400">Perangkat normal</p>
                    </div>
                </div>

                {{-- Step 4 --}}
                <div class="flex items-center sm:flex-col sm:text-center gap-2.5">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg flex items-center justify-center font-bold text-xs shrink-0 {{ $currentStep >= 4 ? 'bg-slate-700 text-white' : 'bg-[#162036] text-slate-500' }}">
                        @if ($currentStep >= 4)
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                        @else
                            4
                        @endif
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-white leading-tight">4. Ditutup</h4>
                        <p class="text-[11px] text-slate-400">Selesai terverifikasi</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                {{-- Detail Box --}}
                <div class="bg-[#10172a] rounded-2xl border border-[#1e293b] shadow-xs p-5 sm:p-6 space-y-5">
                    <div class="flex items-center justify-between border-b border-[#1e293b] pb-3">
                        <h3 class="text-sm font-bold text-white">Rincian Informasi Kendala</h3>
                        <span class="text-xs text-slate-400">{{ $ticket->created_at->diffForHumans() }}</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 bg-[#0a0f1d] p-4 rounded-xl border border-[#1e293b] text-xs">
                        <div>
                            <span class="text-slate-400 block text-[11px] uppercase font-semibold mb-0.5">Kategori</span>
                            <span class="font-bold text-blue-400">{{ $ticket->category->name }}</span>
                        </div>

                        <div>
                            <span class="text-slate-400 block text-[11px] uppercase font-semibold mb-0.5">Perangkat</span>
                            <span class="font-bold text-white">{{ $ticket->device_name }}</span>
                        </div>

                        <div>
                            <span class="text-slate-400 block text-[11px] uppercase font-semibold mb-0.5">Lokasi Ruangan</span>
                            <span class="font-medium text-slate-200">{{ $ticket->location }}</span>
                        </div>

                        <div>
                            <span class="text-slate-400 block text-[11px] uppercase font-semibold mb-0.5">Urgensi</span>
                            @php
                                $pMap = [
                                    'low' => ['label' => 'Rendah (Pekerjaan normal)', 'dot' => 'bg-slate-400'],
                                    'medium' => ['label' => 'Sedang (Ada alternatif)', 'dot' => 'bg-blue-400'],
                                    'high' => ['label' => 'Tinggi (Terganggu)', 'dot' => 'bg-orange-400'],
                                    'urgent' => ['label' => 'Darurat (Sistem mati)', 'dot' => 'bg-rose-400'],
                                ];
                                $currP = $pMap[$ticket->priority] ?? ['label' => $ticket->priority, 'dot' => 'bg-slate-400'];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 font-medium text-slate-200">
                                <span class="w-1.5 h-1.5 rounded-full {{ $currP['dot'] }}"></span>
                                {{ $currP['label'] }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <span class="text-slate-400 block text-[11px] uppercase font-semibold mb-1">Deskripsi Kendala</span>
                        <div class="bg-[#0a0f1d] p-4 rounded-xl border border-[#1e293b] text-slate-200 whitespace-pre-line text-xs sm:text-sm leading-relaxed">
                            {{ $ticket->description }}
                        </div>
                    </div>

                    @if ($ticket->attachment)
                        <div>
                            <span class="text-slate-400 block text-[11px] uppercase font-semibold mb-1.5">Lampiran Bukti</span>
                            <a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank" class="inline-block group">
                                <div class="relative overflow-hidden rounded-xl border border-[#1e293b] max-w-xs">
                                    <img src="{{ asset('storage/' . $ticket->attachment) }}" alt="Bukti Kendala"
                                        class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-200">
                                    <div class="absolute inset-0 bg-slate-950/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold">
                                        Klik untuk perbesar
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Activity Logs --}}
                <div class="bg-[#10172a] rounded-2xl border border-[#1e293b] shadow-xs p-5 sm:p-6">
                    <h3 class="text-sm font-bold text-white border-b border-[#1e293b] pb-3 mb-4">
                        Riwayat & Catatan IT Support
                    </h3>

                    <div class="space-y-3">
                        @forelse($ticket->logs as $log)
                            <div class="bg-[#0a0f1d] rounded-xl p-4 border border-[#1e293b]">
                                <div class="flex items-center justify-between mb-1.5">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-md bg-blue-600 text-white font-bold text-[10px] flex items-center justify-center">
                                            {{ strtoupper(substr($log->user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <span class="font-bold text-white text-xs">{{ $log->user->name }}</span>
                                            <span class="text-[10px] text-slate-400 block">{{ $log->user->role === 'admin' ? 'Teknisi IT Support' : 'Karyawan Pelapor' }}</span>
                                        </div>
                                    </div>
                                    <span class="text-[11px] text-slate-500">{{ $log->created_at->format('d M, H:i') }} WIB</span>
                                </div>

                                <div class="text-[10px] font-bold uppercase tracking-wider text-blue-300 bg-[#162036] px-2 py-0.5 rounded border border-blue-900/40 inline-block mb-1.5">
                                    Status: {{ str_replace('_', ' ', strtoupper($log->status_to)) }}
                                </div>

                                @if ($log->comment)
                                    <div class="text-xs text-slate-300 bg-[#10172a] p-3 rounded-lg border border-[#1e293b] leading-relaxed">
                                        {{ $log->comment }}
                                    </div>
                                @endif
                            </div>
                        @empty
                            <p class="text-xs text-slate-500 italic">Belum ada riwayat aktivitas tercatat.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-4">
                {{-- Teknisi Card --}}
                <div class="bg-[#10172a] rounded-2xl border border-[#1e293b] shadow-xs p-5 space-y-3">
                    <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400 block pb-2 border-b border-[#1e293b]">
                        Teknisi Penanggung Jawab
                    </span>

                    @if ($ticket->technician)
                        <div class="flex items-center gap-3 pt-1">
                            <div class="w-10 h-10 rounded-xl bg-blue-600 text-white font-bold text-sm flex items-center justify-center shadow-sm shadow-blue-500/30">
                                {{ strtoupper(substr($ticket->technician->name, 0, 2)) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-white text-sm">{{ $ticket->technician->name }}</h4>
                                <p class="text-xs text-slate-400">Tim IT Support Kantor</p>
                                <span class="inline-flex items-center gap-1 text-[10px] text-emerald-400 font-semibold mt-0.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Aktif Ditugaskan
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="p-3.5 bg-[#0a0f1d] rounded-xl border border-[#1e293b] text-center">
                            <p class="text-xs font-semibold text-slate-300">Menunggu Penugasan</p>
                            <p class="text-[11px] text-slate-500 mt-0.5">Admin IT sedang mengalokasikan teknisi ke ruangan kerja Anda.</p>
                        </div>
                    @endif
                </div>

                {{-- Contact Support Box --}}
                <div class="bg-[#0d1527] text-white rounded-2xl p-5 border border-blue-900/50 shadow-xs space-y-3">
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-blue-950/60 text-blue-400 border border-blue-800/60 inline-block">
                        Bantuan Langsung
                    </span>
                    <h4 class="text-sm font-bold text-white">Butuh Konfirmasi Cepat?</h4>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Sebutkan kode tiket <strong class="text-blue-400 font-mono">{{ $ticket->ticket_code }}</strong> saat menghubungi extension telepon IT.
                    </p>

                    <div class="pt-3 border-t border-[#1e293b] space-y-1.5 text-xs">
                        <div class="flex items-center justify-between text-slate-300">
                            <span>Extension:</span>
                            <strong class="text-blue-400 font-mono">Ext. 108</strong>
                        </div>
                        <div class="flex items-center justify-between text-slate-300">
                            <span>Ruangan IT:</span>
                            <span class="text-slate-200">Lantai 2 Sayap Barat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
