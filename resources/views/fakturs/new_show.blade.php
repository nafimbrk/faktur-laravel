<!--<div class="container mx-auto mt-10">-->
<!--    <div class="bg-white p-6 rounded-lg shadow-md">-->
<!--        <h1 class="text-3xl font-bold mb-4">Faktur Pembayaran</h1>-->
<!--        <h2 class="text-xl">Faktur ID: #{{ $faktur->id }}</h2>-->
<!--        <p class="text-gray-600">Tanggal: {{ $faktur->tanggal }}</p>-->
<!--        <p class="text-gray-600">Jatuh Tempo: {{ $faktur->jatuh_tempo }}</p>-->

<!--        <div class="mt-4">-->
<!--            <h3 class="text-lg font-semibold">Detail Pelanggan</h3>-->
<!--            <p>Nama: {{ $faktur->pelanggan->nama }}</p>-->
<!--            <p>Email: {{ $faktur->pelanggan->email }}</p>-->
<!--            <p>Telepon: {{ $faktur->pelanggan->telepon }}</p>-->
<!--        </div>-->

<!--        <h4 class="text-lg font-semibold mt-4">Rincian Produk</h4>-->
<!--        <div class="bg-gray-100 p-4 rounded-lg">-->
<!--            <table class="w-full border-collapse border border-gray-200 text-sm">-->
<!--                <thead>-->
<!--                    <tr class="bg-gray-200">-->
<!--                        <th class="px-2 py-1 border border-gray-300 text-left">Produk</th>-->
<!--                        <th class="px-2 py-1 border border-gray-300 text-right">Kuantitas</th>-->
<!--                        <th class="px-2 py-1 border border-gray-300 text-right">Harga Satuan</th>-->
<!--                        <th class="px-2 py-1 border border-gray-300 text-right">Subtotal</th>-->
<!--                    </tr>-->
<!--                </thead>-->
<!--                <tbody>-->
<!--                    @foreach ($faktur->items as $item)-->
<!--                        <tr class="hover:bg-gray-50">-->
<!--                            <td class="px-2 py-1 border border-gray-300">{{ $item->barang->nama }}</td>-->
<!--                            <td class="px-2 py-1 border border-gray-300 text-right">{{ $item->kuantitas }}</td>-->
<!--                            <td class="px-2 py-1 border border-gray-300 text-right">{{ number_format($item->barang->harga, 0, ',', '.') }}</td>-->
<!--                            <td class="px-2 py-1 border border-gray-300 text-right">{{ number_format($item->subtotal, 0, ',', '.') }}</td>-->
<!--                        </tr>-->
<!--                    @endforeach-->
<!--                </tbody>-->
<!--            </table>-->
<!--        </div>-->

<!--        <div class="flex justify-between mt-4">-->
<!--            <div>-->
<!--                <p class="text-gray-600">Total: {{ number_format($faktur->total, 0, ',', '.') }}</p>-->
<!--                <p class="text-gray-600">Diskon: {{ number_format($faktur->diskon, 0, ',', '.') }}%</p>-->
<!--                <p class="text-gray-600">Jumlah yang Harus Dibayar: {{ number_format($faktur->jumlah_yang_harus_dibayar, 0, ',', '.') }}</p>-->
<!--            </div>-->
<!--            <div>-->
<!--                <button type="button" onclick="window.print()" -->
<!--                        class="mt-4 text-white bg-green-600 hover:bg-green-700 rounded-lg px-4 py-2">-->
<!--                    Cetak Faktur-->
<!--                </button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<x-layout>
<div class="relative w-full h-full max-w-md md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="bg-white p-4 max-h-[60vh] overflow-y-auto">
                <div class="flex justify-between items-start mb-2">
                    <h1 class="text-left font-bold">Coba</h1>
                    <h2 class="text-right font-bold">Faktur Coba</h2>
                </div>
                
                <div class="flex justify-between bg-gray-100 p-2 rounded-lg">
                    <div class="w-1/2 text-sm">
                        <h4 class="text-lg font-semibold">Ditagih Kepada</h4>
                        <p class="text-gray-600">Pelanggan: {{ $faktur->pelanggan->nama }}</p>
                        <p class="text-gray-600">Alamat: {{ $faktur->pelanggan->alamat }}</p>
                        <p class="text-gray-600">Kota: {{ $faktur->pelanggan->kota }}</p>
                        <p class="text-gray-600">Kode Pos: {{ $faktur->pelanggan->kode_pos }}</p>
                        <p class="text-gray-600">Provinsi: {{ $faktur->pelanggan->provinsi }}</p>
                        <p class="text-gray-600">Negara: {{ $faktur->pelanggan->negara }}</p>
                        
                        <h4 class="text-lg font-semibold mt-4">Ditagih Kepada</h4>
                        <p class="text-gray-600">Pelanggan: {{ $faktur->pelanggan->nama }}</p>
                        <p class="text-gray-600">Alamat: {{ $faktur->pelanggan->alamat }}</p>
                        <p class="text-gray-600">Kota: {{ $faktur->pelanggan->kota }}</p>
                        <p class="text-gray-600">Kode Pos: {{ $faktur->pelanggan->kode_pos }}</p>
                        <p class="text-gray-600">Provinsi: {{ $faktur->pelanggan->provinsi }}</p>
                        <p class="text-gray-600">Negara: {{ $faktur->pelanggan->negara }}</p>
                    </div>


                    <div class="w-1/2 text-right text-sm">
                        <h4 class="text-lg font-semibold">Faktur #: {{ $faktur->nomor_faktur }}</h4>
                        <p class="text-gray-600">Tanggal: {{ $faktur->tanggal }}</p>
                        <p class="text-gray-600">Jatuh Tempo: {{ $faktur->jatuh_tempo }}</p>
                    </div>
                </div>

                <h3 class="text-lg font-semibold mb-2">Barang</h3>
                <div class="bg-gray-100 p-2 rounded-lg">
                    <table class="w-full border-collapse border border-gray-200 text-sm">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-2 py-1 border border-gray-300 text-left">Barang</th>
                                <th class="px-2 py-1 border border-gray-300 text-right">Kuantitas</th>
                                <th class="px-2 py-1 border border-gray-300 text-right">Harga Satuan</th>
                                <th class="px-2 py-1 border border-gray-300 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faktur->items as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-2 py-1 border border-gray-300">{{ $item->barang->nama }}</td>
                                    <td class="px-2 py-1 border border-gray-300 text-right">{{ $item->kuantitas }}</td>
                                    <td class="px-2 py-1 border border-gray-300 text-right">{{ number_format($item->barang->harga, 0, ',', '.') }}</td>
                                    <td class="px-2 py-1 border border-gray-300 text-right">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-between mt-3">
                    <div class="w-1/2 text-sm">
                        <p class="text-gray-600">Catatan: {{ $faktur->catatan }}</p>
                    </div>
                    <div class="w-1/2 text-right text-sm">
                        <p class="text-gray-600">Pajak : {{ $faktur->label_pajak . ' ' . number_format($faktur->pajak, 0, ',', '.') . '%' }}</p>
                        <p class="text-gray-600">Diskon : {{ number_format($faktur->diskon_faktur, 0, ',', '.') . '%' }}</p>
                        <p class="text-gray-600">Total: {{ number_format($faktur->total, 0, ',', '.') }}</p>
                        <p class="text-gray-600">Jumlah yang harus dibayar: {{ number_format($faktur->sisa_tagihan, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600 modal-footer print:hidden">
                <button type="button" onclick="window.print()"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Cetak
                </button>
            </div>
        </div>
    </div>
    
    <style>
    @media print {
        .print\:hidden {
            display: none !important;
        }
    }
</style>
</x-layout>