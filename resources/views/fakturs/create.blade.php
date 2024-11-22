<x-layout>
    <h1 class="text-2xl font-bold mb-4">Buat Faktur Baru</h1>

    <form action="{{ route('fakturs.store') }}" method="POST">
        @csrf

        <div class="mb-6">
            <label for="nomor_faktur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Faktur #</label>
            <input type="text" name="nomor_faktur" id="nomor_faktur" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>

        <div class="mb-6">
            <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>

        <div class="mb-6">
            <label for="jatuh_tempo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jatuh Tempo</label>
            <input type="date" name="jatuh_tempo" id="jatuh_tempo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            <div class="mt-2">
                <strong>Tempo: <span id="tempo">0</span> hari</strong>
            </div>
        </div>
        <input type="hidden" name="tempo_hari" id="tempo_hari">

        <div class="mb-6">
            <label for="pelanggan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ditagih Kepada</label>
            <select name="pelanggan_id" id="pelanggan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="" disabled selected>Pilih Pelanggan</option>
                @foreach ($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                @endforeach
            </select>
        </div>

        <h3 class="text-xl font-semibold mb-4">Items</h3>

        <div id="items-container" class="space-y-4 mb-6">
            <div class="item border p-4 rounded">
                <label for="barang_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barang:</label>
                <select name="items[0][barang_id]" id="barang_id_0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="" disabled selected>Pilih Barang</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}" data-harga="{{ $barang->harga }}">
                            {{ $barang->nama }} ({{ number_format($barang->harga, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>

                <label for="kuantitas" class="block mt-4 mb-2">Kuantitas:</label>
                <input type="number" name="items[0][kuantitas]" value="1" min="1" class="form-control kuantitas border rounded w-full p-2" required>

                <label for="diskon" class="block mt-4 mb-2">Diskon (IDR):</label>
                <input type="number" name="items[0][diskon]" value="0" min="0" class="form-control diskon border rounded w-full p-2">
                <input type="hidden" name="items[0][subtotal]" class="subtotal_input">

                <div class="mt-4"><strong>Subtotal: Rp. <span class="subtotal">0</span></strong></div>
                <button type="button" class="remove-item text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 mt-4">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>
        </div>

        <button type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2" id="add-item">
            <i class="fa-solid fa-plus"></i>
        </button>

        <!-- Input tambahan -->
        <div class="mb-6">
            <label for="label_pajak" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Label Pajak</label>
            <input type="text" name="label_pajak" id="label_pajak" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <div class="mb-6">
            <label for="pajak" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pajak (%)</label>
            <input type="number" name="pajak" id="pajak" value="0" min="0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <div class="flex items-center mt-2">
                <input type="checkbox" id="pajak-include" class="mr-2">
                <label for="pajak-include" class="text-sm">Termasuk</label>
            </div>
        </div>

        <div class="mb-6">
            <label for="diskon_faktur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Diskon Faktur (%)</label>
            <input type="number" name="diskon_faktur" id="diskon_faktur" value="0" min="0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <div class="flex items-center mt-2">
                <input type="checkbox" id="diskon-after-tax" class="mr-2">
                <label for="diskon-after-tax" class="text-sm">Setelah Pajak</label>
            </div>
        </div>

        <div class="mt-6 mb-6">
            <strong>Total: Rp. <span id="total">0</span></strong>
        </div>
        <div class="mt-6 mb-6">
            <strong>Jumlah yang harus dibayar: Rp. <span id="bayar">0</span></strong>
        </div>
        <input type="hidden" name="total" id="total-input">

        <div class="mb-6">
            <label for="catatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan</label>
            <textarea name="catatan" id="catatan" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500" required></textarea>
        </div>

        <div class="container mx-auto flex justify-between items-center md:justify-start">
            <a href="{{ route('fakturs.index') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2">
                <i class="fa-solid fa-check"></i>
            </button>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateTempo() {
            let tanggal = $('#tanggal').val();
            let jatuhTempo = $('#jatuh_tempo').val();

            if (tanggal && jatuhTempo) {
                let date1 = new Date(tanggal);
                let date2 = new Date(jatuhTempo);
                let timeDiff = date2.getTime() - date1.getTime();
                let diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                let tempoHari = diffDays > 0 ? diffDays : 0;

                $('#tempo').text(tempoHari);
                $('#tempo_hari').val(tempoHari);
            }
        }

        function updateTotal() {
    let total = 0;

    // Loop untuk setiap item di dalam kontainer
    $('#items-container .item').each(function(index) {
        let harga = parseFloat($(this).find('select[name*="barang_id"] option:selected').data('harga')) || 0;
        let kuantitas = parseFloat($(this).find('.kuantitas').val()) || 0;
        let diskon = parseFloat($(this).find('.diskon').val()) || 0;

        // Hitung subtotal item
        let subtotal = (harga * kuantitas) - diskon;
        subtotal = Math.max(0, subtotal); // Pastikan subtotal tidak negatif
        total += subtotal;

        // Tampilkan subtotal per item
        $(this).find('.subtotal').text(subtotal.toFixed(0));

        // Periksa apakah input hidden subtotal ada, jika tidak, tambahkan
        if (!$(this).find('.subtotal-input').length) {
            $(this).append(`<input type="hidden" class="subtotal-input" value="${subtotal.toFixed(0)}">`);
        } else {
            $(this).find('.subtotal-input').val(subtotal.toFixed(0));
        }

        // Perbarui nama input dinamis untuk setiap item
        $(this).find('select[name*="barang_id"]').attr('name', `items[${index}][barang_id]`);
        $(this).find('.kuantitas').attr('name', `items[${index}][kuantitas]`);
        $(this).find('.diskon').attr('name', `items[${index}][diskon]`);
        $(this).find('.subtotal-input').attr('name', `items[${index}][subtotal]`);
    });

    // Hitung total setelah diskon faktur dan pajak
    let pajakPersen = parseFloat($('#pajak').val()) || 0;
    let diskonFakturPersen = parseFloat($('#diskon_faktur').val()) || 0;

    // Periksa apakah pajak termasuk
    let pajak = (total * pajakPersen) / 100;
    if ($('#pajak-include').is(':checked')) {
        // Jika pajak termasuk dalam total
        total = total / (1 + pajakPersen / 100);
        pajak = total * (pajakPersen / 100);
    }

    // Hitung diskon faktur
    let diskonFaktur = 0;
    if ($('#diskon-after-tax').is(':checked')) {
        // Jika diskon diterapkan setelah pajak
        diskonFaktur = (total + pajak) * (diskonFakturPersen / 100);
    } else {
        // Jika diskon diterapkan sebelum pajak
        diskonFaktur = total * (diskonFakturPersen / 100);
    }

    // Hitung total akhir dengan penyesuaian
    total = total - diskonFaktur; // Total setelah diskon faktur
    total += pajak; // Tambahkan pajak jika tidak termasuk

    // Tampilkan total akhir
    $('#total').text(total.toFixed(0));
    $('#bayar').text(total.toFixed(0));
    
    // Perbarui input hidden dengan total baru
    $('#total-input').val(total.toFixed(0));
}




$(document).ready(function() {
    // Event listeners untuk update total
    $('#tanggal, #jatuh_tempo').change(updateTempo);
    $('#pajak, #diskon_faktur').change(updateTotal);
    $('#pajak-include, #diskon-after-tax').change(updateTotal);

    $('#items-container').on('change', 'select[name*="barang_id"], .kuantitas, .diskon', updateTotal);

    $('#add-item').click(function() {
        let index = $('#items-container .item').length;
        $('#items-container').append(`
            <div class="item border p-4 rounded">
                <label for="barang_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barang:</label>
                <select name="items[${index}][barang_id]" id="barang_id_${index}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="" disabled selected>Pilih Barang</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}" data-harga="{{ $barang->harga }}">
                            {{ $barang->nama }} ({{ number_format($barang->harga, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>

                <label for="kuantitas" class="block mt-4 mb-2">Kuantitas:</label>
                <input type="number" name="items[${index}][kuantitas]" value="1" min="1" class="form-control kuantitas border rounded w-full p-2" required>

                <label for="diskon" class="block mt-4 mb-2">Diskon (IDR):</label>
                <input type="number" name="items[${index}][diskon]" value="0" min="0" class="form-control diskon border rounded w-full p-2">

                <div class="mt-4"><strong>Subtotal: Rp. <span class="subtotal">0</span></strong></div>
                <button type="button" class="remove-item text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 mt-4">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>
        `);
    });

    $('#items-container').on('click', '.remove-item', function() {
        $(this).closest('.item').remove();
        updateTotal();
    });

    // Initial total calculation
    updateTotal();
});

    </script>
</x-layout>
