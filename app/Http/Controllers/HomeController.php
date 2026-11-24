<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Kategori;

class HomeController extends Controller
{
    /**
     * Halaman utama: tampilkan beberapa destinasi unggulan & kategori.
     */
    public function index()
    {
        $destinasiUnggulan = Destinasi::with('kategori')->latest()->take(6)->get();
        $kategori = Kategori::withCount('destinasi')->get();

        return view('home', compact('destinasiUnggulan', 'kategori'));
    }
}
