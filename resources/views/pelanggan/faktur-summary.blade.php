<x-layout title="Ringkasan Faktur">
    <div class="max-w-3xl mx-auto bg-white rounded-lg p-6 shadow">
        <table class="min-w-full border border-gray-300 mb-4">
            <tbody>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Faktur #:</th>
                    <td class="px-4 py-2 border-b">{{ $faktur->nomor_faktur }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Tanggal:</th>
                    <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($faktur->tanggal)->format('d M Y') }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Pelanggan:</th>
                    <td class="px-4 py-2 border-b">{{ $pelanggan->nama }}</td>
                </tr>
            </tbody>
        </table>

        <h3 class="text-lg font-semibold mb-2">Ringkasan Items</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left border-b">Nama Barang</th>
                        <th class="px-4 py-2 text-left border-b">Kuantitas</th>
                        <th class="px-4 py-2 text-left border-b">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($faktur->items as $item)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $item->barang->nama }}</td>
                        <td class="px-4 py-2 border-b">{{ $item->kuantitas }}</td>
                        <td class="px-4 py-2 border-b">Rp{{ number_format($item->barang->harga, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ route('pelanggan.show', $pelanggan->id) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mt-4 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>
</x-layout>
