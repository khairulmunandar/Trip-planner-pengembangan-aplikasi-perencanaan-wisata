<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $table = 'budgets';
    protected $primaryKey = 'id_budget';

    protected $fillable = [
        'id_trip',
        'transportasi',
        'akomodasi',
        'tiket',
        'konsumsi',
        'biaya_lain',
        'total_anggaran',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'id_trip', 'id_trip');
    }

    public function hitungTotal(): float
    {
        return (float) $this->transportasi
            + (float) $this->akomodasi
            + (float) $this->tiket
            + (float) $this->konsumsi
            + (float) $this->biaya_lain;
    }
}
