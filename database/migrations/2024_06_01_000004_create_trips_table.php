<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel TRIP sesuai ERD:
     * id_trip (PK), nama_trip, tanggal_mulai, tanggal_selesai, status, id_user (FK)
     */
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id('id_trip');
            $table->string('nama_trip');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('status')->default('Direncanakan'); // Direncanakan | Berlangsung | Selesai
            $table->foreignId('id_user')
                ->constrained(table: 'users', column: 'id_user')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
