<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\Kategori;
use App\Models\Trip;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Use case: Melihat dashboard admin.
     */
    public function index()
    {
        $totalDestinasi = Destinasi::count();
        $totalKategori = Kategori::count();
        $totalUser = User::count();
        $totalTrip = Trip::count();

        return view('admin.dashboard', compact(
            'totalDestinasi',
            'totalKategori',
            'totalUser',
            'totalTrip'
        ));
    }
}
