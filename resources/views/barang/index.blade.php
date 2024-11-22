<x-layout title="Daftar Barang">



    <div class="flex justify-between items-center flex-row md:flex-col md:items-start">
        <h2 class="text-2xl font-bold mb-4">Daftar Barang</h2>
    
        <a href="{{ route('barang.create') }}"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <i class="fa-solid fa-plus"></i>
        </a>
    </div>
    


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Harga</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $barang)
                    <tr class="border-b hover:bg-gray-100 dark:border-gray-700 dark:hover:bg-gray-600">
                        <td scope="row" class="px-4 py-4">{{ $barang->nama }}</td>
                        <td class="px-4 py-4">{{ number_format($barang->harga, 0, ',', '.') }}</td>
                        <!--<td class="px-4 py-4 flex space-x-2">-->
                        <!--    <a href="{{ route('barang.show', $barang->id) }}"-->
                        <!--        class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">-->
                        <!--        <i class="fa-solid fa-eye"></i>-->
                        <!--    </a>-->
                        <!--    <a href="{{ route('barang.edit', $barang->id) }}"-->
                        <!--        class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 dark:focus:ring-yellow-900">-->
                        <!--        <i class="fa-solid fa-pen"></i>-->
                        <!--    </a>-->
                        <!--    <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="inline-block" id="delete-form-{{ $barang->id }}">-->
                        <!--        @csrf-->
                        <!--        @method('DELETE')-->
                        <!--        <button type="button"-->
                        <!--            class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"-->
                        <!--            onclick="confirmDelete({{ $barang->id }})">-->
                        <!--            <i class="fa-solid fa-trash"></i>-->
                        <!--        </button>-->
                        <!--    </form>-->
                        <!--</td>-->
                        
                                                <td class="px-4 py-4 flex space-x-2">
                            <a href="{{ route('barang.show', $barang->id) }}"
                                class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('barang.edit', $barang->id) }}"
                                class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 dark:focus:ring-yellow-900">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="inline-block" id="delete-form-{{ $barang->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                    onclick="confirmDelete({{ $barang->id }})">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(itemId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form penghapusan jika dikonfirmasi
                    document.getElementById('delete-form-' + itemId).submit();
                }
            })
        }
    </script>
</x-layout>
