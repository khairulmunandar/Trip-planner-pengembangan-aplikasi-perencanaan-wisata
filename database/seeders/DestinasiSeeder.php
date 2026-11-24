<?php

namespace Database\Seeders;

use App\Models\Destinasi;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class DestinasiSeeder extends Seeder
{
    public function run(): void
    {
        $pantai = Kategori::where('nama_kategori', 'Pantai')->first();
        $gunung = Kategori::where('nama_kategori', 'Gunung')->first();
        $budaya = Kategori::where('nama_kategori', 'Budaya')->first();
        $kuliner = Kategori::where('nama_kategori', 'Kuliner')->first();

        $data = [
            [
                'nama_destinasi' => 'Pantai Kuta',
                'deskripsi' => 'Pantai populer di Bali dengan sunset yang indah.',
                'lokasi' => 'Pantai Kuta, Bali',
                'harga_tiket' => 0,
                'id_kategori' => $pantai->id_kategori,
            ],
            [
                'nama_destinasi' => 'Gunung Bromo',
                'deskripsi' => 'Gunung berapi aktif dengan pemandangan matahari terbit terbaik.',
                'lokasi' => 'Gunung Bromo, Jawa Timur',
                'harga_tiket' => 35000,
                'id_kategori' => $gunung->id_kategori,
            ],
            [
                'nama_destinasi' => 'Candi Borobudur',
                'deskripsi' => 'Candi Buddha terbesar di dunia, warisan budaya UNESCO.',
                'lokasi' => 'Candi Borobudur, Magelang, Jawa Tengah',
                'harga_tiket' => 50000,
                'id_kategori' => $budaya->id_kategori,
            ],
            [
                'nama_destinasi' => 'Malioboro',
                'deskripsi' => 'Pusat perbelanjaan dan kuliner khas Yogyakarta.',
                'lokasi' => 'Jalan Malioboro, Yogyakarta',
                'harga_tiket' => 0,
                'id_kategori' => $kuliner->id_kategori,
            ],
            [
                'nama_destinasi' => 'Danau Toba',
                'deskripsi' => 'Danau vulkanik terbesar di Asia Tenggara.',
                'lokasi' => 'Danau Toba, Sumatera Utara',
                'harga_tiket' => 0,
                'id_kategori' => $gunung->id_kategori,
            ],
            [
                'nama_destinasi' => 'Pantai Kelingking',
                'deskripsi' => 'Pantai dengan tebing ikonik berbentuk T-Rex di Nusa Penida.',
                'lokasi' => 'Pantai Kelingking, Nusa Penida, Bali',
                'harga_tiket' => 10000,
                'id_kategori' => $pantai->id_kategori,
            ],
        ];

        foreach ($data as $item) {
            Destinasi::updateOrCreate(['nama_destinasi' => $item['nama_destinasi']], $item);
        }
    }
}
