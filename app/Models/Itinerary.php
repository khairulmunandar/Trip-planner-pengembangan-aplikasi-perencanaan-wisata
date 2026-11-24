<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    protected $table = 'itineraries';
    protected $primaryKey = 'id_itinerary';

    protected $fillable = [
        'tanggal_kunjungan',
        'jam_kunjungan',
        'catatan',
        'id_trip',
        'id_destinasi',
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'id_trip', 'id_trip');
    }

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class, 'id_destinasi', 'id_destinasi');
    }
}
