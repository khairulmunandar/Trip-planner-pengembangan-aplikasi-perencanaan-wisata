# TripPlanner

TripPlanner adalah aplikasi perencanaan perjalanan berbasis Laravel yang membantu pengguna menemukan destinasi wisata, menyusun itinerary harian, dan mengelola anggaran perjalanan dalam satu tempat.

<p>
  <a href="https://tripplanner.ct.ws/?i=1" target="_blank">
    <img src="https://img.shields.io/badge/Buka%20Website%20TripPlanner-4F46E5?style=for-the-badge&logo=googlechrome&logoColor=white" alt="Buka Website TripPlanner">
  </a>
</p>

## Fitur

- Registrasi dan login pengguna
- Pencarian serta detail destinasi wisata
- Pengelompokan destinasi berdasarkan kategori
- Pembuatan dan pengelolaan rencana perjalanan
- Penyusunan itinerary harian
- Pengelolaan anggaran perjalanan
- Panel administrasi untuk kategori dan destinasi
- Autentikasi khusus administrator

## Teknologi

- PHP 8.2+
- Laravel 12
- Tailwind CSS 4
- Vite
- SQLite atau database relasional lain
- Blade Template Engine

## Persyaratan

Pastikan perangkat telah memasang:

- PHP 8.2 atau lebih baru
- Composer
- Node.js dan npm
- Ekstensi PHP yang dibutuhkan oleh Laravel

## Instalasi Lokal

1. Masuk ke folder proyek:

   ```bash
   cd tripplanner-main
   ```

2. Instal dependensi PHP:

   ```bash
   composer install
   ```

3. Salin konfigurasi lingkungan:

   ```bash
   cp .env.example .env
   ```

   Pada Windows Command Prompt, gunakan:

   ```bash
   copy .env.example .env
   ```

4. Buat application key:

   ```bash
   php artisan key:generate
   ```

5. Buat database SQLite:

   ```bash
   type nul > database\database.sqlite
   ```

   Jika file tersebut sudah tersedia, langkah ini tidak perlu dilakukan.

6. Jalankan migrasi dan seeder:

   ```bash
   php artisan migrate --seed
   ```

7. Buat storage link:

   ```bash
   php artisan storage:link
   ```

8. Instal dependensi frontend:

   ```bash
   npm install
   ```

9. Jalankan aplikasi:

   ```bash
   composer run dev
   ```

10. Buka alamat yang ditampilkan oleh Laravel, biasanya:

    ```text
    http://127.0.0.1:8000
    ```

## Struktur Utama

- `app/` - Controller, model, dan middleware aplikasi
- `routes/web.php` - Rute pengguna dan administrator
- `resources/views/` - Tampilan Blade
- `database/migrations/` - Struktur tabel database
- `database/seeders/` - Data awal aplikasi
- `public/` - Asset publik dan entry point aplikasi

## Perintah Pengujian

```bash
php artisan test
```

## Lisensi

Proyek ini dikembangkan dengan Laravel dan menggunakan lisensi MIT.
