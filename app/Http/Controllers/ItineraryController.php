<?php

namespace App\Http\Controllers;

use App\Models\Itinerary;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItineraryController extends Controller
{
    /**
     * Menambahkan destinasi & jadwal kunjungan ke dalam Trip (itinerary) - use case Pengunjung.
     */
    public function store(Request $request, Trip $trip)
    {
        abort_if((int) $trip->id_user !== (int) Auth::id(), 403);

        $data = $request->validate([
            'id_destinasi' => ['required', 'exists:destinasi,id_destinasi'],
            'tanggal_kunjungan' => ['required', 'date'],
            'jam_kunjungan' => ['nullable', 'regex:/^\d{1,2}:\d{2}(:\d{2})?$/'],
            'catatan' => ['nullable', 'string'],
        ]);

        if (!empty($data['jam_kunjungan'])) {
            $data['jam_kunjungan'] = substr($data['jam_kunjungan'], 0, 5);
        }

        $data['id_trip'] = $trip->id_trip;

        Itinerary::create($data);

        return back()->with('success', 'Destinasi berhasil ditambahkan ke itinerary.');
    }

    public function destroy(Trip $trip, Itinerary $itinerary)
    {
        abort_if((int) $trip->id_user !== (int) Auth::id(), 403);
        abort_if((int) $itinerary->id_trip !== (int) $trip->id_trip, 404);

        $itinerary->delete();

        return back()->with('success', 'Item itinerary berhasil dihapus.');
    }
}
