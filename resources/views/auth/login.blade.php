@extends('layouts.app')

@section('title', 'Masuk Akun Karyawan - IT-Go')

@section('content')
    <div class="max-w-md mx-auto px-4 py-4 sm:py-8">
        <div class="bg-[#10172a] rounded-2xl border border-[#1e293b] shadow-xs p-6 sm:p-8">
            <div class="text-center mb-6">
                <div class="w-11 h-11 rounded-xl bg-blue-600 text-white flex items-center justify-center mx-auto mb-3 shadow-sm shadow-blue-500/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h1 class="text-xl font-bold text-white tracking-tight">Masuk Akun Karyawan</h1>
                <p class="text-slate-400 text-xs sm:text-sm mt-0.5">Gunakan email perusahaan untuk mengakses portal IT</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                        Email Perusahaan
                    </label>
                    <div class="relative">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full pl-9 pr-3.5 py-2.5 bg-[#0a0f1d] border border-[#1e293b] rounded-xl text-xs sm:text-sm font-medium text-slate-200 placeholder-slate-500 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition @error('email') border-rose-500 @enderror"
                            placeholder="nama@company.com">
                        <svg class="w-4 h-4 text-slate-500 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    @error('email')
                        <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                        Kata Sandi
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                            class="w-full pl-9 pr-9 py-2.5 bg-[#0a0f1d] border border-[#1e293b] rounded-xl text-xs sm:text-sm font-medium text-slate-200 placeholder-slate-500 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition @error('password') border-rose-500 @enderror"
                            placeholder="••••••••">
                        <svg class="w-4 h-4 text-slate-500 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <button type="button" onclick="togglePassword('password')"
                            class="absolute right-2.5 top-2.5 text-slate-500 hover:text-slate-300 focus:outline-none p-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center text-slate-400 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-3.5 h-3.5 rounded border-[#1e293b] bg-[#0a0f1d] text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 font-medium">Ingat perangkat ini</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2.5 px-4 rounded-xl text-xs sm:text-sm transition shadow-sm shadow-blue-500/25">
                    Masuk ke Sistem
                </button>
            </form>

            <div class="mt-6 pt-5 border-t border-[#1e293b] text-center text-xs text-slate-400">
                Belum memiliki akun?
                <a href="{{ route('register') }}" class="text-blue-400 font-semibold hover:underline ml-1">
                    Daftar di sini
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
@endsection
