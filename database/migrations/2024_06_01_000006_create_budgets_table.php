<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel BUDGET sesuai ERD (relasi 1-1 dengan TRIP):
     * id_budget (PK), id_trip (FK), transportasi, akomodasi, tiket, konsumsi, biaya_lain, total_anggaran
     */
    public function up(): void
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id('id_budget');
            $table->foreignId('id_trip')
                ->unique()
                ->constrained(table: 'trips', column: 'id_trip')
                ->onDelete('cascade');
            $table->decimal('transportasi', 12, 2)->default(0);
            $table->decimal('akomodasi', 12, 2)->default(0);
            $table->decimal('tiket', 12, 2)->default(0);
            $table->decimal('konsumsi', 12, 2)->default(0);
            $table->decimal('biaya_lain', 12, 2)->default(0);
            $table->decimal('total_anggaran', 14, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
