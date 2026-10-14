@extends('layouts.app')

@section('title', 'Daftar Akun - IT-Go')

@section('content')
<div class="max-w-lg mx-auto px-4">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-blue-950">Daftar Akun Karyawan</h2>
            <p class="text-slate-500 text-sm mt-1">Buat akun untuk melaporkan kendala komputermu</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('name') border-red-500 @else border-slate-300 @enderror"
                       placeholder="Budi Santoso">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email Kantor</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('email') border-red-500 @else border-slate-300 @enderror"
                       placeholder="budi@company.com">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="department" class="block text-sm font-medium text-slate-700 mb-1">Divisi / Departemen</label>
                    <input type="text" id="department" name="department" value="{{ old('department') }}" required
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('department') border-red-500 @else border-slate-300 @enderror"
                           placeholder="Finance / HR">
                    @error('department')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone_number" class="block text-sm font-medium text-slate-700 mb-1">Nomor HP / WhatsApp</label>
                    <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('phone_number') border-red-500 @else border-slate-300 @enderror"
                           placeholder="08123456789">
                    @error('phone_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('password') border-red-500 @else border-slate-300 @enderror"
                       placeholder="Minimal 8 karakter">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="Ulangi password">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition shadow-md">
                Daftar Akun
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-slate-600">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Masuk di sini</a>
        </div>
    </div>
</div>
@endsection