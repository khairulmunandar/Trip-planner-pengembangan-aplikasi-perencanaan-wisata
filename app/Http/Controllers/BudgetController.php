<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    /**
     * Mengisi / memperbarui anggaran (Budget) untuk sebuah Trip - use case Pengunjung.
     * Budget bersifat 1-1 terhadap Trip, jadi dipakai updateOrCreate.
     */
    public function store(Request $request, Trip $trip)
    {
        abort_if((int) $trip->id_user !== (int) Auth::id(), 403);

        $data = $request->validate([
            'transportasi' => ['nullable', 'numeric', 'min:0'],
            'akomodasi' => ['nullable', 'numeric', 'min:0'],
            'tiket' => ['nullable', 'numeric', 'min:0'],
            'konsumsi' => ['nullable', 'numeric', 'min:0'],
            'biaya_lain' => ['nullable', 'numeric', 'min:0'],
        ]);

        foreach (['transportasi', 'akomodasi', 'tiket', 'konsumsi', 'biaya_lain'] as $field) {
            $data[$field] = $data[$field] ?? 0;
        }

        $total = $data['transportasi'] + $data['akomodasi'] + $data['tiket']
            + $data['konsumsi'] + $data['biaya_lain'];

        Budget::updateOrCreate(
            ['id_trip' => $trip->id_trip],
            array_merge($data, ['total_anggaran' => $total])
        );

        return back()->with('success', 'Anggaran perjalanan berhasil disimpan.');
    }
}
