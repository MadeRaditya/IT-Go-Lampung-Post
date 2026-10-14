@extends('layouts.app')

@section('title', 'Pendaftaran Karyawan - IT-Go Enterprise')

@section('content')
    <div class="max-w-lg mx-auto px-4 py-4 sm:py-8">
        <div class="bg-[#10172a] rounded-2xl border border-[#1e293b] shadow-xs p-6 sm:p-8">
            <div class="text-center mb-6">
                <div class="w-11 h-11 rounded-xl bg-blue-600 text-white flex items-center justify-center mx-auto mb-3 shadow-sm shadow-blue-500/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <h1 class="text-xl font-bold text-white tracking-tight">Daftar Akun Karyawan</h1>
                <p class="text-slate-400 text-xs sm:text-sm mt-0.5">Daftarkan akun kerja Anda untuk kemudahan pelaporan IT</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                        Nama Lengkap <span class="text-rose-400">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full pl-9 pr-3.5 py-2.5 bg-[#0a0f1d] border border-[#1e293b] rounded-xl text-xs sm:text-sm font-medium text-slate-200 placeholder-slate-500 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition @error('name') border-rose-500 @enderror"
                            placeholder="Contoh: Budi Santoso">
                        <svg class="w-4 h-4 text-slate-500 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    @error('name')
                        <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                        Email Perusahaan <span class="text-rose-400">*</span>
                    </label>
                    <div class="relative">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="w-full pl-9 pr-3.5 py-2.5 bg-[#0a0f1d] border border-[#1e293b] rounded-xl text-xs sm:text-sm font-medium text-slate-200 placeholder-slate-500 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition @error('email') border-rose-500 @enderror"
                            placeholder="nama@company.com">
                        <svg class="w-4 h-4 text-slate-500 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    @error('email')
                        <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label for="department" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                            Divisi / Bagian <span class="text-rose-400">*</span>
                        </label>
                        <input type="text" id="department" name="department" value="{{ old('department') }}" required
                            class="w-full px-3.5 py-2.5 bg-[#0a0f1d] border border-[#1e293b] rounded-xl text-xs sm:text-sm font-medium text-slate-200 placeholder-slate-500 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition @error('department') border-rose-500 @enderror"
                            placeholder="Finance / HR / Ops">
                        @error('department')
                            <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone_number" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                            No. WhatsApp <span class="text-rose-400">*</span>
                        </label>
                        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required
                            class="w-full px-3.5 py-2.5 bg-[#0a0f1d] border border-[#1e293b] rounded-xl text-xs sm:text-sm font-medium text-slate-200 placeholder-slate-500 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition @error('phone_number') border-rose-500 @enderror"
                            placeholder="08123456789">
                        @error('phone_number')
                            <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                            Password <span class="text-rose-400">*</span>
                        </label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-3.5 py-2.5 bg-[#0a0f1d] border border-[#1e293b] rounded-xl text-xs sm:text-sm font-medium text-slate-200 placeholder-slate-500 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition @error('password') border-rose-500 @enderror"
                            placeholder="Min. 8 karakter">
                        @error('password')
                            <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                            Ulangi Password <span class="text-rose-400">*</span>
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full px-3.5 py-2.5 bg-[#0a0f1d] border border-[#1e293b] rounded-xl text-xs sm:text-sm font-medium text-slate-200 placeholder-slate-500 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition"
                            placeholder="Ulangi password">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2.5 px-4 rounded-xl text-xs sm:text-sm transition shadow-sm shadow-blue-500/25 pt-2.5">
                    Daftar Akun Baru
                </button>
            </form>

            <div class="mt-6 pt-5 border-t border-[#1e293b] text-center text-xs text-slate-400">
                Sudah memiliki akun terdaftar?
                <a href="{{ route('login') }}" class="text-blue-400 font-semibold hover:underline ml-1">
                    Masuk di sini
                </a>
            </div>
        </div>
    </div>
@endsection
