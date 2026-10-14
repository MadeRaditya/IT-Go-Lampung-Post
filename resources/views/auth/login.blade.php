@extends('layouts.app')

@section('title', 'Masuk - IT-Go')

@section('content')
<div class="max-w-md mx-auto px-4">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-blue-950">Masuk ke IT-Go</h2>
            <p class="text-slate-500 text-sm mt-1">Silakan masuk menggunakan akun karyawan Anda</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email Kantor</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('email') border-red-500 @else border-slate-300 @enderror"
                       placeholder="nama@company.com">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('password') border-red-500 @else border-slate-300 @enderror"
                       placeholder="••••••••">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="ml-2">Ingat Saya</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition shadow-md">
                Masuk
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-slate-600">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Daftar sekarang</a>
        </div>
    </div>
</div>
@endsection