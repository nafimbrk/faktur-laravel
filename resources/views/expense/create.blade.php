<x-layout>
<div class="container">

    <h1 class="text-2xl font-bold mb-4">Transaksi Baru</h1>

    <!-- Tabs untuk memilih antara Expense atau Income -->
    <div class="mb-4 border-b-0"> <!-- Menghapus border bawah -->
        <ul class="flex flex-wrap text-sm font-medium text-center" id="create-transaction-tabs">
            <li class="mr-2">
                <a href="{{ route('expense.create') }}" id="create-expense-tab" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg">
                    Expense
                </a>
            </li>
            <li class="mr-2">
                <a href="{{ route('income.create') }}" id="create-income-tab" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg">
                    Income
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Script untuk toggle tampilan tabs berdasarkan pilihan menggunakan jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Identifikasi URL saat ini
        var currentUrl = window.location.href;

        // Tandai tab yang aktif berdasarkan URL
        if (currentUrl.includes("expense/create")) {
            $('#create-expense-tab').addClass('text-blue-600 border-blue-600');
        } else if (currentUrl.includes("income/create")) {
            $('#create-income-tab').addClass('text-blue-600 border-blue-600');
        }

        // Berikan interaksi tab agar menyorot tab saat diklik
        $('#create-transaction-tabs a').on('click', function(event) {
            // Hapus kelas dari semua tab
            $('#create-transaction-tabs a').removeClass('text-blue-600 border-blue-600');
            
            // Tambahkan kelas pada tab yang diklik
            $(this).addClass('text-blue-600 border-blue-600');
        });
    });
</script>


    

    <form action="{{ route('expense.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-6">
            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah (-Rp)</label>
            <input type="number" step="0.01" name="amount" id="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>
        <div class="mb-6">
            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
            <input type="date" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>



        <div class="mb-6">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
            <select name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                <option value="" disabled selected>Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
        </div>


        <div class="mb-6">
            <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan</label>
            <textarea name="notes" id="notes" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500" required></textarea>
        </div>
        
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <i class="fa-solid fa-check"></i> Simpan
        </button>
        </form>
</div>

<script>
    $(document).ready(function() {
            $('#foto').change(function(e) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result).removeClass('hidden');
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
</script>
</x-layout>