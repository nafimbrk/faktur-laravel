<x-layout>


    <div class="flex justify-between items-center flex-row md:flex-col md:items-start">
        <h2 class="text-2xl font-bold mb-4">Daftar Faktur</h2>

        <a href="{{ route('fakturs.create') }}"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <i class="fa-solid fa-plus"></i>
        </a>
    </div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">#</th>
                    <th scope="col" class="px-6 py-3">Tanggal</th>
                    <!--<th scope="col" class="px-6 py-3">Pelanggan</th>-->
                    <th scope="col" class="px-6 py-3">Sisa Tagihan</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fakturs as $faktur)
                    <tr class="border-b hover:bg-gray-100 dark:border-gray-700 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">{{ $faktur->nomor_faktur }}</td>
                        <td class="px-6 py-4">{{ $faktur->tanggal }}</td>
                        <!--<td class="px-6 py-4">{{ $faktur->pelanggan->nama }}</td>-->
                        <td class="px-6 py-4">
                            {{ $faktur->sisa_tagihan == 0 ? 'Lunas' : 'Rp. ' . number_format($faktur->sisa_tagihan, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="{{ route('fakturs.show', $faktur->id) }}"
                                class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('fakturs.edit', $faktur->id) }}"
                                class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 dark:focus:ring-yellow-900">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('fakturs.destroy', $faktur->id) }}}" method="POST"
                                style="display:inline-block;" id="delete-form-{{ $faktur->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                    onclick="confirmDelete({{ $faktur->id }})">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>





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
