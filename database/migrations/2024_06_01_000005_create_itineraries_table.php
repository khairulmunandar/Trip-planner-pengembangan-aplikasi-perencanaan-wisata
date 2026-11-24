<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel ITINERARY sesuai ERD:
     * id_itinerary (PK), tanggal_kunjungan, jam_kunjungan, catatan, id_trip (FK), id_destinasi (FK)
     */
    public function up(): void
    {
        Schema::create('itineraries', function (Blueprint $table) {
            $table->id('id_itinerary');
            $table->date('tanggal_kunjungan');
            $table->time('jam_kunjungan')->nullable();
            $table->text('catatan')->nullable();
            $table->foreignId('id_trip')
                ->constrained(table: 'trips', column: 'id_trip')
                ->onDelete('cascade');
            $table->foreignId('id_destinasi')
                ->constrained(table: 'destinasi', column: 'id_destinasi')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('itineraries');
    }
};
