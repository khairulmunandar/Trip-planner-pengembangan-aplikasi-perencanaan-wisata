<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DestinasiController extends Controller
{
    /**
     * Melihat daftar destinasi wisata + fitur cari/filter (use case Pengunjung).
     */
    public function index(Request $request)
    {
        $query = Destinasi::with('kategori');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('nama_destinasi', 'like', '%' . $q . '%')
                    ->orWhere('lokasi', 'like', '%' . $q . '%')
                    ->orWhere('deskripsi', 'like', '%' . $q . '%');
            });
        }

        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        $destinasi = $query->orderBy('nama_destinasi')->paginate(9)->withQueryString();
        $kategori = Kategori::all();

        return view('destinasi.index', compact('destinasi', 'kategori'));
    }

    /**
     * Melihat detail destinasi + lokasi pada peta (use case Pengunjung).
     */
    public function show(Destinasi $destinasi)
    {
        $destinasi->load('kategori');

        return view('destinasi.show', compact('destinasi'));
    }
}
