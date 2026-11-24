<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            ['nama_kategori' => 'Pantai', 'deskripsi' => 'Destinasi wisata pantai dan laut.'],
            ['nama_kategori' => 'Gunung', 'deskripsi' => 'Destinasi wisata pegunungan dan alam.'],
            ['nama_kategori' => 'Budaya', 'deskripsi' => 'Destinasi wisata sejarah dan budaya.'],
            ['nama_kategori' => 'Kuliner', 'deskripsi' => 'Destinasi wisata pusat kuliner khas daerah.'],
        ];

        foreach ($kategori as $item) {
            Kategori::updateOrCreate(['nama_kategori' => $item['nama_kategori']], $item);
        }
    }
}
