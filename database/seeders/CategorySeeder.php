<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Hardware / Perangkat Keras',
                'description' => 'Kerusakan fisik seperti monitor mati, PC tidak menyala, RAM corrupt, keyboard/mouse rusak, HDD error.',
            ],
            [
                'name' => 'Software / Aplikasi',
                'description' => 'Masalah sistem operasi (Windows/Linux), aplikasi kantor crash, gagal instalasi software, virus/malware.',
            ],
            [
                'name' => 'Jaringan & Internet',
                'description' => 'Koneksi Wi-Fi terputus, kabel LAN rusak, VPN kantor bermasalah, tidak bisa akses server lokal.',
            ],
            [
                'name' => 'Printer & Scanner',
                'description' => 'Printer offline, paper jam, tinta habis, hasil cetak bergaris, scanner tidak terdeteksi.',
            ],
            [
                'name' => 'Akun & Akses (Account & Access)',
                'description' => 'Lupa password email kantor, terkunci dari sistem internal, permintaan hak akses folder/drive.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
