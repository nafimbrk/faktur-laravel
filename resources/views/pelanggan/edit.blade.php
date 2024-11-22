<!-- resources/views/pelanggan/create.blade.php & edit.blade.php -->
<x-layout title="Tambah Pelanggan">
    <h2 class="text-2xl font-bold mb-4">Edit Pelanggan</h2>

    <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Fields for Pelanggan Details -->
        <div class="mb-6">
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ $pelanggan->nama ?? old('nama') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>

        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" name="email" id="email" value="{{ $pelanggan->email ?? old('email') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>

        <div class="mb-6">
            <label for="nomor_telepon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                Telepon</label>
            <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ $pelanggan->nomor_telepon ?? old('nomor_telepon') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>


        <div class="mb-6">
            <label for="informasi_tambahan"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Informasi Tambahan</label>
            <textarea name="informasi_tambahan" id="informasi_tambahan"
                class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>{{ $pelanggan->informasi_tambahan ?? old('informasi_tambahan') }}</textarea>
        </div>

        {{-- <div class="mb-6">
            <label for="tax_reg" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tag Rex</label>
            <input type="text" name="tax_reg" id="tax_reg" value="{{ $pelanggan->tax_reg ?? old('tax_reg') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div> --}}

        <h3 class="text-xl font-bold mt-4">Alamat Utama</h3>

        <div class="mb-6">
            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
            <input type="text" name="alamat" id="alamat" value="{{ $pelanggan->alamat ?? old('alamat') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>

        <div class="mb-6">
            <label for="kota" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kota</label>
            <input type="text" name="kota" id="kota" value="{{ $pelanggan->kota ?? old('kota') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>

        <div class="mb-6">
            <label for="kode_pos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Pos</label>
            <input type="text" name="kode_pos" id="kode_pos" value="{{ $pelanggan->kode_pos ?? old('kode_pos') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>

        <div class="mb-6">
            <label for="provinsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
            <input type="text" name="provinsi" id="provinsi" value="{{ $pelanggan->provinsi ?? old('provinsi') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>


        <div class="mb-6">
        <label for="negara" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Negara Pengiriman</label>
        <select name="negara" id="negara"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            <option value="" disabled selected>Pilih Negara</option>
            <option value="Indonesia" {{ (isset($pelanggan) && $pelanggan->negara == 'Indonesia') || old('negara') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
            <option value="Malaysia" {{ (isset($pelanggan) && $pelanggan->negara == 'Malaysia') || old('negara') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
            <option value="Singapura" {{ (isset($pelanggan) && $pelanggan->negara == 'Singapura') || old('negara') == 'Singapura' ? 'selected' : '' }}>Singapura</option>
            <option value="Thailand" {{ (isset($pelanggan) && $pelanggan->negara == 'Thailand') || old('negara') == 'Thailand' ? 'selected' : '' }}>Thailand</option>
            <option value="Filipina" {{ (isset($pelanggan) && $pelanggan->negara == 'Filipina') || old('negara') == 'Filipina' ? 'selected' : '' }}>Filipina</option>
            <option value="Jepang" {{ (isset($pelanggan) && $pelanggan->negara == 'Jepang') || old('negara') == 'Jepang' ? 'selected' : '' }}>Jepang</option>
            <option value="Korea Selatan" {{ (isset($pelanggan) && $pelanggan->negara == 'Korea Selatan') || old('negara') == 'Korea Selatan' ? 'selected' : '' }}>Korea Selatan</option>
        </select>
        </div>

        <h3 class="text-xl font-bold mt-4">Alamat Pengiriman</h3>

        <div class="mb-6">
            <label for="alamat_pengiriman" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat Pengiriman</label>
            <input type="text" name="alamat_pengiriman" id="alamat_pengiriman" value="{{ $pelanggan->alamat_pengiriman ?? old('alamat_pengiriman') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>

        <div class="mb-6">
            <label for="kota_pengiriman" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kota Pengiriman</label>
            <input type="text" name="kota_pengiriman" id="kota_pengiriman" value="{{ $pelanggan->kota_pengiriman ?? old('kota_pengiriman') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <div class="mb-6">
            <label for="kode_pos_pengiriman" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Pos Pengiriman</label>
            <input type="text" name="kode_pos_pengiriman" id="kode_pos_pengiriman" value="{{ $pelanggan->kode_pos_pengiriman ?? old('kode_pos_pengiriman') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <div class="mb-6">
            <label for="provinsi_pengiriman" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi Pengiriman</label>
            <input type="text" name="provinsi_pengiriman" id="provinsi_pengiriman" value="{{ $pelanggan->provinsi_pengiriman ?? old('provinsi_pengiriman') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <div class="mb-6">
            <label for="negara_pengiriman" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Negara Pengiriman</label>
        <select name="negara_pengiriman" id="negara_pengiriman"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="" disabled selected>Pilih Negara</option>
            <option value="Indonesia" {{ (isset($pelanggan) && $pelanggan->negara_pengiriman == 'Indonesia') || old('negara_pengiriman') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
            <option value="Malaysia" {{ (isset($pelanggan) && $pelanggan->negara_pengiriman == 'Malaysia') || old('negara_pengiriman') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
            <option value="Singapura" {{ (isset($pelanggan) && $pelanggan->negara_pengiriman == 'Singapura') || old('negara_pengiriman') == 'Singapura' ? 'selected' : '' }}>Singapura</option>
            <option value="Thailand" {{ (isset($pelanggan) && $pelanggan->negara_pengiriman == 'Thailand') || old('negara_pengiriman') == 'Thailand' ? 'selected' : '' }}>Thailand</option>
            <option value="Filipina" {{ (isset($pelanggan) && $pelanggan->negara_pengiriman == 'Filipina') || old('negara_pengiriman') == 'Filipina' ? 'selected' : '' }}>Filipina</option>
            <option value="Jepang" {{ (isset($pelanggan) && $pelanggan->negara_pengiriman == 'Jepang') || old('negara_pengiriman') == 'Jepang' ? 'selected' : '' }}>Jepang</option>
            <option value="Korea Selatan" {{ (isset($pelanggan) && $pelanggan->negara_pengiriman == 'Korea Selatan') || old('negara_pengiriman') == 'Korea Selatan' ? 'selected' : '' }}>Korea Selatan</option>
        </select>
        </div>



        <div class="container mx-auto flex justify-between items-center md:justify-start">
            <a href="{{ route('pelanggan.index') }}"
               class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <i class="fa-solid fa-arrow-left"></i>
            </a>

        <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <i class="fa-solid fa-check"></i></button>
        </div>
    
    </form>
</x-layout>
