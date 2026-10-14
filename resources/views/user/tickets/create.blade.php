@extends('layouts.app')

@section('title', 'Buat Laporan Kerusakan - IT-Go')

@section('content')
<div class="max-w-3xl mx-auto px-4">
    <div class="mb-6">
        <a href="{{ route('user.tickets.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center gap-1">
            &larr; Kembali ke Daftar Tiket Saya
        </a>
        <h1 class="text-2xl font-bold text-blue-950 mt-2">Buat Laporan Kerusakan Komputer</h1>
        <p class="text-slate-500 text-sm">Isi formulir di bawah ini dengan lengkap agar tim IT dapat segera menangani.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8">
        <form method="POST" action="{{ route('user.tickets.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="category_id" class="block text-sm font-medium text-slate-700 mb-1">Kategori Kerusakan <span class="text-red-500">*</span></label>
                    <select id="category_id" name="category_id" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('category_id') border-red-500 @else border-slate-300 @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="priority" class="block text-sm font-medium text-slate-700 mb-1">Tingkat Urgensi / Prioritas <span class="text-red-500">*</span></label>
                    <select id="priority" name="priority" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('priority') border-red-500 @else border-slate-300 @enderror">
                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Rendah (Pekerjaan tidak terganggu)</option>
                        <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>Sedang (Pekerjaan sedikit terganggu)</option>
                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Tinggi (Pekerjaan terhenti sementara)</option>
                        <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent (Sistem kritis mati/down)</option>
                    </select>
                    @error('priority') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="device_name" class="block text-sm font-medium text-slate-700 mb-1">Nama / ID Perangkat <span class="text-red-500">*</span></label>
                    <input type="text" id="device_name" name="device_name" value="{{ old('device_name') }}" required
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('device_name') border-red-500 @else border-slate-300 @enderror"
                           placeholder="Contoh: PC-FINANCE-02 / Laptop Lenovo ThinkPad">
                    @error('device_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-slate-700 mb-1">Lokasi Perangkat <span class="text-red-500">*</span></label>
                    <input type="text" id="location" name="location" value="{{ old('location') }}" required
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('location') border-red-500 @else border-slate-300 @enderror"
                           placeholder="Contoh: Gedung A, Lantai 2, Ruang HR">
                    @error('location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="title" class="block text-sm font-medium text-slate-700 mb-1">Judul Ringkas Kerusakan <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('title') border-red-500 @else border-slate-300 @enderror"
                       placeholder="Contoh: Monitor tidak menyala dan bergaris biru">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Detail Masalah <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" rows="4" required
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('description') border-red-500 @else border-slate-300 @enderror"
                          placeholder="Jelaskan kronologi kendala, pesan error yang muncul, atau kondisi fisik perangkat..."></textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="attachment" class="block text-sm font-medium text-slate-700 mb-1">Foto / Bukti Kerusakan (Opsional)</label>
                <input type="file" id="attachment" name="attachment" accept="image/*"
                       class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, JPEG. Ukuran maksimal: 2MB.</p>
                @error('attachment') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-2 flex items-center justify-end gap-3">
                <a href="{{ route('user.tickets.index') }}" class="px-5 py-2.5 rounded-lg border border-slate-300 text-slate-600 hover:bg-slate-50 font-medium text-sm transition">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md transition">
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection