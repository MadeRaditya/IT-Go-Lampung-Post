@extends('layouts.app')

@section('title', 'Dashboard Kelola Tiket IT - IT-Go Enterprise')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 sm:space-y-8">
        {{-- Header Section --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-[#10172a] p-5 sm:p-7 rounded-2xl border border-[#1e293b] shadow-xs">
            <div>
                <div class="flex items-center gap-2 mb-1.5">
                    <span class="px-2.5 py-0.5 rounded-md text-[11px] font-bold uppercase tracking-wider bg-blue-950/60 text-blue-400 border border-blue-800/60">
                        Helpdesk Management
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[11px] font-medium bg-emerald-950/60 text-emerald-400 border border-emerald-800/60">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Layanan Aktif
                    </span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold text-white tracking-tight">Pusat Kelola Laporan Kerusakan</h1>
                <p class="text-slate-400 text-xs sm:text-sm mt-0.5">Kelola antrian perbaikan, tugaskan teknisi, dan pantau penyelesaian kendala IT kantor.</p>
            </div>
            <div class="text-xs text-slate-400 font-medium sm:text-right pt-2 sm:pt-0 border-t sm:border-t-0 border-[#1e293b]">
                <span>Login: <strong class="text-white">{{ auth()->user()->name }}</strong></span>
                <span class="block text-[11px] text-slate-500 mt-0.5">{{ now()->translatedFormat('l, d F Y') }}</span>
            </div>
        </div>

        {{-- KPI Metrics Grid --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            {{-- Total Laporan --}}
            <div class="bg-[#10172a] p-4 sm:p-5 rounded-2xl border border-[#1e293b] shadow-xs transition hover:border-blue-500/40">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-400">Total Tiket</span>
                    <div class="w-8 h-8 rounded-lg bg-[#162036] text-blue-400 border border-blue-900/40 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
                <div class="mt-2.5">
                    <p class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">{{ $stats['total'] }}</p>
                    <p class="text-[11px] text-slate-500 mt-0.5">Semua laporan masuk</p>
                </div>
            </div>

            {{-- Pending --}}
            <a href="{{ route('admin.dashboard', ['status' => 'pending']) }}"
                class="bg-[#10172a] p-4 sm:p-5 rounded-2xl border border-[#1e293b] shadow-xs transition hover:border-amber-500/50 block group">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-amber-400">Menunggu</span>
                    <div class="w-8 h-8 rounded-lg bg-amber-950/40 text-amber-400 border border-amber-800/40 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-2.5">
                    <p class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">{{ $stats['pending'] }}</p>
                    <p class="text-[11px] text-amber-400 mt-0.5 flex items-center justify-between">
                        <span>Perlu respon teknisi</span>
                        <span class="group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                    </p>
                </div>
            </a>

            {{-- In Progress --}}
            <a href="{{ route('admin.dashboard', ['status' => 'in_progress']) }}"
                class="bg-[#10172a] p-4 sm:p-5 rounded-2xl border border-[#1e293b] shadow-xs transition hover:border-blue-500/50 block group">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-blue-400">Dikerjakan</span>
                    <div class="w-8 h-8 rounded-lg bg-blue-950/40 text-blue-400 border border-blue-800/40 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-2.5">
                    <p class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">{{ $stats['in_progress'] }}</p>
                    <p class="text-[11px] text-blue-400 mt-0.5 flex items-center justify-between">
                        <span>Sedang ditangani</span>
                        <span class="group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                    </p>
                </div>
            </a>

            {{-- Resolved --}}
            <a href="{{ route('admin.dashboard', ['status' => 'resolved']) }}"
                class="bg-[#10172a] p-4 sm:p-5 rounded-2xl border border-[#1e293b] shadow-xs transition hover:border-emerald-500/50 block group">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-emerald-400">Selesai</span>
                    <div class="w-8 h-8 rounded-lg bg-emerald-950/40 text-emerald-400 border border-emerald-800/40 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-2.5">
                    <p class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">{{ $stats['resolved'] }}</p>
                    <p class="text-[11px] text-emerald-400 mt-0.5 flex items-center justify-between">
                        <span>Perangkat normal</span>
                        <span class="group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                    </p>
                </div>
            </a>
        </div>

        {{-- Filters & Search Section --}}
        <div class="bg-[#10172a] rounded-2xl border border-[#1e293b] shadow-xs p-4 sm:p-5 space-y-4">
            {{-- Quick Filter Pills --}}
            <div class="flex items-center gap-1.5 sm:gap-2 overflow-x-auto pb-2 border-b border-[#1e293b] text-xs no-scrollbar">
                <span class="text-slate-400 font-semibold uppercase tracking-wider text-[11px] shrink-0 mr-1">Status:</span>
                <a href="{{ route('admin.dashboard') }}"
                    class="px-3 py-1.5 rounded-lg font-medium transition shrink-0 {{ !request('status') ? 'bg-blue-600 text-white shadow-sm shadow-blue-500/20' : 'bg-[#162036] text-slate-300 hover:bg-[#1e293b] border border-[#1e293b]' }}">
                    Semua ({{ $stats['total'] }})
                </a>
                <a href="{{ route('admin.dashboard', array_merge(request()->query(), ['status' => 'pending'])) }}"
                    class="px-3 py-1.5 rounded-lg font-medium transition shrink-0 inline-flex items-center gap-1.5 {{ request('status') === 'pending' ? 'bg-amber-600 text-white' : 'bg-amber-950/30 text-amber-300 hover:bg-amber-900/40 border border-amber-800/50' }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ request('status') === 'pending' ? 'bg-white' : 'bg-amber-400' }}"></span>
                    Menunggu ({{ $stats['pending'] }})
                </a>
                <a href="{{ route('admin.dashboard', array_merge(request()->query(), ['status' => 'in_progress'])) }}"
                    class="px-3 py-1.5 rounded-lg font-medium transition shrink-0 inline-flex items-center gap-1.5 {{ request('status') === 'in_progress' ? 'bg-blue-600 text-white' : 'bg-blue-950/30 text-blue-300 hover:bg-blue-900/40 border border-blue-800/50' }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ request('status') === 'in_progress' ? 'bg-white' : 'bg-blue-400' }}"></span>
                    Dikerjakan ({{ $stats['in_progress'] }})
                </a>
                <a href="{{ route('admin.dashboard', array_merge(request()->query(), ['status' => 'resolved'])) }}"
                    class="px-3 py-1.5 rounded-lg font-medium transition shrink-0 inline-flex items-center gap-1.5 {{ request('status') === 'resolved' ? 'bg-emerald-600 text-white' : 'bg-emerald-950/30 text-emerald-300 hover:bg-emerald-900/40 border border-emerald-800/50' }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ request('status') === 'resolved' ? 'bg-white' : 'bg-emerald-400' }}"></span>
                    Selesai ({{ $stats['resolved'] }})
                </a>
            </div>

            {{-- Detailed Filter Form --}}
            <form method="GET" action="{{ route('admin.dashboard') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                <div>
                    <label class="block text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Cari Tiket / Pelapor</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Kode, masalah, atau pelapor..."
                            class="w-full pl-9 pr-3 py-2 bg-[#0a0f1d] border border-[#1e293b] rounded-xl text-xs sm:text-sm font-medium text-slate-200 placeholder-slate-500 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition">
                        <svg class="w-4 h-4 text-slate-500 absolute left-2.5 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Filter Status</label>
                    <select name="status"
                        class="w-full px-3 py-2 bg-[#0a0f1d] border border-[#1e293b] rounded-xl text-xs sm:text-sm font-medium text-slate-200 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu (Pending)</option>
                        <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>Sedang Dikerjakan (In Progress)</option>
                        <option value="resolved" {{ request('status') === 'resolved' ? 'selected' : '' }}>Selesai (Resolved)</option>
                        <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Ditutup (Closed)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Kategori</label>
                    <select name="category_id"
                        class="w-full px-3 py-2 bg-[#0a0f1d] border border-[#1e293b] rounded-xl text-xs sm:text-sm font-medium text-slate-200 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end gap-2 pt-1 sm:pt-0">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-3 rounded-xl text-xs sm:text-sm transition shadow-sm shadow-blue-500/20">
                        Terapkan
                    </button>
                    <a href="{{ route('admin.dashboard') }}"
                        class="px-3 py-2 border border-[#1e293b] text-slate-300 font-medium hover:bg-[#162036] rounded-xl text-xs sm:text-sm transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- Content Table & Mobile Cards --}}
        <div class="bg-[#10172a] rounded-2xl border border-[#1e293b] shadow-xs overflow-hidden">
            @if ($tickets->isEmpty())
                <div class="py-14 px-4 text-center max-w-sm mx-auto">
                    <div class="w-12 h-12 bg-[#162036] text-slate-400 rounded-xl flex items-center justify-center mx-auto mb-3 border border-[#1e293b]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-white">Tidak Ada Tiket Ditemukan</h3>
                    <p class="text-slate-400 text-xs mt-1 leading-relaxed">
                        Tidak ada tiket yang sesuai kriteria pencarian atau filter saat ini.
                    </p>
                    <div class="mt-3">
                        <a href="{{ route('admin.dashboard') }}" class="text-xs font-semibold text-blue-400 hover:underline">
                            Reset Semua Filter
                        </a>
                    </div>
                </div>
            @else
                {{-- Desktop Table View (>= md screens) --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#0d1527] text-slate-400 text-[11px] font-semibold uppercase tracking-wider border-b border-[#1e293b]">
                                <th class="py-3.5 px-5">Kode</th>
                                <th class="py-3.5 px-5">Pelapor & Divisi</th>
                                <th class="py-3.5 px-5">Permasalahan</th>
                                <th class="py-3.5 px-5">Prioritas</th>
                                <th class="py-3.5 px-5">Status</th>
                                <th class="py-3.5 px-5">Teknisi</th>
                                <th class="py-3.5 px-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#1e293b] text-xs sm:text-sm">
                            @foreach ($tickets as $ticket)
                                <tr class="hover:bg-[#162036]/60 transition">
                                    {{-- Kode --}}
                                    <td class="py-3.5 px-5 font-mono font-bold whitespace-nowrap">
                                        <span class="bg-[#162036] px-2.5 py-1 rounded text-xs text-blue-300 border border-blue-900/60">
                                            {{ $ticket->ticket_code }}
                                        </span>
                                    </td>

                                    {{-- Pelapor --}}
                                    <td class="py-3.5 px-5">
                                        <div class="font-semibold text-white leading-tight">{{ $ticket->user->name }}</div>
                                        <div class="text-[11px] text-slate-400 mt-0.5">{{ $ticket->user->department ?? 'Umum' }}</div>
                                    </td>

                                    {{-- Permasalahan --}}
                                    <td class="py-3.5 px-5 max-w-xs">
                                        <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="font-semibold text-slate-200 hover:text-blue-400 transition block leading-snug">
                                            {{ $ticket->title }}
                                        </a>
                                        <div class="text-[11px] text-slate-500 mt-0.5">
                                            {{ $ticket->device_name }} • {{ $ticket->location }}
                                        </div>
                                    </td>

                                    {{-- Prioritas --}}
                                    <td class="py-3.5 px-5 whitespace-nowrap">
                                        @php
                                            $priorityMap = [
                                                'low' => ['label' => 'Rendah', 'dot' => 'bg-slate-400', 'badge' => 'bg-slate-800/80 text-slate-300 border-slate-700'],
                                                'medium' => ['label' => 'Sedang', 'dot' => 'bg-blue-400', 'badge' => 'bg-blue-950/50 text-blue-300 border-blue-800/60'],
                                                'high' => ['label' => 'Tinggi', 'dot' => 'bg-orange-400', 'badge' => 'bg-orange-950/50 text-orange-300 border-orange-800/60'],
                                                'urgent' => ['label' => 'Darurat', 'dot' => 'bg-rose-400', 'badge' => 'bg-rose-950/50 text-rose-300 border-rose-800/60 font-bold'],
                                            ];
                                            $currP = $priorityMap[$ticket->priority] ?? ['label' => $ticket->priority, 'dot' => 'bg-slate-400', 'badge' => 'bg-slate-800 text-slate-300 border-slate-700'];
                                        @endphp
                                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-xs border {{ $currP['badge'] }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $currP['dot'] }}"></span>
                                            {{ $currP['label'] }}
                                        </span>
                                    </td>

                                    {{-- Status --}}
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

                                    {{-- Teknisi --}}
                                    <td class="py-3.5 px-5 whitespace-nowrap text-xs">
                                        @if ($ticket->technician)
                                            <span class="font-medium text-slate-200">{{ $ticket->technician->name }}</span>
                                        @else
                                            <span class="text-slate-500 italic">Belum ditugaskan</span>
                                        @endif
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="py-3.5 px-5 text-right whitespace-nowrap">
                                        <a href="{{ route('admin.tickets.show', $ticket->id) }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-[#162036] hover:bg-blue-600 text-slate-200 hover:text-white font-semibold text-xs transition border border-[#1e293b]">
                                            Kelola &rarr;
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Mobile Card List (< md screens) --}}
                <div class="block md:hidden divide-y divide-[#1e293b]">
                    @foreach ($tickets as $ticket)
                        @php
                            $priorityMap = [
                                'low' => ['label' => 'Rendah', 'dot' => 'bg-slate-400', 'badge' => 'bg-slate-800 text-slate-300 border-slate-700'],
                                'medium' => ['label' => 'Sedang', 'dot' => 'bg-blue-400', 'badge' => 'bg-blue-950/50 text-blue-300 border-blue-800/60'],
                                'high' => ['label' => 'Tinggi', 'dot' => 'bg-orange-400', 'badge' => 'bg-orange-950/50 text-orange-300 border-orange-800/60'],
                                'urgent' => ['label' => 'Darurat', 'dot' => 'bg-rose-400', 'badge' => 'bg-rose-950/50 text-rose-300 border-rose-800/60 font-bold'],
                            ];
                            $currP = $priorityMap[$ticket->priority] ?? ['label' => $ticket->priority, 'dot' => 'bg-slate-400', 'badge' => 'bg-slate-800 text-slate-300 border-slate-700'];
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
                                    <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="hover:text-blue-400">
                                        {{ $ticket->title }}
                                    </a>
                                </h3>
                                <p class="text-xs text-slate-400 mt-0.5">
                                    {{ $ticket->user->name }} ({{ $ticket->user->department ?? 'Umum' }}) • {{ $ticket->device_name }}
                                </p>
                                <p class="text-[11px] text-slate-500 mt-0.5">
                                    Lokasi: {{ $ticket->location }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-2 border-t border-[#1e293b] text-xs">
                                <div class="text-slate-400 text-[11px]">
                                    Teknisi: <strong class="text-slate-200 font-medium">{{ $ticket->technician ? $ticket->technician->name : 'Belum ada' }}</strong>
                                </div>
                                <a href="{{ route('admin.tickets.show', $ticket->id) }}"
                                    class="bg-blue-600 hover:bg-blue-500 text-white font-semibold px-3 py-1.5 rounded-lg text-xs transition">
                                    Kelola &rarr;
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
