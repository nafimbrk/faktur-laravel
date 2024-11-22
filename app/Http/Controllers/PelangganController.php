<?php

namespace App\Http\Controllers;

use App\Models\Faktur;
use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'nomor_telepon' => 'required|string|max:20',
            'informasi_tambahan' => 'nullable|string',
            // 'tax_reg' => 'nullable|string|max:50',
            'alamat' => 'required|string|max:255',
            'kota' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',
            'provinsi' => 'required|string|max:100',
            'negara' => 'required|string|max:100',
            'alamat_pengiriman' => 'nullable|string|max:255',
            'kota_pengiriman' => 'nullable|string|max:100',
            'kode_pos_pengiriman' => 'nullable|string|max:10',
            'provinsi_pengiriman' => 'nullable|string|max:100',
            'negara_pengiriman' => 'nullable|string|max:100',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'nomor_telepon' => 'required|string|max:20',
            'informasi_tambahan' => 'nullable|string',
            // 'tax_reg' => 'nullable|string|max:50',
            'alamat' => 'required|string|max:255',
            'kota' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',
            'provinsi' => 'required|string|max:100',
            'negara' => 'required|string|max:100',
            'alamat_pengiriman' => 'nullable|string|max:255',
            'kota_pengiriman' => 'nullable|string|max:100',
            'kode_pos_pengiriman' => 'nullable|string|max:10',
            'provinsi_pengiriman' => 'nullable|string|max:100',
            'negara_pengiriman' => 'nullable|string|max:100',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function destroy($id)
{
    $pelanggan = Pelanggan::findOrFail($id);

    // Cek apakah pelanggan memiliki faktur terkait
    if ($pelanggan->fakturs()->exists()) {
        return redirect()->route('pelanggan.index')->with('error', 'Pelanggan tidak dapat dihapus karena masih memiliki faktur.');
    }

    // Jika tidak ada faktur, hapus pelanggan
    $pelanggan->delete();

    return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus.');
}


    public function show($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.show', compact('pelanggan'));
    }


    // Controller PelangganController
public function faktur($pelangganId)
{
    $pelanggan = Pelanggan::findOrFail($pelangganId);
    // Mengambil semua faktur milik pelanggan, diurutkan secara descending berdasarkan created_at
    $fakturs = Faktur::where('pelanggan_id', $pelangganId)
                ->orderBy('created_at', 'desc')
                ->get();

    return view('pelanggan.faktur', compact('pelanggan', 'fakturs'));
}


}
