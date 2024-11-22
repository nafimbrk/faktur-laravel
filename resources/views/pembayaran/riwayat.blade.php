<x-layout>
    <div class="container">
    <h2 class="text-xl font-semibold mb-4">Riwayat Pembayaran</h2>

    
    @if($riwayatPembayaran->isEmpty())
        <p>Tidak ada pembayaran yang ditemukan.</p>
    @else
    <div class="max-w-4xl bg-white rounded-lg p-6">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Tanggal Pembayaran</th>
                    <th class="border px-4 py-2">Jumlah Bayar</th>
                    <th class="border px-4 py-2">Metode Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach($riwayatPembayaran as $pembayaran)
                    <tr>
                        <td class="border px-4 py-2">{{ $pembayaran->created_at->format('d-m-Y') }}</td>
                        <td class="border px-4 py-2">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                        <td class="border px-4 py-2">{{ ucfirst($pembayaran->metode_bayar) }}</td> <!-- Contoh: Tunai, Transfer -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
</div>
</x-layout>