<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel DESTINASI sesuai ERD:
     * id_destinasi (PK), nama_destinasi, deskripsi, lokasi, foto, harga_tiket, id_kategori (FK)
     */
    public function up(): void
    {
        Schema::create('destinasi', function (Blueprint $table) {
            $table->id('id_destinasi');
            $table->string('nama_destinasi');
            $table->text('deskripsi')->nullable();
            $table->string('lokasi'); // alamat / nama tempat, dipakai untuk tampilkan peta
            $table->string('foto')->nullable(); // path file di storage
            $table->decimal('harga_tiket', 12, 2)->default(0);
            $table->foreignId('id_kategori')
                ->constrained(table: 'kategori', column: 'id_kategori')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinasi');
    }
};
