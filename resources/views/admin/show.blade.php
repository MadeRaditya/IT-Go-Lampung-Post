@extends('layouts.app')

@section('title', 'Kelola Tiket ' . $ticket->ticket_code . ' - IT-Go Admin')

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        {{-- Navigation & Title --}}
        <div>
            <a href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center gap-1.5 text-slate-400 hover:text-white text-xs font-semibold uppercase tracking-wider transition mb-2">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Dashboard Admin
            </a>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mt-1">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-white tracking-tight flex flex-wrap items-center gap-2">
                        Kelola Laporan Kerusakan
                        <span class="px-2.5 py-0.5 rounded bg-[#162036] text-blue-300 text-xs font-mono font-bold border border-blue-900/60">
                            {{ $ticket->ticket_code }}
                        </span>
                    </h1>
                    <p class="text-slate-400 text-xs sm:text-sm mt-0.5">
                        Masuk: {{ $ticket->created_at->format('d F Y, H:i') }} WIB • Pelapor: <strong class="text-slate-200">{{ $ticket->user->name }}</strong> ({{ $ticket->user->department ?? 'Umum' }})
                    </p>
                </div>

                <div>
                    @php
                        $priorityMap = [
                            'low' => ['label' => 'Rendah', 'dot' => 'bg-slate-400', 'badge' => 'bg-slate-800 text-slate-300 border-slate-700'],
                            'medium' => ['label' => 'Sedang', 'dot' => 'bg-blue-400', 'badge' => 'bg-blue-950/50 text-blue-300 border-blue-800/60'],
                            'high' => ['label' => 'Tinggi', 'dot' => 'bg-orange-400', 'badge' => 'bg-orange-950/50 text-orange-300 border-orange-800/60'],
                            'urgent' => ['label' => 'Darurat', 'dot' => 'bg-rose-400', 'badge' => 'bg-rose-950/50 text-rose-300 border-rose-800/60 font-bold'],
                        ];
                        $currP = $priorityMap[$ticket->priority] ?? ['label' => $ticket->priority, 'dot' => 'bg-slate-400', 'badge' => 'bg-slate-800 text-slate-300 border-slate-700'];
                    @endphp
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs border {{ $currP['badge'] }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $currP['dot'] }}"></span>
                        Prioritas: {{ $currP['label'] }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Main Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Left Column: Ticket Details & History --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Ticket Details --}}
                <div class="bg-[#10172a] rounded-2xl border border-[#1e293b] shadow-xs p-5 sm:p-6 space-y-5">
                    <div class="border-b border-[#1e293b] pb-3 flex items-center justify-between">
                        <h3 class="text-sm font-bold text-white">Rincian Laporan Kendala</h3>
                        <span class="text-xs text-slate-400">{{ $ticket->created_at->diffForHumans() }}</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 bg-[#0a0f1d] p-4 rounded-xl border border-[#1e293b] text-xs">
                        <div>
                            <span class="text-slate-400 block text-[11px] font-semibold uppercase mb-0.5">Pelapor</span>
                            <p class="font-bold text-white">{{ $ticket->user->name }}</p>
                            <p class="text-slate-400 mt-0.5">{{ $ticket->user->department ?? 'Umum' }}</p>
                            @if ($ticket->user->phone_number)
                                @php
                                    $cleanPhone = preg_replace('/[^0-9]/', '', $ticket->user->phone_number);
                                    if (str_starts_with($cleanPhone, '0')) {
                                        $cleanPhone = '62' . substr($cleanPhone, 1);
                                    }
                                @endphp
                                <a href="https://wa.me/{{ $cleanPhone }}?text=Halo%20{{ urlencode($ticket->user->name) }},%20saya%20teknisi%20IT%20Support%20mengenai%20tiket%20{{ $ticket->ticket_code }}"
                                    target="_blank"
                                    class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-emerald-400 bg-emerald-950/40 hover:bg-emerald-900/50 px-2 py-1 rounded border border-emerald-800/50 mt-2 transition">
                                    <svg class="w-3.5 h-3.5 text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.173.086.275.072.376-.044.101-.116.433-.506.549-.68.116-.173.231-.145.39-.086s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824z" />
                                    </svg>
                                    Chat WhatsApp
                                </a>
                            @endif
                        </div>

                        <div>
                            <span class="text-slate-400 block text-[11px] font-semibold uppercase mb-0.5">Perangkat & Kategori</span>
                            <p class="font-bold text-white">{{ $ticket->device_name }}</p>
                            <span class="inline-block text-[11px] text-blue-300 bg-[#162036] px-2 py-0.5 rounded border border-blue-900/50 mt-1">
                                {{ $ticket->category->name }}
                            </span>
                        </div>

                        <div>
                            <span class="text-slate-400 block text-[11px] font-semibold uppercase mb-0.5">Lokasi Ruangan</span>
                            <p class="font-medium text-slate-200">{{ $ticket->location }}</p>
                        </div>

                        <div>
                            <span class="text-slate-400 block text-[11px] font-semibold uppercase mb-0.5">Status Saat Ini</span>
                            @if ($ticket->status === 'pending')
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-xs font-medium bg-amber-950/40 text-amber-300 border border-amber-800/50">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span> Menunggu IT
                                </span>
                            @elseif($ticket->status === 'in_progress')
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-xs font-medium bg-blue-950/50 text-blue-300 border border-blue-800/60">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span> Sedang Dikerjakan
                                </span>
                            @elseif($ticket->status === 'resolved')
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-xs font-medium bg-emerald-950/40 text-emerald-300 border border-emerald-800/50">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-xs font-medium bg-slate-800 text-slate-300 border border-slate-700">
                                    Ditutup
                                </span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <span class="text-slate-400 block text-[11px] font-semibold uppercase mb-0.5">Judul Permasalahan</span>
                        <h4 class="text-base font-bold text-white leading-snug">{{ $ticket->title }}</h4>
                    </div>

                    <div>
                        <span class="text-slate-400 block text-[11px] font-semibold uppercase mb-1">Deskripsi Detail dari Pelapor</span>
                        <div class="bg-[#0a0f1d] p-4 rounded-xl border border-[#1e293b] text-slate-200 text-xs sm:text-sm leading-relaxed whitespace-pre-line">
                            {{ $ticket->description }}
                        </div>
                    </div>

                    @if ($ticket->attachment)
                        <div>
                            <span class="text-slate-400 block text-[11px] font-semibold uppercase mb-1.5">Lampiran Bukti Kerusakan</span>
                            <a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank" class="inline-block group">
                                <div class="relative overflow-hidden rounded-xl border border-[#1e293b] max-w-xs">
                                    <img src="{{ asset('storage/' . $ticket->attachment) }}" alt="Lampiran Kerusakan"
                                        class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-200">
                                    <div class="absolute inset-0 bg-slate-950/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-medium">
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
                        Riwayat Progres & Catatan Teknisi
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
                                            <span class="text-[10px] text-slate-400 block">{{ $log->user->role === 'admin' ? 'Admin / Teknisi IT' : 'Karyawan Pelapor' }}</span>
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
                            <p class="text-xs text-slate-500 italic">Belum ada riwayat tercatat.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Right Column: Admin Actions Form --}}
            <div class="space-y-4">
                <div class="bg-[#10172a] rounded-2xl border border-[#1e293b] shadow-xs p-5 sm:p-6 sticky top-24">
                    <div class="flex items-center gap-2 pb-3 border-b border-[#1e293b] mb-4">
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                        <h3 class="text-sm font-bold text-white">Tindakan Admin & Teknisi</h3>
                    </div>

                    <form method="POST" action="{{ route('admin.tickets.update', $ticket->id) }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="status" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                                Ubah Status Tiket
                            </label>
                            <select id="status" name="status"
                                class="w-full px-3 py-2 bg-[#0a0f1d] border border-[#1e293b] rounded-xl text-xs sm:text-sm font-medium text-slate-200 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition">
                                <option value="pending" {{ $ticket->status === 'pending' ? 'selected' : '' }}>Menunggu (Pending)</option>
                                <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>Sedang Dikerjakan (In Progress)</option>
                                <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Selesai (Resolved)</option>
                                <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Ditutup (Closed)</option>
                            </select>
                        </div>

                        <div>
                            <label for="assigned_to" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                                Tugaskan Teknisi
                            </label>
                            <select id="assigned_to" name="assigned_to"
                                class="w-full px-3 py-2 bg-[#0a0f1d] border border-[#1e293b] rounded-xl text-xs sm:text-sm font-medium text-slate-200 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition">
                                <option value="">-- Belum Ditugaskan --</option>
                                @foreach ($technicians as $tech)
                                    <option value="{{ $tech->id }}" {{ $ticket->assigned_to == $tech->id ? 'selected' : '' }}>
                                        {{ $tech->name }} ({{ $tech->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label for="comment" class="block text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    Catatan / Pesan
                                </label>
                                <span class="text-[11px] text-slate-500">Dapat dibaca user</span>
                            </div>
                            <textarea id="comment" name="comment" rows="3"
                                placeholder="Tuliskan tindakan perbaikan yang dilakukan..."
                                class="w-full px-3 py-2 bg-[#0a0f1d] border border-[#1e293b] rounded-xl text-xs sm:text-sm font-medium text-slate-200 placeholder-slate-500 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition leading-relaxed"></textarea>

                            <div class="mt-2 flex flex-wrap gap-1 text-[11px]">
                                <span class="text-slate-500">Pintasan:</span>
                                <button type="button"
                                    onclick="setComment('Teknisi sedang menuju ke ruangan kerja Anda untuk pengecekan fisik.')"
                                    class="text-blue-400 hover:underline">
                                    Menuju Ruangan
                                </button>
                                <span>•</span>
                                <button type="button"
                                    onclick="setComment('Perangkat telah diperbaiki dan diuji coba berfungsi normal.')"
                                    class="text-blue-400 hover:underline">
                                    Selesai Normal
                                </button>
                                <span>•</span>
                                <button type="button"
                                    onclick="setComment('Akun telah di-reset. Silakan cek pesan WhatsApp untuk info kredensial.')"
                                    class="text-blue-400 hover:underline">
                                    Reset Password
                                </button>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2.5 px-4 rounded-xl text-xs sm:text-sm transition shadow-sm shadow-blue-500/25">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setComment(text) {
            document.getElementById('comment').value = text;
        }
    </script>
@endsection
