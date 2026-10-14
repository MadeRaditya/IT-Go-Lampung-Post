<nav class="bg-[#0d1527]/90 backdrop-blur-md border-b border-[#1e293b] sticky top-0 z-50 transition-all">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center space-x-5">
                <a href="{{ url('/') }}" class="flex items-center gap-2.5 group">
                    <div class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center transition group-hover:bg-blue-500 shadow-sm shadow-blue-500/30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5">
                            <span class="font-bold text-lg tracking-tight text-white group-hover:text-blue-400 transition">IT-Go</span>
                            <span class="px-1.5 py-0.2 rounded text-[10px] font-bold tracking-wider uppercase bg-blue-950/60 text-blue-400 border border-blue-800/60 hidden sm:inline-block">Corporate</span>
                        </div>
                    </div>
                </a>

                <div class="hidden md:flex items-center space-x-1 pl-4 border-l border-[#1e293b]">
                    <a href="{{ url('/') }}"
                        class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ request()->is('/') ? 'bg-[#162036] text-white border border-blue-500/30' : 'text-slate-300 hover:text-white hover:bg-[#162036]' }}">
                        Beranda
                    </a>

                    @auth
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                                class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ request()->routeIs('admin.*') ? 'bg-[#162036] text-white border border-blue-500/30' : 'text-slate-300 hover:text-white hover:bg-[#162036]' }}">
                                Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('user.tickets.index') }}"
                                class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ request()->routeIs('user.tickets.index') || request()->routeIs('user.tickets.show') ? 'bg-[#162036] text-white border border-blue-500/30' : 'text-slate-300 hover:text-white hover:bg-[#162036]' }}">
                                Tiket Saya
                            </a>
                            <a href="{{ route('user.tickets.create') }}"
                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ request()->routeIs('user.tickets.create') ? 'bg-blue-600 text-white' : 'text-blue-400 bg-blue-950/60 hover:bg-blue-900/60 border border-blue-800/60' }}">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                                </svg>
                                Buat Laporan
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="flex items-center gap-2 sm:gap-3">
                @auth
                    <div class="flex items-center gap-2.5 pl-2.5 pr-1.5 py-1 rounded-xl bg-[#10172a] border border-[#1e293b]">
                        <div class="w-7 h-7 rounded-lg bg-blue-600 text-white font-bold text-xs flex items-center justify-center">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <div class="text-left hidden sm:block pr-1">
                            <span class="block text-xs font-semibold text-slate-100 leading-tight">{{ auth()->user()->name }}</span>
                            <span class="inline-flex items-center gap-1 text-[10px] text-slate-400">
                                <span class="w-1.5 h-1.5 rounded-full {{ auth()->user()->isAdmin() ? 'bg-blue-400' : 'bg-emerald-400' }}"></span>
                                {{ auth()->user()->department ?? (auth()->user()->isAdmin() ? 'IT Support' : 'Karyawan') }}
                            </span>
                        </div>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" title="Keluar dari akun (Logout)"
                                class="p-1.5 text-slate-400 hover:text-rose-400 hover:bg-rose-950/30 rounded-lg transition"
                                aria-label="Logout">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="text-slate-300 hover:text-white font-semibold text-xs sm:text-sm px-3 py-1.5 rounded-lg hover:bg-[#162036] transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-blue-600 hover:bg-blue-500 text-white font-semibold text-xs sm:text-sm px-3.5 py-1.5 rounded-lg transition shadow-sm shadow-blue-500/20">
                        Daftar
                    </a>
                @endauth

                {{-- Mobile Hamburger --}}
                <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                    class="md:hidden p-1.5 rounded-lg text-slate-300 hover:text-white hover:bg-[#162036] focus:outline-none"
                    aria-label="Toggle Mobile Menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Drawer Menu --}}
    <div id="mobile-menu" class="hidden md:hidden border-t border-[#1e293b] bg-[#0d1527] px-4 pt-2.5 pb-4 space-y-1 text-xs">
        <a href="{{ url('/') }}"
            class="block px-3 py-2 rounded-lg font-medium {{ request()->is('/') ? 'bg-[#162036] text-white border border-blue-500/30' : 'text-slate-300 hover:bg-[#162036]' }}">
            Beranda
        </a>
        @auth
            @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-3 py-2 rounded-lg font-medium {{ request()->routeIs('admin.*') ? 'bg-[#162036] text-white border border-blue-500/30' : 'text-slate-300 hover:bg-[#162036]' }}">
                    Dashboard Admin IT
                </a>
            @else
                <a href="{{ route('user.tickets.index') }}"
                    class="block px-3 py-2 rounded-lg font-medium {{ request()->routeIs('user.tickets.index') ? 'bg-[#162036] text-white border border-blue-500/30' : 'text-slate-300 hover:bg-[#162036]' }}">
                    Tiket Saya
                </a>
                <a href="{{ route('user.tickets.create') }}"
                    class="block px-3 py-2 rounded-lg font-semibold bg-blue-600 text-white">
                    Buat Laporan Kerusakan
                </a>
            @endif
        @else
            <div class="pt-2 border-t border-[#1e293b] flex flex-col gap-1.5">
                <a href="{{ route('login') }}" class="block text-center py-2 rounded-lg font-medium text-slate-200 bg-[#162036]">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="block text-center py-2 rounded-lg font-medium bg-blue-600 text-white">
                    Daftar Akun Baru
                </a>
            </div>
        @endauth
    </div>
</nav>
