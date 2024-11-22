{{-- resources/views/fakturs/summary.blade.php --}}
<x-layout title="Ringkasan Faktur">
    <div class="max-w-4xl bg-white rounded-lg p-6">
        <table class="min-w-full border border-gray-300 mb-6">
            <tbody>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Faktur #:</th>
                    <td class="px-4 py-2 border-b">{{ $faktur->nomor_faktur }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Tanggal:</th>
                    <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($faktur->tanggal)->format('M d, Y') }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Jatuh Tempo:</th>
                    <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($faktur->jatuh_tempo)->format('M d, Y') }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Tempo Hari:</th>
                    <td class="px-4 py-2 border-b">{{ $faktur->tempo_hari }} hari</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Ditagih Kepada:</th>
                    <td class="px-4 py-2 border-b">{{ $faktur->pelanggan->nama }}</td>
                </tr>   
            </tbody>
        </table>

        <h3 class="text-xl font-semibold mb-2">Items</h3>
        <div class="relative overflow-x-auto">
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left border-b">Nama Barang</th>
                        <th class="px-4 py-2 text-left border-b">Kuantitas</th>
                        <th class="px-4 py-2 text-left border-b">Harga Satuan</th>
                        <th class="px-4 py-2 text-left border-b">Diskon (IDR)</th>
                        <th class="px-4 py-2 text-left border-b">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($faktur->items as $item)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $item->barang->nama }}</td>
                        <td class="px-4 py-2 border-b">{{ $item->kuantitas }}</td>
                        <td class="px-4 py-2 border-b">{{ number_format($item->barang->harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border-b">{{ number_format($item->diskon, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border-b">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>
                
        <table class="min-w-full border border-gray-300 mb-6 mt-10">
            <tbody>       
                <tr>
                    <th class="px-4 py-2 text-left border-b">Pajak (%):</th>
                    <td class="px-4 py-2 border-b">{{ $faktur->label_pajak . ' ' . number_format($faktur->pajak, 0, ',', '.') . '%' }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Diskon (%):</th>
                    <td class="px-4 py-2 border-b">{{ number_format($faktur->diskon_faktur, 0, ',', '.') . '%' }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Total Faktur:</th>
                    <td class="px-4 py-2 border-b">Rp. {{ number_format($faktur->total, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Sisa Tagihan</th>
                    <td class="px-4 py-2 border-b">Rp. {{ number_format($faktur->sisa_tagihan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Sudah Dibayar</th>
                    <td class="px-4 py-2 border-b">Rp. {{ number_format($totalBayar, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Status</th>
                    <td class="px-4 py-2 border-b">
                        @if ($faktur->status == 'lunas')
                            <span class="badge bg-success">Lunas</span>
                        @else
                            <span class="badge bg-warning">Belum Lunas</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Catatan:</th>
                    <td class="px-4 py-2 border-b">{{ $faktur->catatan }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layout>
