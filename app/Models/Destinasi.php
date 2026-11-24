<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    protected $table = 'destinasi';
    protected $primaryKey = 'id_destinasi';

    protected $fillable = [
        'nama_destinasi',
        'deskripsi',
        'lokasi',
        'foto',
        'harga_tiket',
        'id_kategori',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function itineraries()
    {
        return $this->hasMany(Itinerary::class, 'id_destinasi', 'id_destinasi');
    }

    /**
     * Resolves the primary photo URL.
     * Prioritizes uploaded photos, then curated high-resolution photography,
     * with an inline SVG fallback that works 100% offline.
     */
    public function getFotoUrlAttribute(): string
    {
        if (!empty($this->foto)) {
            if (str_starts_with($this->foto, 'http://') || str_starts_with($this->foto, 'https://')) {
                return $this->foto;
            }
            return asset('storage/' . ltrim($this->foto, '/'));
        }

        $defaults = [
            'Pantai Kuta' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=800&q=80',
            'Gunung Bromo' => 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=800&q=80',
            'Candi Borobudur' => 'https://images.unsplash.com/photo-1596402184320-417e7178b2cd?auto=format&fit=crop&w=800&q=80',
            'Malioboro' => 'https://images.unsplash.com/photo-1570789210967-2cac24afeb00?auto=format&fit=crop&w=800&q=80',
            'Danau Toba' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80',
            'Pantai Kelingking' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=800&q=80',
        ];

        return $defaults[$this->nama_destinasi] ?? $this->svg_fallback;
    }

    /**
     * Generates a modern gradient SVG fallback data URI that works 100% offline.
     */
    public function getSvgFallbackAttribute(): string
    {
        $name = htmlspecialchars($this->nama_destinasi ?? 'TripPlanner');
        $kategori = htmlspecialchars($this->kategori->nama_kategori ?? 'Wisata');

        $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 500" width="800" height="500">'
            . '<defs>'
            . '<linearGradient id="bgGrad" x1="0%" y1="0%" x2="100%" y2="100%">'
            . '<stop offset="0%" stop-color="#4F46E5"/>'
            . '<stop offset="100%" stop-color="#7C3AED"/>'
            . '</linearGradient>'
            . '</defs>'
            . '<rect width="800" height="500" fill="url(#bgGrad)"/>'
            . '<circle cx="400" cy="200" r="70" fill="rgba(255,255,255,0.12)"/>'
            . '<text x="400" y="218" font-family="system-ui,-apple-system,sans-serif" font-size="52" text-anchor="middle" fill="#ffffff">🏝️</text>'
            . '<text x="400" y="325" font-family="system-ui,-apple-system,sans-serif" font-size="28" font-weight="700" text-anchor="middle" fill="#ffffff">' . $name . '</text>'
            . '<text x="400" y="365" font-family="system-ui,-apple-system,sans-serif" font-size="18" text-anchor="middle" fill="rgba(255,255,255,0.85)">' . $kategori . '</text>'
            . '</svg>';

        return 'data:image/svg+xml;utf8,' . rawurlencode($svg);
    }
}
