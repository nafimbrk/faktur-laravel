<x-layout title="Detail Barang">
    <h2 class="text-2xl font-bold mb-4">Detail Barang</h2>


    

<ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white mb-6">
    <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
        <label class="block font-bold">Nama Barang:</label>
        <p>{{ $barang->nama }}</p>
    </li>
    <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600">
        <label class="block font-bold">Deskripsi:</label>
        <p>{{ $barang->deskripsi }}</p>
    </li>
    <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600">
        <label class="block font-bold">Harga Beli:</label>
        <p>{{ $barang->harga_beli }}</p>
    </li>
    <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600"">
        <label class="block font-bold">Harga:</label>
        <p>{{ $barang->harga }}</p>
    </li>
    <li class="w-full px-4 py-2 rounded-b-lg">
        <label class="block font-bold">Foto:</label>
        @if($barang->foto)
            <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama }}" class="w-32 h-32 object-cover">
        @else
            <p>Tidak ada foto</p>
        @endif
    </li>
</ul>


    <a href="{{ route('barang.index') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i class="fa-solid fa-arrow-left"></i></a>

</x-layout>
