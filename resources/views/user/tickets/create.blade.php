@extends('layouts.app')

@section('title', 'Buat Laporan Kerusakan Komputer - IT-Go')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div>
            <a href="{{ route('user.tickets.index') }}"
                class="inline-flex items-center gap-1.5 text-slate-400 hover:text-white text-xs font-semibold uppercase tracking-wider transition mb-2">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Tiket Saya
            </a>
            <h1 class="text-xl sm:text-2xl font-bold text-white tracking-tight">Formulir Laporan Kendala IT</h1>
            <p class="text-slate-400 text-xs sm:text-sm mt-0.5">
                Lengkapi rincian kendala di bawah ini. Tim teknisi IT Support akan segera merespon tiket Anda.
            </p>
        </div>

        {{-- Preset Chips --}}
        <div class="bg-[#10172a] rounded-2xl p-4 sm:p-5 border border-[#1e293b] shadow-xs">
            <div class="flex items-center justify-between mb-2.5">
                <span class="text-xs font-semibold text-blue-400">Pilihan Cepat Masalah Umum:</span>
                <span class="text-[11px] text-slate-500">Klik untuk isi otomatis</span>
            </div>
            <div class="flex flex-wrap gap-1.5 sm:gap-2 text-xs">
                <button type="button"
                    onclick="applyPreset('hardware', 'Layar Monitor PC Mati / Tidak Tampil', 'PC masih menyala (lampu indikator hidup), tetapi layar monitor mati total dan berwarna hitam. Sudah dicoba tekan tombol power monitor namun tetap tidak muncul tampilan.', 'PC Desktop')"
                    class="bg-[#162036] hover:bg-blue-600 hover:text-white text-slate-300 font-medium px-2.5 py-1.5 rounded-lg border border-[#1e293b] transition">
                    Monitor PC Mati
                </button>
                <button type="button"
                    onclick="applyPreset('printer', 'Printer Macet / Paper Jam / Tidak Merespons', 'Printer tidak mau menarik kertas dan lampu indikator berkedip merah / peringatan paper jam pada komputer. Perintah cetak dokumen tertahan.', 'Printer Divisi')"
                    class="bg-[#162036] hover:bg-blue-600 hover:text-white text-slate-300 font-medium px-2.5 py-1.5 rounded-lg border border-[#1e293b] transition">
                    Printer Macet
                </button>
                <button type="button"
                    onclick="applyPreset('jaringan', 'Koneksi Wi-Fi / Internet Terputus', 'Komputer tidak dapat terhubung ke Wi-Fi kantor dan muncul tanda seru kuning / no internet access. Pekerjaan input data terhambat.', 'Laptop / PC Meja')"
                    class="bg-[#162036] hover:bg-blue-600 hover:text-white text-slate-300 font-medium px-2.5 py-1.5 rounded-lg border border-[#1e293b] transition">
                    Wi-Fi Terputus
                </button>
                <button type="button"
                    onclick="applyPreset('akun', 'Lupa Password / Akun Email Terkunci', 'Tidak bisa login ke akun email perusahaan / akun sistem kantor karena lupa password atau muncul notifikasi akun terkunci. Mohon bantuan reset password.', 'Akun Pengguna')"
                    class="bg-[#162036] hover:bg-blue-600 hover:text-white text-slate-300 font-medium px-2.5 py-1.5 rounded-lg border border-[#1e293b] transition">
                    Reset Password Akun
                </button>
                <button type="button"
                    onclick="applyPreset('software', 'Aplikasi Kantor Hang / Sering Crash', 'Aplikasi tiba-tiba tertutup sendiri saat sedang bekerja dan muncul pesan error. Sudah dicoba buka ulang namun masalah berulang.', 'PC Desktop / Laptop')"
                    class="bg-[#162036] hover:bg-blue-600 hover:text-white text-slate-300 font-medium px-2.5 py-1.5 rounded-lg border border-[#1e293b] transition">
                    Aplikasi Error
                </button>
            </div>
        </div>

        {{-- Main Form Card --}}
        <div class="bg-[#10172a] rounded-2xl border border-[#1e293b] shadow-xs p-5 sm:p-7">
            <form method="POST" action="{{ route('user.tickets.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Kategori & Urgensi --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="category_id" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">
                            Kategori Kerusakan <span class="text-rose-400">*</span>
                        </label>
                        <select id="category_id" name="category_id" required
                            class="w-full px-3.5 py-2.5 bg-[#0a0f1d] border rounded-xl text-xs sm:text-sm font-medium text-slate-200 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition @error('category_id') border-rose-500 @else border-[#1e293b] @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="priority" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">
                            Tingkat Urgensi <span class="text-rose-400">*</span>
                        </label>
                        <select id="priority" name="priority" required
                            class="w-full px-3.5 py-2.5 bg-[#0a0f1d] border rounded-xl text-xs sm:text-sm font-medium text-slate-200 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition @error('priority') border-rose-500 @else border-[#1e293b] @enderror">
                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Rendah - Tidak menghambat pekerjaan</option>
                            <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>Sedang - Terkendala sedikit / ada alternatif</option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Tinggi - Pekerjaan terhenti untuk saya</option>
                            <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Darurat - Gangguan server / sistem luas</option>
                        </select>
                        @error('priority')
                            <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Perangkat & Lokasi Ruangan --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="device_name" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">
                            Perangkat Bermasalah <span class="text-rose-400">*</span>
                        </label>
                        <input type="text" id="device_name" name="device_name" value="{{ old('device_name') }}" required
                            class="w-full px-3.5 py-2.5 bg-[#0a0f1d] border rounded-xl text-xs sm:text-sm font-medium text-slate-200 placeholder-slate-500 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition @error('device_name') border-rose-500 @else border-[#1e293b] @enderror"
                            placeholder="Contoh: PC Meja B-02 / Laptop Lenovo">
                        <div class="flex items-center gap-2 mt-1 text-[11px] text-slate-500">
                            <span>Contoh:</span>
                            <button type="button" onclick="document.getElementById('device_name').value='PC Desktop Kantor'" class="hover:underline text-blue-400">PC Kantor</button>
                            <span>•</span>
                            <button type="button" onclick="document.getElementById('device_name').value='Laptop Kerja'" class="hover:underline text-blue-400">Laptop</button>
                            <span>•</span>
                            <button type="button" onclick="document.getElementById('device_name').value='Printer Bersama'" class="hover:underline text-blue-400">Printer</button>
                        </div>
                        @error('device_name')
                            <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="location" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">
                            Lokasi Meja / Ruangan <span class="text-rose-400">*</span>
                        </label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}" required
                            class="w-full px-3.5 py-2.5 bg-[#0a0f1d] border rounded-xl text-xs sm:text-sm font-medium text-slate-200 placeholder-slate-500 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition @error('location') border-rose-500 @else border-[#1e293b] @enderror"
                            placeholder="Contoh: Lantai 2, Ruang Finance (Meja B-03)">
                        <p class="text-[11px] text-slate-500 mt-1">Sebutkan lantai dan ruangan agar teknisi mudah menemukan meja Anda.</p>
                        @error('location')
                            <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Judul Permasalahan --}}
                <div>
                    <label for="title" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">
                        Judul Singkat Masalah <span class="text-rose-400">*</span>
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                        class="w-full px-3.5 py-2.5 bg-[#0a0f1d] border rounded-xl text-xs sm:text-sm font-medium text-slate-200 placeholder-slate-500 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition @error('title') border-rose-500 @else border-[#1e293b] @enderror"
                        placeholder="Contoh: Monitor tidak mau menyala / Printer lampu merah">
                    @error('title')
                        <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi Kendala --}}
                <div>
                    <label for="description" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">
                        Penjelasan Lengkap Kendala <span class="text-rose-400">*</span>
                    </label>
                    <textarea id="description" name="description" rows="4" required
                        class="w-full px-3.5 py-2.5 bg-[#0a0f1d] border rounded-xl text-xs sm:text-sm font-medium text-slate-200 placeholder-slate-500 focus:bg-[#10172a] focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition leading-relaxed @error('description') border-rose-500 @else border-[#1e293b] @enderror"
                        placeholder="Ceritakan kapan kendala mulai terjadi dan langkah yang sudah Anda coba...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Lampiran Foto --}}
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Foto Bukti (Opsional)</label>
                        <span class="text-[11px] text-slate-500">JPG, PNG (Maks 2MB)</span>
                    </div>

                    <div id="drop-area"
                        class="border border-dashed border-[#1e293b] hover:border-blue-500 bg-[#0a0f1d] rounded-xl p-5 text-center transition cursor-pointer">
                        <input type="file" id="attachment" name="attachment" accept="image/*" class="hidden"
                            onchange="previewImage(this)">

                        <label for="attachment" class="cursor-pointer block">
                            <div id="upload-placeholder" class="space-y-1.5">
                                <div class="w-9 h-9 bg-[#162036] rounded-lg flex items-center justify-center mx-auto text-blue-400 border border-blue-900/40">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-slate-200 block">Pilih / Ambil Foto Layar Kendala</span>
                                <p class="text-[11px] text-slate-500">Foto fisik atau pesan error membantu teknisi menyiapkan solusi lebih cepat.</p>
                            </div>

                            <div id="preview-container" class="hidden flex-col items-center justify-center space-y-2">
                                <img id="image-preview" src="#" alt="Preview Foto"
                                    class="max-h-40 rounded-lg border border-[#1e293b] object-contain">
                                <span id="preview-filename" class="text-xs font-medium text-slate-300"></span>
                                <button type="button" onclick="removeImage(event)" class="text-xs text-rose-400 font-semibold hover:underline">
                                    Batalkan Foto
                                </button>
                            </div>
                        </label>
                    </div>
                    @error('attachment')
                        <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="pt-4 flex flex-col-reverse sm:flex-row items-center justify-end gap-2.5 border-t border-[#1e293b]">
                    <a href="{{ route('user.tickets.index') }}"
                        class="w-full sm:w-auto px-5 py-2.5 rounded-xl border border-[#1e293b] text-slate-300 font-medium text-xs sm:text-sm hover:bg-[#162036] text-center transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-500 text-white font-semibold px-6 py-2.5 rounded-xl text-xs sm:text-sm transition shadow-sm shadow-blue-500/25">
                        Kirim Laporan Kerusakan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function applyPreset(categoryType, title, desc, device) {
            document.getElementById('title').value = title;
            document.getElementById('description').value = desc;
            if (device) document.getElementById('device_name').value = device;

            const select = document.getElementById('category_id');
            for (let i = 0; i < select.options.length; i++) {
                const text = select.options[i].text.toLowerCase();
                if (categoryType === 'hardware' && text.includes('hardware')) select.selectedIndex = i;
                if (categoryType === 'printer' && text.includes('printer')) select.selectedIndex = i;
                if (categoryType === 'jaringan' && (text.includes('jaringan') || text.includes('internet'))) select.selectedIndex = i;
                if (categoryType === 'akun' && (text.includes('akun') || text.includes('akses'))) select.selectedIndex = i;
                if (categoryType === 'software' && (text.includes('software') || text.includes('aplikasi'))) select.selectedIndex = i;
            }
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-preview').src = e.target.result;
                    document.getElementById('preview-filename').textContent = input.files[0].name;
                    document.getElementById('upload-placeholder').classList.add('hidden');
                    document.getElementById('preview-container').classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage(e) {
            e.preventDefault();
            e.stopPropagation();
            const input = document.getElementById('attachment');
            input.value = '';
            document.getElementById('upload-placeholder').classList.remove('hidden');
            document.getElementById('preview-container').classList.add('hidden');
        }
    </script>
@endsection
