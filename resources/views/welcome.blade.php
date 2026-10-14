@extends('layouts.app')

@section('title', 'Beranda - IT-Go System')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 md:p-12 text-center md:text-left flex flex-col md:flex-row items-center justify-between">
        <div class="md:w-1/2 space-y-4">
            <span class="bg-blue-100 text-blue-700 text-xs font-bold uppercase px-3 py-1 rounded-full">Sistem Layanan Internal</span>
            <h1 class="text-3xl md:text-5xl font-extrabold text-blue-950 leading-tight">
                Layanan Cepat Pelaporan Kerusakan Komputer
            </h1>
            <p class="text-slate-600 leading-relaxed">
                Laporkan masalah PC, laptop, jaringan, atau peripheral Anda langsung ke Tim IT Support. Monitoring progres perbaikan secara *real-time*.
            </p>
            <div class="pt-2 flex flex-wrap gap-3 justify-center md:justify-start">
                <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition">
                    Buat Laporan Sekarang
                </a>
                <a href="#" class="border border-blue-600 text-blue-600 hover:bg-blue-50 font-semibold px-6 py-3 rounded-lg transition">
                    Cek Status Tiket
                </a>
            </div>
        </div>
        <div class="md:w-5/12 mt-8 md:mt-0 flex justify-center">
            <div class="w-64 h-64 bg-blue-100 rounded-full flex items-center justify-center border-4 border-blue-200 shadow-inner">
                <svg class="w-32 h-32 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
        </div>
    </div>
</div>
@endsection