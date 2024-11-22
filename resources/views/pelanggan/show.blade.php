<!-- resources/views/pelanggan/show.blade.php -->
<x-layout title="Detail Pelanggan">



    <h2 class="text-2xl font-bold mb-4">Detail Pelanggan</h2>




    <ul
        class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white mb-6">
        <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
            <label class="block font-bold text-lg mb-2">Informasi Utama</label>
            <p><strong>Nama:</strong> {{ $pelanggan->nama }}</p>
            <p><strong>Email:</strong> {{ $pelanggan->email }}</p>
            <p><strong>Nomor Telepon:</strong> {{ $pelanggan->nomor_telepon }}</p>
            <p> <strong>Informasi Tambahan:</strong> {{ $pelanggan->informasi_tambahan }}</p>


        </li>
        <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600">
            <label class="block font-bold text-lg mb-2">Alamat Utama</label>
            <p> <strong>Alamat:</strong> {{ $pelanggan->alamat }}
            </p>
            <p> <strong>Kota:</strong> {{ $pelanggan->kota }}
            </p>
            <p> <strong>Kode Pos:</strong> {{ $pelanggan->kode_pos }}
            </p>
            <p> <strong>Provinsi:</strong> {{ $pelanggan->provinsi }}
            </p>
            <p> <strong>Negara:</strong> {{ $pelanggan->negara }}
            </p>
        </li>
        <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600">
            <label class="block font-bold text-lg mb-2">Alamat Pengiriman</label>
            <p> <strong>Alamat Pengiriman:</strong> {{ $pelanggan->alamat_pengiriman }}
            </p>
            <p> <strong>Kota Pengiriman:</strong> {{ $pelanggan->kota_pengiriman }}
            </p>
            <p> <strong>Kode Pos Pengiriman:</strong> {{ $pelanggan->kode_pos_pengiriman }}
            </p>
            <p> <strong>Provinsi Pengiriman:</strong> {{ $pelanggan->provinsi_pengiriman }}
            </p>
            <p> <strong>Negara Pengiriman:</strong> {{ $pelanggan->negara_pengiriman }}
            </p>
        </li>

    </ul>












<!-- Tambahkan Tombol untuk Lihat Faktur -->
<a href="{{ route('pelanggan.faktur', $pelanggan->id) }}" 
    class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
    <i class="fa-solid fa-file-invoice"></i> Lihat Faktur
 </a>

    <a href="{{ route('pelanggan.index') }}"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
            class="fa-solid fa-arrow-left"></i></a>








</x-layout>
