<x-layout>
    <h1 class="text-2xl font-bold mb-4">Edit Faktur</h1>

    <form action="{{ route('fakturs.update', $faktur->id) }}" method="POST" id="faktur-form" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="nomor_faktur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Faktur #</label>
            <input type="text" name="nomor_faktur" id="nomor_faktur" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $faktur->nomor_faktur}}" required>
        </div>
        <div class="mb-6">
            <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $faktur->tanggal}}" required>
        </div>
        <div class="mb-6">
            <label for="jatuh_tempo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jatuh Tempo</label>
            <input type="date" name="jatuh_tempo" id="jatuh_tempo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $faktur->jatuh_tempo }}" required>
            <div class="mt-2">
                <strong>Tempo: <span id="tempo">{{ $faktur->tempo_hari }}</span> hari</strong> <!-- Menampilkan nilai tempo_hari -->
                </div>
                </div>
            
                <!-- Hidden input untuk menyimpan nilai tempo_hari -->
                <input type="hidden" name="tempo_hari" id="tempo_hari" value="{{ $faktur->tempo_hari }}">
        
        <div class="mb-6">
            <label for="pelanggan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ditagih Kepada</label>
            <select name="pelanggan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="" disabled selected>Pilih Pelanggan</option>
                @foreach($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}" {{ $pelanggan->id == $faktur->pelanggan_id ? 'selected' : '' }}>
                        {{ $pelanggan->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        

        <h3 class="text-xl font-semibold mb-4">Items</h3>

        <div id="items-container" class="space-y-4 mb-6">
            @foreach($faktur->items as $index => $item)
                <div class="item border p-4 rounded">
                    <label for="barang_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barang:</label>
                    <select name="items[{{ $index }}][barang_id]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="" disabled selected>Pilih Barang</option>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}" data-harga="{{ $barang->harga }}" {{ $barang->id == $item->barang_id ? 'selected' : '' }}>
                                {{ $barang->nama }} ({{ number_format($barang->harga, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>

                    <label for="kuantitas" class="block mt-4 mb-2">Kuantitas:</label>
                    <input type="number" name="items[{{ $index }}][kuantitas]" value="{{ $item->kuantitas }}" min="1" class="form-control kuantitas border rounded w-full p-2" required>

                    <label for="diskon" class="block mt-4 mb-2">Diskon (Opsional):</label>
                    <input type="number" name="items[{{ $index }}][diskon]" value="{{ $item->diskon }}" min="0" class="form-control border rounded w-full p-2 diskon">

                    <input type="hidden" name="items[${itemCount}][subtotal]" class="subtotal-input" value="0">

                    <div class="mt-4"><strong>Subtotal: Rp. <span class="subtotal">{{ number_format($item->subtotal, 0, ',', '.') }}</span></strong></div>

                    <button type="button" class="text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 mt-4 remove-item"><i class="fa-solid fa-x"></i></button>
                </div>
            @endforeach
        </div>
        

        <button type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="add-item"><i class="fa-solid fa-plus"></i></button>





        <!-- Input tambahan -->
<div class="mb-6">
    <label for="label_pajak" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Label Pajak</label>
    <input type="text" name="label_pajak" value="{{ old('label_pajak', $faktur->label_pajak ?? '') }}" id="label_pajak" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
</div>

<div class="mb-6">
    <label for="pajak" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pajak (%)</label>
    <input type="number" name="pajak" id="pajak" value="{{ old('pajak', $faktur->pajak ?? 0) }}" min="0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
    <div class="flex items-center mt-2">
        <input type="checkbox" id="pajak-include" class="mr-2">
        <label for="pajak-include" class="text-sm">Termasuk Pajak</label>
    </div>
</div>

<div class="mb-6">
    <label for="diskon_faktur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Diskon Faktur (%)</label>
    <input type="number" name="diskon_faktur" id="diskon_faktur" value="{{ old('diskon_faktur', $faktur->diskon_faktur ?? 0) }}" min="0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
    <div class="flex items-center mt-2">
        <input type="checkbox" id="diskon-after-tax" class="mr-2">
        <label for="diskon-after-tax" class="text-sm">Setelah Pajak</label>
    </div>
</div>





        
        <div class="mt-6 mb-6">
            <strong>Total: Rp. <span id="total">{{ number_format($faktur->total, 0, ',', '.') }}</span></strong>
        </div>
        <div class="mt-6 mb-6">
            <strong>Jumlah yang harus dibayar: Rp. <span id="bayar">{{ number_format($faktur->total, 0, ',', '.') }}</span></strong>
        </div>
        <input type="hidden" name="total" id="total-input" value="{{ $faktur->total }}">
        
        
        
        <div class="mb-6">
            <label for="catatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan</label>
            <textarea name="catatan" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500" required>{{ $faktur->catatan }}</textarea>
        </div>

        <div class="container mx-auto flex justify-between items-center md:justify-start">
            <a href="{{ route('fakturs.index') }}"
               class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        
            
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">                <i class="fa-solid fa-check"></i>
            </button>
        </div>
        
    </form>
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            // Menghitung tempo
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
    
        // Update subtotal
        function updateSubtotal(item) {
    let $itemContainer = $(item).closest('.item');
    let kuantitas = parseFloat($itemContainer.find('input[name*="kuantitas"]').val()) || 0;
    let harga = parseFloat($itemContainer.find('select[name*="barang_id"] option:selected').data('harga')) || 0;
    let diskon = parseFloat($itemContainer.find('input[name*="diskon"]').val()) || 0;

    let subTotal = kuantitas * harga;

    // Hitung diskon
    if (diskon > 0) {
        let diskonAmount = (subTotal * diskon) / 100;
        subTotal -= diskonAmount;
    }

    // Pastikan subtotal tidak negatif
    subTotal = Math.max(0, subTotal);

    // Tampilkan subtotal
    $itemContainer.find('.subtotal').text(subTotal.toLocaleString('id-ID'));
    
    // Update input hidden subtotal
    $itemContainer.find('.subtotal-input').val(subTotal.toFixed(0)); // Memperbarui nilai di input hidden

    // Update total keseluruhan
    updateTotal();
}



function updateTotal() {
    let total = 0;
    $('#items-container .item').each(function() {
        let subtotal = parseFloat($(this).find('.subtotal-input').val()) || 0; // Mengambil subtotal dari input tersembunyi
        total += subtotal;

        $(this).find('.subtotal').text(subtotal.toFixed(0));
    });

    // Hitung total setelah diskon dan pajak
    let pajakPersen = parseFloat($('#pajak').val()) || 0;
    let diskonFakturPersen = parseFloat($('#diskon_faktur').val()) || 0;

    let pajak = (total * pajakPersen) / 100;
    if ($('#pajak-include').is(':checked')) {
        total -= pajak; // Jika pajak termasuk
    } else {
        total += pajak;
    }

    if ($('#diskon-after-tax').is(':checked')) {
        let diskonFaktur = (total * diskonFakturPersen) / 100;
        total -= diskonFaktur; // Diskon setelah pajak
    } else {
        let diskonFaktur = (total * diskonFakturPersen) / 100;
        total -= diskonFaktur;
        total += (total * pajakPersen) / 100; // Tambahkan pajak setelah diskon
    }

    $('#total').text(total.toFixed(0));
    $('#bayar').text(total.toFixed(0));
    $('#total-input').val(total.toFixed(0));
}


// Event listeners
$(document).on('change', 'input[name*="kuantitas"], select[name*="barang_id"], input[name*="diskon"]', function() {
    updateSubtotal(this); // Panggil updateSubtotal
});

// Tambah item baru
$('#add-item').on('click', function() {
    let itemCount = $('.item').length; // Menghitung jumlah item saat ini
    let newItem = `
        <div class="item border p-4 rounded">
            <label for="barang_id" class="block mb-2">Barang:</label>
            <select name="items[${itemCount}][barang_id]" class="form-control border rounded w-full p-2" required>
                <option value="" disabled selected>Pilih Barang</option>
                @foreach($barangs as $barang)
                    <option value="{{ $barang->id }}" data-harga="{{ $barang->harga }}">
                        {{ $barang->nama }} ({{ number_format($barang->harga, 0, ',', '.') }})
                    </option>
                @endforeach
            </select>

            <label for="kuantitas" class="block mt-4 mb-2">Kuantitas:</label>
            <input type="number" name="items[${itemCount}][kuantitas]" min="1" class="form-control kuantitas border rounded w-full p-2" required>

            <label for="diskon" class="block mt-4 mb-2">Diskon (Opsional):</label>
            <input type="number" name="items[${itemCount}][diskon]" min="0" class="form-control border rounded w-full p-2 diskon">

            <input type="hidden" name="items[${itemCount}][subtotal]" class="subtotal-input" value="0"> <!-- Menambahkan subtotal di sini -->

            <div class="mt-4"><strong>Subtotal: Rp. <span class="subtotal">0</span></strong></div>

            <button type="button" class="text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 mt-4 remove-item"><i class="fa-solid fa-x"></i></button>
        </div>
    `;
    $('#items-container').append(newItem);
    updateTotal(); // Memperbarui total setelah menambahkan item baru
});


// Hapus item
$(document).on('click', '.remove-item', function() {
    $(this).closest('.item').remove();
    updateTotal(); // Update total setelah item dihapus
});



    
    </script>
    
</x-layout>
