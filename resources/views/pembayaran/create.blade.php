<x-layout>
    <h1 class="text-2xl font-bold mb-4">Pembayaran Faktur</h1>

    <form action="{{ route('pembayaran.store', $faktur->id) }}" method="POST">
        @csrf

        <!-- Toggle Lunas -->
        <div class="mb-6">
            <label for="status_lunas" class="inline-flex items-center cursor-pointer">
                <input type="checkbox" id="status_lunas" value="" class="sr-only peer" name="status_lunas">
                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Lunas</span>
              </label>
        </div>

        

  
  
        <div class="mb-6" id="jumlah_bayar_group">
            <label for="jumlah_bayar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Bayar</label>
            <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" min="1" max="{{ $faktur->sisa_tagihan }}" 
            required>
        </div>
    

        <!-- Input hidden untuk jumlah bayar (untuk saat lunas) -->
        <input type="hidden" id="hidden_jumlah_bayar" name="jumlah_bayar_hidden" value="0">
    

        <div class="mb-6">
            <label for="tanggal_bayar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pembayaran</label>
            <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>

        



        <div class="mb-6">
            <label for="metode_bayar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Metode Pembayaran</label>
            <select name="metode_bayar" id="metode_bayar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                <option value="" disabled selected>Pilih Metode Pembayaran</option>
                <option value="transfer">Transfer</option>
                <option value="kartu_kredit">Kartu Kredit</option>
                <option value="tunai">Tunai</option>
                <option value="ewallet">E-Wallet</option>
            </select>
        </div>
        
    
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <i class="fa-solid fa-check"></i> Bayar
        </button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk toggle lunas
            $('#status_lunas').change(function() {
                if ($(this).is(':checked')) {
                    $('#jumlah_bayar_group').hide(); // Sembunyikan input jumlah bayar
                    $('#jumlah_bayar').removeAttr('required'); // Hapus required
                    $('#hidden_jumlah_bayar').val(0); // Set hidden input jadi 0
                } else {
                    $('#jumlah_bayar_group').show(); // Tampilkan input jumlah bayar
                    $('#jumlah_bayar').attr('required', true); // Set jadi required lagi
                    $('#hidden_jumlah_bayar').val(''); // Kosongkan hidden input
                }
            });

            // Inisialisasi pertama (untuk mengatur tampilan awal jika toggle sudah dicentang)
            $('#status_lunas').trigger('change');

            // Ketika form disubmit
            $('form').submit(function() {
                if ($('#status_lunas').is(':checked')) {
                    // Jika toggle lunas dicentang, kirim nilai hidden untuk jumlah bayar
                    $('#hidden_jumlah_bayar').val(0); // Set hidden input jadi 0
                } else {
                    $('#hidden_jumlah_bayar').val($('#jumlah_bayar').val()); // Isi hidden dengan nilai jumlah bayar
                }
            });
        });
    </script>
</x-layout>
