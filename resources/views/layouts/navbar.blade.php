<nav class="bg-blue-600 text-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center space-x-3">
                <a href="{{ url('/') }}" class="flex items-center space-x-2 font-bold text-xl tracking-wide text-white hover:text-blue-100 transition">
                    <svg class="w-8 h-8 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 002-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>IT-Go</span>
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-6 text-sm font-medium">
                <a href="{{ url('/') }}" class="hover:text-blue-200 transition">Beranda</a>
                
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-200 transition">Dashboard Admin</a>
                    @else
                        <a href="{{ route('user.tickets.create') }}" class="hover:text-blue-200 transition">Buat Laporan</a>
                        <a href="{{ route('user.tickets.index') }}" class="hover:text-blue-200 transition">Tiket Saya</a>
                    @endif
                @endauth
            </div>

            <div class="flex items-center space-x-3">
                @auth
                    <div class="flex items-center space-x-3 bg-blue-700 px-3 py-1.5 rounded-lg border border-blue-500">
                        <span class="text-sm font-semibold">{{ auth()->user()->name }}</span>
                        <span class="text-xs uppercase bg-blue-200 text-blue-900 px-2 py-0.5 rounded font-bold">
                            {{ auth()->user()->role }}
                        </span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-2 rounded-md font-medium transition">
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-blue-100 font-medium text-sm px-3 py-2">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-blue-50 font-semibold text-sm px-4 py-2 rounded-lg shadow transition">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>