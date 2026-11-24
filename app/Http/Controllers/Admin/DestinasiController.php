<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinasiController extends Controller
{
    /**
     * Use case: Mengelola data destinasi.
     */
    public function index()
    {
        $destinasi = Destinasi::with('kategori')->orderBy('nama_destinasi')->paginate(10);

        return view('admin.destinasi.index', compact('destinasi'));
    }

    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('admin.destinasi.create', compact('kategori'));
    }

    /**
     * Use case: Menyimpan perubahan data.
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('destinasi', 'public');
        } else {
            unset($data['foto']);
        }

        Destinasi::create($data);

        return redirect()->route('admin.destinasi.index')
            ->with('success', 'Destinasi berhasil disimpan.');
    }

    public function edit(Destinasi $destinasi)
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('admin.destinasi.edit', compact('destinasi', 'kategori'));
    }

    public function update(Request $request, Destinasi $destinasi)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('foto')) {
            if ($destinasi->foto && Storage::disk('public')->exists($destinasi->foto)) {
                Storage::disk('public')->delete($destinasi->foto);
            }
            $data['foto'] = $request->file('foto')->store('destinasi', 'public');
        } else {
            unset($data['foto']);
        }

        $destinasi->update($data);

        return redirect()->route('admin.destinasi.index')
            ->with('success', 'Destinasi berhasil diperbarui.');
    }

    public function destroy(Destinasi $destinasi)
    {
        if ($destinasi->foto && Storage::disk('public')->exists($destinasi->foto)) {
            Storage::disk('public')->delete($destinasi->foto);
        }

        $destinasi->delete();

        return redirect()->route('admin.destinasi.index')
            ->with('success', 'Destinasi berhasil dihapus.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'nama_destinasi' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'lokasi' => ['required', 'string', 'max:255'],
            'harga_tiket' => ['required', 'numeric', 'min:0'],
            'id_kategori' => ['required', 'exists:kategori,id_kategori'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);
    }
}
