<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    /**
     * Daftar rencana perjalanan (Trip) milik user yang login.
     */
    public function index()
    {
        $trips = Trip::where('id_user', Auth::id())
            ->withCount('itineraries')
            ->with('budget')
            ->latest('id_trip')
            ->get();

        return view('trips.index', compact('trips'));
    }

    public function create()
    {
        return view('trips.create');
    }

    /**
     * Membuat rencana perjalanan (Trip) - use case Pengunjung.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_trip' => ['required', 'string', 'max:255'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
        ]);

        $data['id_user'] = Auth::id();
        $data['status'] = 'Direncanakan';

        $trip = Trip::create($data);

        return redirect()->route('trips.show', $trip->id_trip)
            ->with('success', 'Rencana perjalanan berhasil dibuat. Sekarang atur itinerary dan anggarannya.');
    }

    /**
     * Detail Trip: kelola itinerary (jadwal kunjungan) & budget - use case Pengunjung.
     */
    public function show(Trip $trip)
    {
        $this->authorizeTrip($trip);

        $trip->load(['itineraries.destinasi', 'budget']);
        $destinasiList = \App\Models\Destinasi::orderBy('nama_destinasi')->get();

        return view('trips.show', compact('trip', 'destinasiList'));
    }

    public function edit(Trip $trip)
    {
        $this->authorizeTrip($trip);

        return view('trips.edit', compact('trip'));
    }

    public function update(Request $request, Trip $trip)
    {
        $this->authorizeTrip($trip);

        $data = $request->validate([
            'nama_trip' => ['required', 'string', 'max:255'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
            'status' => ['required', 'in:Direncanakan,Berlangsung,Selesai'],
        ]);

        $trip->update($data);

        return redirect()->route('trips.show', $trip->id_trip)
            ->with('success', 'Rencana perjalanan berhasil diperbarui.');
    }

    public function destroy(Trip $trip)
    {
        $this->authorizeTrip($trip);

        $trip->delete();

        return redirect()->route('trips.index')
            ->with('success', 'Rencana perjalanan berhasil dihapus.');
    }

    /**
     * Pastikan Trip yang diakses benar-benar milik user yang sedang login.
     */
    private function authorizeTrip(Trip $trip): void
    {
        abort_if((int) $trip->id_user !== (int) Auth::id(), 403, 'Anda tidak berhak mengakses trip ini.');
    }
}
