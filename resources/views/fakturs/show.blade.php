<x-layout>
    <h1 class="text-2xl font-bold mb-4">Detail Faktur</h1>

    <div class="max-w-4xl bg-white rounded-lg p-6">
        <table class="min-w-full border border-gray-300 mb-6">
            <tbody>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Faktur #:</th>
                    <td class="px-4 py-2 border-b">{{ $faktur->nomor_faktur }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Tanggal:</th>
                    <td class="px-4 py-2 border-b">{{ $faktur->tanggal }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Jatuh Tempo:</th>
                    <td class="px-4 py-2 border-b">{{ $faktur->jatuh_tempo }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Tempo Hari:</th>
                    <td class="px-4 py-2 border-b">{{ $faktur->tempo_hari }} hari</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Ditagih Kepada:</th>
                    <td class="px-4 py-2 border-b">{{ $faktur->pelanggan->nama }}</td>
                </tr>
            </tbody>
        </table>

        <h3 class="text-xl font-semibold mb-2">Items</h3>
        <div class="relative overflow-x-auto">

            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left border-b">Nama Barang</th>
                        <th class="px-4 py-2 text-left border-b">Kuantitas</th>
                                                <th class="px-4 py-2 text-left border-b">Harga Beli</th>

                        <th class="px-4 py-2 text-left border-b">Harga Satuan</th>
                        <th class="px-4 py-2 text-left border-b">Diskon (IDR)</th>
                        <th class="px-4 py-2 text-left border-b">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($faktur->items as $item)
                        <tr>
                            <td class="px-4 py-2 border-b">{{ $item->barang->nama }}</td>
                            <td class="px-4 py-2 border-b">{{ $item->kuantitas }}</td>
                                                        <td class="px-4 py-2 border-b">{{ number_format($item->barang->harga_beli, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border-b">{{ number_format($item->barang->harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border-b">{{ number_format($item->diskon, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border-b">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <table class="min-w-full border border-gray-300 mb-6 mt-10">
            <tbody>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Pajak (%):</th>
                    <td class="px-4 py-2 border-b">{{ $faktur->label_pajak . ' ' . number_format($faktur->pajak, 0, ',', '.') . '%' }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Diskon (%):</th>
                    <td class="px-4 py-2 border-b">{{ number_format($faktur->diskon_faktur, 0, ',', '.') . '%' }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Total Faktur:</th>
                    <td class="px-4 py-2 border-b">Rp. {{ number_format($faktur->total, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Keuntungan:</th>
                    <td class="px-4 py-2 border-b">Rp. {{ number_format($faktur->keuntungan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Sisa Tagihan</th>
                    <td class="px-4 py-2 border-b">Rp. {{ number_format($faktur->sisa_tagihan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Sudah Dibayar</th>
                    <td class="px-4 py-2 border-b">Rp. {{ number_format($totalBayar, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Status</th>
                    <td class="px-4 py-2 border-b">
                        @if ($faktur->status == 'lunas')
                            <span class="badge bg-success">Lunas</span>
                        @else
                            <span class="badge bg-warning">Belum Lunas</span>
                        @endif
                    </td>
                </tr>
                
                <tr>
                    <th class="px-4 py-2 text-left border-b">Catatan:</th>
                    <td class="px-4 py-2 border-b">{{ $faktur->catatan }}</td>
                </tr>
            </tbody>
        </table>


    </div>
















    <div class="container mx-auto flex justify-between items-center md:justify-start space-x-4">


        <a href="{{ url('fakturs') }}"
            class="mt-6 inline-block text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                class="fa-solid fa-arrow-left"></i></a>

        <!-- Tombol untuk membuka modal preview -->
        <button type="button" data-modal-toggle="previewModal"
            class="mt-6 inline-block text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center">
            <i class="fa-solid fa-eye"></i>
        </button>


        <div class="mt-6">
            <button id="openModalBtn" data-modal-target="sendModal" data-modal-toggle="sendModal"
                class="bg-blue-500 text-white px-5 py-2.5 font-medium rounded-full text-sm hover:bg-blue-600">
                <i class="fa-regular fa-paper-plane"></i>
            </button>
        </div>




        <!-- Tombol untuk membuka modal -->
        <a href="#" data-modal-target="paymentModal" data-modal-toggle="paymentModal"
            class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mt-6">
            <i class="fa-solid fa-credit-card"></i>
        </a>





    </div>




    <!-- Modal -->
    <div id="paymentModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Pembayaran
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="paymentModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    <div class="space-y-2 space-x-2">
                        <!-- Tombol untuk melakukan pembayaran -->
                        <a href="{{ route('pembayaran.create', $faktur->id) }}"
                            class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <i class="fa-solid fa-credit-card"></i> Pembayaran
                        </a>
                        <!-- Tombol untuk melihat riwayat pembayaran -->
                        <a href="{{ route('pembayaran.riwayat', $faktur->id) }}"
                            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <i class="fa-solid fa-clock-rotate-left"></i> Riwayat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>











   <!-- Modal untuk preview faktur -->
<div id="previewModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-modal">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600 modal-header">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Preview Faktur
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="previewModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

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
            <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600 modal-footer">
                <button type="button" onclick="window.print()"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Cetak
                </button>
            </div>
        </div>
    </div>
</div>


<style>
    @media print {
    #previewModal .modal-header, /* Sembunyikan header modal */
    #previewModal .modal-footer { /* Sembunyikan footer modal */
        display: none;
    }
    
    #previewModal {
        position: absolute; /* Menghilangkan modal dari layout */
        width: auto; /* Membiarkan lebar otomatis */
        height: auto; /* Membiarkan tinggi otomatis */
        top: 0; /* Memposisikan ulang */
        left: 0; /* Memposisikan ulang */
        right: 0; /* Memposisikan ulang */
    }
}


</style>
















    <!-- Modal untuk mengirim email -->
    <!--<div id="sendModal" tabindex="-1" aria-hidden="true"-->
    <!--    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-modal md:h-full">-->
    <!--    <div class="relative w-full h-full max-w-2xl md:h-auto">-->
    <!--        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">-->
    <!--            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">-->
    <!--                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Kirim</h3>-->
    <!--                <button type="button"-->
    <!--                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"-->
    <!--                    data-modal-hide="sendModal">-->
    <!--                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"-->
    <!--                        xmlns="http://www.w3.org/2000/svg">-->
    <!--                        <path fill-rule="evenodd"-->
    <!--                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"-->
    <!--                            clip-rule="evenodd"></path>-->
    <!--                    </svg>-->
    <!--                    <span class="sr-only">Close modal</span>-->
    <!--                </button>-->
    <!--            </div>-->


    <!--            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">-->
    <!--                <p style="display: none;">Sisa Tagihan: <span id="sisaTagihan">{{ number_format($faktur->sisa_tagihan, 0, ',', '.') }}</span>-->
    <!--                </p>-->
    <!--                <a id="whatsappButton" href="#" target="_blank"-->
    <!--                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Hubungi-->
    <!--                    lewat WhatsApp</a>-->

    <!--                <p style="display: none;">Sisa Tagihan: <span id="sisaTagihan">{{ number_format($faktur->sisa_tagihan, 0, ',', '.') }}</span>-->
    <!--                </p>-->
    <!--                <a id="emailButton" href="#" target="_blank" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kirim Email</a>-->
    <!--            </div>-->

    <!--            <div>-->

    <!--            </div>-->

                <script>-->
                  $(document).ready(function() {
                        var sisaTagihan = "{{ number_format($faktur->sisa_tagihan, 0, ',', '.') }}";
                        var emailPengirim = '{{ env('MAIL_FROM_ADDRESS') }}';
                      var subject = 'Informasi Sisa Tagihan';
                        var body = 'Terima kasih atas bisnis Anda. Jumlah yang harus dibayar adalah: Rp. ' + sisaTagihan;

                    $('#emailButton').on('click', function() {
                            var mailtoURL = 'mailto:?subject=' + encodeURIComponent(subject) + '&body=' +
                               encodeURIComponent(body);

                           $(this).attr('href', mailtoURL);
                      });
                  });
                    
                    
                    $(document).ready(function() {
                        $('#whatsappButton').on('click', function() {
                            var sisaTagihan = $('#sisaTagihan').text();

                            var defaultMessage = 'Terima kasih atas bisnis Anda. Jumlah yang harus dibayar adalah: Rp. ' + sisaTagihan;

                            var whatsappURL = 'https://wa.me/?text=' + encodeURIComponent(defaultMessage);

                            $(this).attr('href', whatsappURL);
                      });
                    });
                </script>
    
    
    
    <div id="sendModal" tabindex="-1" aria-hidden="true"
     class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-modal md:h-full">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Kirim</h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="sendModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <p style="display: none;">Sisa Tagihan: <span id="sisaTagihan">{{ number_format($faktur->sisa_tagihan, 0, ',', '.') }}</span></p>
                
                <!-- Menyimpan ID Faktur dalam elemen yang tersembunyi -->
                <input type="hidden" id="fakturId" value="{{ $faktur->id }}">

                <a id="whatsappButton" href="#" target="_blank"
                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Hubungi
                    lewat WhatsApp</a>

                <p style="display: none;">Sisa Tagihan: <span id="sisaTagihan">{{ number_format($faktur->sisa_tagihan, 0, ',', '.') }}</span></p>
                <a id="emailButton" href="#" target="_blank" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kirim Email</a>
            </div>

            <script>
                $(document).ready(function() {
                    var sisaTagihan = "{{ number_format($faktur->sisa_tagihan, 0, ',', '.') }}"; // Ambil sisa tagihan dari server
                    var emailPengirim = '{{ env('MAIL_FROM_ADDRESS') }}'; // Ambil alamat email dari .env
                    var subject = 'Informasi Sisa Tagihan';
                    var fakturId = $('#fakturId').val(); // Ambil ID faktur dari input tersembunyi

                    // URL dinamis menuju view faktur-baru
                    var url = 'https://pos.websainstren.com/faktur-baru/' + fakturId; // Membuat URL dengan ID faktur
                    var body = 'Terima kasih atas bisnis Anda. Jumlah yang harus dibayar adalah: Rp. ' + sisaTagihan + ' \nLihat detail faktur: ' + url;

                    $('#emailButton').on('click', function() {
                        // Membuat URL mailto dengan subjek dan isi email
                        var mailtoURL = 'mailto:?subject=' + encodeURIComponent(subject) + '&body=' +
                            encodeURIComponent(body);

                        // Mengatur atribut href tombol email
                        $(this).attr('href', mailtoURL);
                    });

                    $('#whatsappButton').on('click', function() {
                        // Ambil sisa tagihan dari elemen di halaman
                        var sisaTagihan = $('#sisaTagihan').text(); // Ambil teks dari elemen dengan ID #sisaTagihan
                        
                        // Pesan default untuk dikirim ke WhatsApp
                        var defaultMessage =
                            'Terima kasih atas bisnis Anda. Jumlah yang harus dibayar adalah: Rp. ' + sisaTagihan + ' \nLihat detail faktur: ' + url;

                        // Membuat URL WhatsApp dengan pesan default
                        var whatsappURL = 'https://wa.me/?text=' + encodeURIComponent(defaultMessage);

                        // Mengatur atribut href tombol WhatsApp
                        $(this).attr('href', whatsappURL);
                    });
                });
            </script>
        </div>
    </div>
</div>







                    








                <script>
                    $(document).ready(function() {
                        // Fungsi untuk koneksi ke printer Bluetooth
                        function connectBluetoothPrinter() {
                            navigator.bluetooth.requestDevice({
                                    filters: [{
                                        services: ['printer_service_uuid']
                                    }] // UUID dari layanan printer Bluetooth
                                })
                                .then(device => device.gatt.connect())
                                .then(server => server.getPrimaryService('printer_service_uuid')) // UUID layanan printer
                                .then(service => service.getCharacteristic(
                                    'printer_characteristic_uuid')) // UUID karakteristik printer
                                .then(characteristic => {
                                    // Data yang akan dikirim ke printer
                                    let encoder = new TextEncoder();
                                    let data = encoder.encode("Data yang akan dicetak dari Bluetooth printer!");

                                    // Kirim data ke printer
                                    return characteristic.writeValue(data);
                                })
                                .then(() => {
                                    alert("Cetak berhasil melalui Bluetooth!");
                                })
                                .catch(error => {
                                    console.log('Kesalahan saat koneksi ke Bluetooth printer:', error);
                                });
                        }

                        // Tombol Cetak Bluetooth menggunakan jQuery
                        $('#bluetoothPrintBtn').on('click', function() {
                            connectBluetoothPrinter();
                        });
                    });


















                    
                </script>



</x-layout>
