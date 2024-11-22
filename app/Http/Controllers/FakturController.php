<?php

namespace App\Http\Controllers;

use App\Models\Faktur;
use App\Models\FakturItem;
use App\Models\Barang;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\FakturEmail; // Pastikan untuk meng-import kelas Mailable yang akan dibuat


class FakturController extends Controller
{
    public function index()
    {
        $fakturs = Faktur::with('pelanggan')->orderBy('created_at', 'desc')->get();
        return view('fakturs.index', compact('fakturs'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        $barangs = Barang::all();
        return view('fakturs.create', compact('pelanggans', 'barangs'));
    }

//     public function store(Request $request)
// {
//     // Validasi input
//     $request->validate([
//         'nomor_faktur' => 'required',
//         'tanggal' => 'required',
//         'jatuh_tempo' => 'required',
//         'tempo_hari' => 'required', // Tambah validasi untuk tempo_hari
//         'pelanggan_id' => 'required',
//         'catatan' => 'nullable',
//         'items' => 'required|array', // Pastikan items adalah array
//         'items.*.barang_id' => 'required|exists:barangs,id', // Validasi barang_id harus ada di tabel barangs
//         'items.*.kuantitas' => 'required|integer|min:1', // Validasi kuantitas harus integer dan minimal 1
//         'items.*.diskon' => 'nullable|numeric|min:0' // Validasi diskon, minimal 0 jika ada
//     ]);


//     $faktur = Faktur::create(array_merge(
//         $request->only([
//             'nomor_faktur', 'tanggal', 'jatuh_tempo', 'pelanggan_id', 'catatan', 'tempo_hari'
//         ]),
//         ['sisa_tagihan' => 0] // Berikan nilai awal pada kolom sisa_tagihan
//     ));
    

//     // Inisialisasi total
//     $total = 0;

//     // Loop setiap item yang dikirim melalui form
//     foreach ($request->items as $item) {
//         // Ambil data barang berdasarkan barang_id
//         $barang = Barang::findOrFail($item['barang_id']);
        
//         // Hitung subtotal per item (harga barang * kuantitas)
//         $harga_satuan = $barang->harga;
//         $kuantitas = $item['kuantitas'];
//         $subtotal = $harga_satuan * $kuantitas;

//         // Diskon jika ada
//         $diskon = isset($item['diskon']) ? $item['diskon'] : 0;
//         $subtotal -= $diskon;

//         // Pastikan subtotal tidak negatif
//         $subtotal = max(0, $subtotal);

//         // Tambahkan subtotal ke total faktur
//         $total += $subtotal;

//         // Simpan item ke dalam tabel faktur_items
//         $faktur->items()->create([
//             'barang_id' => $item['barang_id'],
//             'kuantitas' => $kuantitas,
//             'diskon' => $diskon,
//             'subtotal' => $subtotal, // Menyimpan subtotal yang sudah dikurangi diskon
//         ]);
//     }

//     // Update total di faktur setelah looping semua item
//     $faktur->update([
//         'total' => $total,
//         'sisa_tagihan' => $total, // Isi sisa_tagihan dengan total
//     ]);

//     // Redirect ke halaman index dengan pesan sukses
//     return redirect()->route('fakturs.index')->with('success', 'Faktur berhasil dibuat.');
// }

// public function store(Request $request)
// {
//     // Validasi input
//     $request->validate([
//         'nomor_faktur' => 'required',
//         'tanggal' => 'required|date',
//         'jatuh_tempo' => 'required|date',
//         'tempo_hari' => 'required|integer|min:1',
//         'pelanggan_id' => 'required|exists:pelanggans,id',
//         'catatan' => 'nullable|string',
//         'items' => 'required|array',
//         'items.*.barang_id' => 'required|exists:barangs,id',
//         'items.*.kuantitas' => 'required|integer|min:1',
//         'items.*.diskon' => 'nullable|numeric|min:0',
//         'items.*.pajak' => 'nullable|numeric|min:0',
//         'items.*.pajak_termasuk' => 'nullable|boolean',
//         'items.*.diskon_setelah_pajak' => 'nullable|boolean',
//         'label_pajak' => 'nullable|string',
//         'pajak' => 'nullable|numeric|min:0',
//         'diskon_faktur' => 'nullable|numeric|min:0',
//         'total' => 'required|numeric|min:0', // Tambahkan validasi untuk total
//     ]);

//     // Membuat faktur baru dengan total yang sudah dihitung di frontend
//     $faktur = Faktur::create(array_merge(
//         $request->only(['nomor_faktur', 'tanggal', 'jatuh_tempo', 'pelanggan_id', 'catatan', 'tempo_hari', 'label_pajak', 'pajak', 'diskon_faktur']),
//         [
//             'total' => $request->total, // Gunakan total yang diterima dari frontend
//             'sisa_tagihan' => $request->total, // Sisa tagihan diisi dengan total
//         ]
//     ));

//     // Loop setiap item yang dikirim melalui form
//     foreach ($request->items as $item) {
//         // Simpan item ke dalam tabel faktur_items
//         $faktur->items()->create([
//             'barang_id' => $item['barang_id'],
//             'kuantitas' => $item['kuantitas'],
//             'diskon' => $item['diskon'] ?? 0, // Pastikan diskon ada jika tidak diisi
//             'subtotal' => $item['subtotal'] ?? 0, // Gunakan subtotal dari frontend jika ada
//         ]);
//     }

//     // Redirect ke halaman index dengan pesan sukses
//     return redirect()->route('fakturs.index')->with('success', 'Faktur berhasil dibuat.');
// }











public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nomor_faktur' => 'required',
        'tanggal' => 'required|date',
        'jatuh_tempo' => 'required|date',
        'tempo_hari' => 'required|integer|min:1',
        'pelanggan_id' => 'required|exists:pelanggans,id',
        'catatan' => 'nullable|string',
        'items' => 'required|array',
        'items.*.barang_id' => 'required|exists:barangs,id',
        'items.*.kuantitas' => 'required|integer|min:1',
        'items.*.diskon' => 'nullable|numeric|min:0',
        'items.*.pajak' => 'nullable|numeric|min:0',
        'items.*.pajak_termasuk' => 'nullable|boolean',
        'items.*.diskon_setelah_pajak' => 'nullable|boolean',
        'items.*.subtotal' => 'required|numeric|min:0', // Pastikan subtotal diterima dari frontend
        'label_pajak' => 'nullable|string',
        'pajak' => 'nullable|numeric|min:0',
        'diskon_faktur' => 'nullable|numeric|min:0',
        'total' => 'required|numeric|min:0',
    ]);

    // Perhitungan keuntungan
    $totalKeuntungan = 0;

    // Loop setiap item untuk menghitung keuntungan
    foreach ($request->items as $item) {
        // Ambil data barang dari database untuk mendapatkan harga beli
        $barang = Barang::find($item['barang_id']);

        // Hitung harga jual per item dari subtotal
        $hargaJualPerItem = $item['subtotal'] / $item['kuantitas'];

        // Ambil harga beli barang
        $hargaBeli = $barang->harga_beli;

        // Hitung pajak dan diskon per item jika ada
        $pajakPerItem = isset($item['pajak']) ? ($hargaJualPerItem * $item['pajak'] / 100) : 0;
        $diskonPerItem = $item['diskon'] ?? 0;

        // Jika pajak termasuk, kurangi harga jual dengan pajak, baru hitung keuntungan
        if (isset($item['pajak_termasuk']) && $item['pajak_termasuk']) {
            $hargaJualPerItem -= $pajakPerItem;
        }

        // Hitung keuntungan per item dengan mengurangi harga beli, pajak, dan diskon
        $keuntunganPerItem = ($hargaJualPerItem - $hargaBeli - $diskonPerItem) * $item['kuantitas'];

        // Tambahkan ke total keuntungan
        $totalKeuntungan += $keuntunganPerItem;
    }

    // Membuat faktur baru dengan total dan keuntungan
    $faktur = Faktur::create(array_merge(
        $request->only(['nomor_faktur', 'tanggal', 'jatuh_tempo', 'pelanggan_id', 'catatan', 'tempo_hari', 'label_pajak', 'pajak', 'diskon_faktur']),
        [
            'total' => $request->total,
            'sisa_tagihan' => $request->total,
            'keuntungan' => $totalKeuntungan, // Simpan total keuntungan di faktur
        ]
    ));

    // Loop setiap item yang dikirim melalui form untuk disimpan
    foreach ($request->items as $item) {
        $faktur->items()->create([
            'barang_id' => $item['barang_id'],
            'kuantitas' => $item['kuantitas'],
            'diskon' => $item['diskon'] ?? 0,
            'subtotal' => $item['subtotal'],
        ]);
    }

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('fakturs.index')->with('success', 'Faktur berhasil dibuat.');
}















public function edit($id)
{
    $faktur = Faktur::with('items')->findOrFail($id);
    $pelanggans = Pelanggan::all();
    $barangs = Barang::all();

    return view('fakturs.edit', compact('faktur', 'pelanggans', 'barangs'));
}







// public function update(Request $request, $id)
// {
//     // Validasi input
//     $request->validate([
//         'nomor_faktur' => 'required',
//         'tanggal' => 'required|date',
//         'jatuh_tempo' => 'required|date',
//         'tempo_hari' => 'required|integer|min:1',
//         'pelanggan_id' => 'required|exists:pelanggans,id',
//         'catatan' => 'nullable|string',
//         'items' => 'required|array',
//         'items.*.barang_id' => 'required|exists:barangs,id',
//         'items.*.kuantitas' => 'required|integer|min:1',
//         'items.*.diskon' => 'nullable|numeric|min:0',
//         'items.*.pajak' => 'nullable|numeric|min:0',
//         'items.*.pajak_termasuk' => 'nullable|boolean',
//         'items.*.diskon_setelah_pajak' => 'nullable|boolean',
//         'label_pajak' => 'nullable|string',
//         'pajak' => 'nullable|numeric|min:0',
//         'diskon_faktur' => 'nullable|numeric|min:0',
//     ]);

//     // Temukan faktur berdasarkan ID
//     $faktur = Faktur::findOrFail($id);

//     // Simpan total pembayaran yang sudah dilakukan sebelum faktur diupdate
//     $pembayaranSebelumnya = $faktur->total - $faktur->sisa_tagihan;

//     // Update faktur dengan data dari form
//     $faktur->update($request->only([
//         'nomor_faktur', 'tanggal', 'jatuh_tempo', 'pelanggan_id', 'catatan', 'tempo_hari'
//     ]));

//     // Inisialisasi total baru
//     $total = 0;

//     // Hapus semua items lama yang terhubung dengan faktur ini
//     $faktur->items()->delete();

//     // Loop setiap item yang dikirim melalui form
//     foreach ($request->items as $item) {
//         $barang = Barang::findOrFail($item['barang_id']);
        
//         // Hitung subtotal per item (harga barang * kuantitas)
//         $harga_satuan = $barang->harga;
//         $kuantitas = $item['kuantitas'];
//         $subtotal = $harga_satuan * $kuantitas;

//         // Ambil persentase pajak dari item
//         $pajakPersen = $item['pajak'] ?? 0;

//         // Hitung pajak dan subtotal
//         if ($item['pajak_termasuk'] ?? false) {
//             $hargaSebelumPajak = $subtotal / (1 + ($pajakPersen / 100));
//             $totalPajak = $subtotal - $hargaSebelumPajak;
//         } else {
//             $totalPajak = $subtotal * ($pajakPersen / 100);
//             $hargaSebelumPajak = $subtotal;
//         }

//         // Hitung subtotal setelah pajak
//         $subtotalSetelahPajak = $hargaSebelumPajak + $totalPajak;

//         // Diskon jika ada
//         $diskon = $item['diskon'] ?? 0;
//         if ($item['diskon_setelah_pajak'] ?? false) {
//             $subtotalSetelahDiskon = $subtotalSetelahPajak - ($subtotalSetelahPajak * ($diskon / 100));
//         } else {
//             $subtotalSetelahDiskon = $hargaSebelumPajak - ($hargaSebelumPajak * ($diskon / 100)) + $totalPajak;
//         }

//         // Pastikan subtotal tidak negatif
//         $subtotalSetelahDiskon = max(0, $subtotalSetelahDiskon);

//         // Tambahkan subtotal ke total faktur
//         $total += $subtotalSetelahDiskon;

//         // Simpan item ke dalam tabel faktur_items
//         $faktur->items()->create([
//             'barang_id' => $item['barang_id'],
//             'kuantitas' => $kuantitas,
//             'diskon' => $diskon,
//             'subtotal' => $subtotalSetelahDiskon,
//             'pajak' => $totalPajak,
//             'label_pajak' => $item['label_pajak'] ?? null,
//         ]);
//     }

//     // Hitung total pajak untuk faktur
//     $totalPajakFaktur = ($total * ($request->pajak ?? 0)) / 100;

//     // Hitung total akhir setelah diskon faktur
//     $totalSetelahDiskonFaktur = $total - ($total * ($request->diskon_faktur ?? 0) / 100);
//     $totalSetelahDiskonFaktur = max(0, $totalSetelahDiskonFaktur);

//     // Update total di faktur setelah looping semua item
//     $faktur->update([
//         'total' => $totalSetelahDiskonFaktur + $totalPajakFaktur,
//         'sisa_tagihan' => $totalSetelahDiskonFaktur + $totalPajakFaktur,
//     ]);

//     // Update status berdasarkan sisa tagihan
//     $faktur->status = $faktur->sisa_tagihan > 0 ? 'belum lunas' : 'lunas';

//     // Simpan faktur dengan data yang sudah diperbarui
//     $faktur->save();

//     // Redirect ke halaman index dengan pesan sukses
//     return redirect()->route('fakturs.index')->with('success', 'Faktur berhasil diupdate.');
// }



public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nomor_faktur' => 'required',
        'tanggal' => 'required|date',
        'jatuh_tempo' => 'required|date',
        'tempo_hari' => 'required|integer|min:1',
        'pelanggan_id' => 'required|exists:pelanggans,id',
        'catatan' => 'nullable|string',
        'items' => 'required|array',
        'items.*.barang_id' => 'required|exists:barangs,id',
        'items.*.kuantitas' => 'required|integer|min:1',
        'items.*.diskon' => 'nullable|numeric|min:0',
        'items.*.pajak' => 'nullable|numeric|min:0',
        'items.*.pajak_termasuk' => 'nullable|boolean',
        'items.*.diskon_setelah_pajak' => 'nullable|boolean',
        'label_pajak' => 'nullable|string',
        'pajak' => 'nullable|numeric|min:0',
        'diskon_faktur' => 'nullable|numeric|min:0',
        'total' => 'required|numeric|min:0', // Tambahkan validasi untuk total
    ]);

    // Temukan faktur berdasarkan ID
    $faktur = Faktur::findOrFail($id);

    // Update faktur dengan data dari form
    $faktur->update(array_merge(
        $request->only(['nomor_faktur', 'tanggal', 'jatuh_tempo', 'pelanggan_id', 'catatan', 'tempo_hari', 'label_pajak', 'pajak', 'diskon_faktur']),
        [
            'total' => $request->total, // Gunakan total yang diterima dari frontend
            'sisa_tagihan' => $request->total, // Sisa tagihan diisi dengan total
        ]
    ));

    // Hapus semua items lama yang terhubung dengan faktur ini
    $faktur->items()->delete();

    // Loop setiap item yang dikirim melalui form
    foreach ($request->items as $item) {
        // Simpan item ke dalam tabel faktur_items
        $faktur->items()->create([
            'barang_id' => $item['barang_id'],
            'kuantitas' => $item['kuantitas'],
            'diskon' => $item['diskon'] ?? 0, // Pastikan diskon ada jika tidak diisi
            'subtotal' => $item['subtotal'] ?? 0, // Gunakan subtotal dari frontend jika ada
        ]);
    }

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('fakturs.index')->with('success', 'Faktur berhasil diupdate.');
}












public function destroy($id)
{
    $faktur = Faktur::findOrFail($id);
    $faktur->delete();

    return redirect()->route('fakturs.index')->with('success', 'Faktur berhasil dihapus.');
}





    public function show($id)
    {
        $faktur = Faktur::with('pembayarans')->findOrFail($id);
        // Hitung total jumlah bayar
    $totalBayar = $faktur->pembayarans->sum('jumlah_bayar');
        return view('fakturs.show', compact('faktur', 'totalBayar'));
    }





    




// FakturController.php
public function summary($id)
{
    $faktur = Faktur::with('items.barang', 'pelanggan')->findOrFail($id);
    $totalBayar = $faktur->pembayarans->sum('jumlah'); // Menghitung total pembayaran dari relasi pembayaran

    return view('fakturs.summary', compact('faktur', 'totalBayar'));
}


// app/Http/Controllers/FakturController.php

public function showNew($id)
{
    // Ambil data faktur baru berdasarkan ID
    $faktur = Faktur::with('pelanggan', 'items')->findOrFail($id);
    return view('fakturs.new_show', compact('faktur'));
}








}

