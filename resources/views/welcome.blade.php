@extends('layouts.app')

@section('title', 'IT-Go - Portal Layanan & Pelaporan Kerusakan IT Perusahaan')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 sm:space-y-14">

        {{-- Hero Enterprise Dark Card --}}
        <div class="relative bg-gradient-to-b from-[#10172a] via-[#0d1527] to-[#0a0f1d] text-white rounded-2xl sm:rounded-3xl p-6 sm:p-10 md:p-12 border border-[#1e293b] shadow-sm overflow-hidden">
            <div class="relative z-10 max-w-2xl">
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-blue-950/60 text-blue-400 text-xs font-semibold border border-blue-800/60">
                        Helpdesk Internal Perusahaan
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-emerald-950/60 text-emerald-400 text-xs font-medium border border-emerald-800/60">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Layanan Aktif
                    </span>
                </div>

                <h1 class="text-2xl sm:text-4xl font-extrabold text-white leading-tight tracking-tight mb-3">
                    Pelaporan Kerusakan Komputer & Bantuan IT Cepat
                </h1>

                <p class="text-slate-300 text-sm sm:text-base leading-relaxed mb-6 font-normal">
                    Sistem tiket terpadu untuk penanganan komputer, printer, aplikasi, dan jaringan kantor.
                    Pantau tahapan perbaikan secara transparan langsung dari meja kerja Anda.
                </p>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 sm:gap-3">
                    @auth
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                                class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-500 text-white font-bold px-6 py-3 rounded-xl text-sm transition shadow-sm shadow-blue-500/25">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Buka Dashboard Admin IT &rarr;
                            </a>
                        @else
                            <a href="{{ route('user.tickets.create') }}"
                                class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-500 text-white font-bold px-6 py-3 rounded-xl text-sm transition shadow-sm shadow-blue-500/25">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Buat Laporan Kerusakan
                            </a>
                            <a href="{{ route('user.tickets.index') }}"
                                class="inline-flex items-center justify-center gap-2 bg-[#162036] hover:bg-[#1e293b] text-slate-200 font-semibold px-5 py-3 rounded-xl text-sm border border-[#1e293b] transition">
                                Pantau Tiket Saya
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-500 text-white font-bold px-6 py-3 rounded-xl text-sm transition shadow-sm shadow-blue-500/25">
                            Masuk untuk Melapor
                        </a>
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center justify-center gap-2 bg-[#162036] hover:bg-[#1e293b] text-slate-200 font-semibold px-5 py-3 rounded-xl text-sm border border-[#1e293b] transition">
                            Daftar Akun Karyawan
                        </a>
                    @endauth
                </div>

                {{-- Feature Bullet Bar --}}
                <div class="mt-6 pt-5 border-t border-[#1e293b] grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs text-slate-400">
                    <div class="flex items-center gap-2">
                        <svg class="w-3.5 h-3.5 text-blue-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Respon Cepat Tim IT</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-3.5 h-3.5 text-blue-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Semua Divisi Kantor</span>
                    </div>
                    <div class="hidden sm:flex items-center gap-2">
                        <svg class="w-3.5 h-3.5 text-blue-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Lacak Progres Real-Time</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Categories Section --}}
        <div>
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-6 gap-2">
                <div>
                    <h2 class="text-lg sm:text-xl font-bold text-white tracking-tight">Kategori Kendala IT</h2>
                    <p class="text-slate-400 text-xs sm:text-sm mt-0.5">Pilih kategori yang sesuai dengan kendala perangkat di ruangan kerja Anda.</p>
                </div>
                @auth
                    <a href="{{ route('user.tickets.create') }}" class="text-xs font-semibold text-blue-400 hover:underline">
                        Formulir Lengkap &rarr;
                    </a>
                @endauth
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                {{-- Hardware --}}
                <div class="bg-[#10172a] p-5 rounded-2xl border border-[#1e293b] shadow-xs hover:border-blue-500/50 transition group flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-[#162036] text-blue-400 border border-blue-900/40 flex items-center justify-center mb-3 group-hover:bg-blue-600 group-hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-white mb-1">Hardware / PC & Laptop</h3>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            PC mati total, layar blank / bergaris, mouse/keyboard tidak terdeteksi, atau laptop bersuara bising.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-[#1e293b] flex items-center justify-between text-xs">
                        <span class="text-slate-500">PC Meja, Monitor, CPU</span>
                        <a href="{{ auth()->check() ? route('user.tickets.create') : route('login') }}"
                            class="text-blue-400 font-semibold group-hover:underline">Lapor &rarr;</a>
                    </div>
                </div>

                {{-- Software --}}
                <div class="bg-[#10172a] p-5 rounded-2xl border border-[#1e293b] shadow-xs hover:border-blue-500/50 transition group flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-[#162036] text-blue-400 border border-blue-900/40 flex items-center justify-center mb-3 group-hover:bg-blue-600 group-hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-white mb-1">Software & Aplikasi Kantor</h3>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Microsoft Office hang/lisensi expired, aplikasi internal error, Windows corrupt, atau dugaan malware.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-[#1e293b] flex items-center justify-between text-xs">
                        <span class="text-slate-500">Office, OS, ERP</span>
                        <a href="{{ auth()->check() ? route('user.tickets.create') : route('login') }}"
                            class="text-blue-400 font-semibold group-hover:underline">Lapor &rarr;</a>
                    </div>
                </div>

                {{-- Jaringan --}}
                <div class="bg-[#10172a] p-5 rounded-2xl border border-[#1e293b] shadow-xs hover:border-blue-500/50 transition group flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-[#162036] text-blue-400 border border-blue-900/40 flex items-center justify-center mb-3 group-hover:bg-blue-600 group-hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-white mb-1">Jaringan & Koneksi Internet</h3>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Wi-Fi tidak bisa tersambung, kabel LAN bermasalah, VPN kantor putus, atau shared folder tidak bisa dibuka.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-[#1e293b] flex items-center justify-between text-xs">
                        <span class="text-slate-500">Wi-Fi, LAN, Server Share</span>
                        <a href="{{ auth()->check() ? route('user.tickets.create') : route('login') }}"
                            class="text-blue-400 font-semibold group-hover:underline">Lapor &rarr;</a>
                    </div>
                </div>

                {{-- Printer --}}
                <div class="bg-[#10172a] p-5 rounded-2xl border border-[#1e293b] shadow-xs hover:border-blue-500/50 transition group flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-[#162036] text-blue-400 border border-blue-900/40 flex items-center justify-center mb-3 group-hover:bg-blue-600 group-hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-white mb-1">Printer, Scanner & Salin</h3>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Kertas macet (paper jam), lampu merah berkedip, printer offline, hasil cetakan bergaris, atau tinta habis.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-[#1e293b] flex items-center justify-between text-xs">
                        <span class="text-slate-500">Printer Kantor, Scanner</span>
                        <a href="{{ auth()->check() ? route('user.tickets.create') : route('login') }}"
                            class="text-blue-400 font-semibold group-hover:underline">Lapor &rarr;</a>
                    </div>
                </div>

                {{-- Akun & Email --}}
                <div class="bg-[#10172a] p-5 rounded-2xl border border-[#1e293b] shadow-xs hover:border-blue-500/50 transition group flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-[#162036] text-blue-400 border border-blue-900/40 flex items-center justify-center mb-3 group-hover:bg-blue-600 group-hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-white mb-1">Akun, Email & Hak Akses</h3>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Lupa password email kantor, akun terkunci, permohonan email karyawan baru, atau hak akses folder kerja.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-[#1e293b] flex items-center justify-between text-xs">
                        <span class="text-slate-500">Password, Email, Login</span>
                        <a href="{{ auth()->check() ? route('user.tickets.create') : route('login') }}"
                            class="text-blue-400 font-semibold group-hover:underline">Lapor &rarr;</a>
                    </div>
                </div>

                {{-- Kontak Darurat --}}
                <div class="bg-[#0d1527] text-white p-5 rounded-2xl border border-blue-900/50 shadow-xs flex flex-col justify-between">
                    <div>
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-blue-950/60 text-blue-400 border border-blue-800/60 inline-block mb-2.5">
                            Kontak Cepat
                        </span>
                        <h3 class="text-sm font-bold text-white mb-1">Kendala Server / Gangguan Massal</h3>
                        <p class="text-xs text-slate-300 leading-relaxed">
                            Untuk insiden mendesak yang melumpuhkan operasional divisi secara bersamaan, hubungi hotline IT.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-[#1e293b] flex items-center justify-between text-xs">
                        <div>
                            <span class="text-[10px] text-slate-400 block font-medium">Extension</span>
                            <span class="font-mono font-bold text-blue-400">Ext. 108</span>
                        </div>
                        <span class="px-2.5 py-1 rounded-md bg-[#162036] text-slate-200 text-[11px] font-medium border border-[#1e293b]">
                            Ruang IT Lt. 2
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Workflow 3 Steps --}}
        <div class="bg-[#10172a] rounded-2xl border border-[#1e293b] p-6 sm:p-8 shadow-xs">
            <div class="text-center max-w-xl mx-auto mb-8">
                <span class="text-[11px] font-bold text-blue-400 uppercase tracking-wider">Alur Pelayanan</span>
                <h2 class="text-lg sm:text-xl font-bold text-white mt-0.5">3 Tahap Penanganan Gangguan IT</h2>
                <p class="text-slate-400 text-xs sm:text-sm mt-0.5">Proses terstruktur untuk memastikan setiap laporan tuntas tertangani.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-3 text-center sm:text-left flex md:flex-col items-center md:items-start gap-4 md:gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#162036] text-blue-400 flex items-center justify-center font-bold text-sm shrink-0 border border-blue-900/40">
                        1
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white mb-1">Kirim Laporan</h3>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Pilih kategori, sebutkan ruangan atau meja kerja, dan jelaskan kendala yang dialami.
                        </p>
                    </div>
                </div>

                <div class="p-3 text-center sm:text-left flex md:flex-col items-center md:items-start gap-4 md:gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#162036] text-blue-400 flex items-center justify-center font-bold text-sm shrink-0 border border-blue-900/40">
                        2
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white mb-1">Penugasan Teknisi</h3>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Admin menugaskan teknisi penanggung jawab untuk pemeriksaan fisik di ruangan atau remote.
                        </p>
                    </div>
                </div>

                <div class="p-3 text-center sm:text-left flex md:flex-col items-center md:items-start gap-4 md:gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-950/50 text-emerald-400 flex items-center justify-center font-bold text-sm shrink-0 border border-emerald-800/50">
                        3
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white mb-1">Selesai & Normal</h3>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Perangkat diuji coba, tiket diselesaikan, dan riwayat catatan perbaikan tercatat rapi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
