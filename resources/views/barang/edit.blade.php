<x-layout title="Edit Barang">
    <h2 class="text-2xl font-bold mb-4">Edit Barang</h2>

    <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        
        <div class="mb-6">
            <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                Barang</label>
            <input type="text" name="nama" id="default-input" value="{{ old('nama', $barang->nama) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>






        <div class="mb-6">
            <label for="large-input"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
            <textarea type="text" name="deskripsi" id="large-input"
                class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>{{ old('deskripsi', $barang->deskripsi) }}</textarea>
        </div>





<div class="mb-6">
            <label for="default-input"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Beli</label>
            <input type="text" name="harga_beli" id="default-input" value="{{ old('harga_beli', $barang->harga_beli) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>


        <div class="mb-6">
            <label for="default-input"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
            <input type="text" name="harga" id="default-input" value="{{ old('harga', $barang->harga) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>





        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="foto">Foto</label>
            @if($barang->foto)
                <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama }}" id="current-foto">
            @endif
            <input name="foto"
                class="block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="foto" type="file" accept="image/*">
        </div>

        

        <!-- Pratinjau Gambar Baru -->
        <div class="mb-4">
            <img id="preview" src="#" alt="Preview Gambar" class="w-32 h-32 object-cover hidden">
        </div>


        <div class="container mx-auto flex justify-between items-center md:justify-start">
            <a href="{{ route('barang.index') }}"
               class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <i class="fa-solid fa-arrow-left"></i>
            </a>

        <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <i class="fa-solid fa-check"></i></button>
        </div>
    </form>








        

        


        




        


       

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#foto').change(function(e) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result).removeClass('hidden');
                    $('#current-foto').addClass('hidden');  // Sembunyikan gambar lama jika ada
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
</x-layout>
