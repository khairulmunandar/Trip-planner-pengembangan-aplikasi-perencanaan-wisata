<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $table = 'trips';
    protected $primaryKey = 'id_trip';

    protected $fillable = [
        'nama_trip',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'id_user',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function itineraries()
    {
        return $this->hasMany(Itinerary::class, 'id_trip', 'id_trip')
            ->orderBy('tanggal_kunjungan')
            ->orderBy('jam_kunjungan');
    }

    public function budget()
    {
        return $this->hasOne(Budget::class, 'id_trip', 'id_trip');
    }
}
