<?php

namespace App\Http\Controllers;

use App\Models\Faktur;
use App\Models\PembayaranFaktur;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    // Menampilkan halaman pembayaran
    public function create(Faktur $faktur)
    {
        return view('pembayaran.create', compact('faktur'));
    }

    public function store(Request $request, Faktur $faktur)
{
    // Cek apakah toggle lunas aktif
    $isLunas = $request->has('status_lunas');

    // Validasi data input
    if ($isLunas) {
        // Jika lunas, jumlah bayar tidak perlu diinput
        $validated = $request->validate([
            'tanggal_bayar' => 'required|date',
            'metode_bayar' => 'nullable|string', // Metode pembayaran opsional
        ]);
        $jumlahBayar = $faktur->sisa_tagihan; // Jumlah bayar = sisa tagihan
    } else {
        // Jika tidak lunas, harus ada input jumlah_bayar
        $validated = $request->validate([
            'jumlah_bayar' => 'required|numeric|min:1|max:' . $faktur->sisa_tagihan,
            'tanggal_bayar' => 'required|date',
            'metode_bayar' => 'nullable|string',
        ]);
        $jumlahBayar = $validated['jumlah_bayar']; // Ambil jumlah bayar dari input
    }

    // Simpan riwayat pembayaran ke tabel pembayaran_faktur
    PembayaranFaktur::create([
        'faktur_id' => $faktur->id, // ID Faktur yang dibayar
        'jumlah_bayar' => $jumlahBayar, // Jumlah yang dibayarkan
        'tanggal_bayar' => $validated['tanggal_bayar'], // Tanggal pembayaran
        'metode_bayar' => $request->metode_bayar, // Metode pembayaran (opsional)
    ]);

    // Hitung total yang sudah dibayar dari tabel pembayaran_faktur
    $totalBayarSebelumnya = PembayaranFaktur::where('faktur_id', $faktur->id)->sum('jumlah_bayar');

    // Update sisa tagihan berdasarkan total faktur dikurangi total bayar sebelumnya
    $faktur->sisa_tagihan = $faktur->total - $totalBayarSebelumnya;

    // Jika lunas, set status jadi lunas
    if ($isLunas || $faktur->sisa_tagihan <= 0) {
        $faktur->sisa_tagihan = 0; // Cegah nilai negatif
        $faktur->status = 'lunas';
    } else {
        $faktur->status = 'belum lunas';
    }

    // Simpan perubahan ke database
    $faktur->save();

    // Simpan transaksi ke tabel transactions
    Transaction::create([
        'notes' => $faktur->nomor_faktur, // Deskripsi dengan nomor faktur
        'date' => $validated['tanggal_bayar'], // Tanggal pembayaran
        'amount' => $jumlahBayar, // Jumlah yang dibayarkan
        'category' => 'Sales', // Kategori "Sales"
    ]);

    // Redirect ke halaman faktur dengan pesan sukses
    return redirect()->route('fakturs.show', $faktur->id)->with('success', 'Pembayaran berhasil disimpan.');
}







public function riwayat(Faktur $faktur)
{
    // Ambil semua pembayaran terkait dengan faktur ini
    $riwayatPembayaran = $faktur->pembayarans()->orderBy('created_at', 'desc')->get();

    // Tampilkan halaman dengan riwayat pembayaran
    return view('pembayaran.riwayat', compact('faktur', 'riwayatPembayaran'));
}



}
