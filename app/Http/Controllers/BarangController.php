<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\FakturItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga_beli' => 'required|numeric',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        Barang::create($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga_beli' => 'required|numeric',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($barang->foto) {
                Storage::disk('public')->delete($barang->foto);
            }
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $barang->update($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate.');
    }

    public function destroy(Barang $barang)
{
    // Cek apakah barang ada di dalam faktur
    if (FakturItem::where('barang_id', $barang->id)->exists()) {
        return redirect()->back()->with('error', 'Barang tidak bisa dihapus karena sudah ada di dalam faktur.');
    }

    // Jika barang tidak ada di dalam faktur, hapus foto jika ada
    if ($barang->foto) {
        Storage::disk('public')->delete($barang->foto);
    }

    // Hapus barang
    $barang->delete();

    return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
}



    public function show($id)
{
    $barang = Barang::findOrFail($id);
    return view('barang.show', compact('barang'));
}

}
