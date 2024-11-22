<x-layout title="Daftar Faktur Pelanggan">
    <ul class="divide-y divide-gray-200 bg-white shadow rounded-lg p-4">
        @forelse ($fakturs as $faktur)
        <li class="py-4">
            <a href="{{ route('fakturs.summary', $faktur->id) }}" class="block">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-medium">Faktur# {{ $faktur->nomor_faktur }}</p>
                        <p class="text-gray-500 text-sm">Tanggal: {{ \Carbon\Carbon::parse($faktur->tanggal)->format('M d, Y') }}</p>
                        <p class="text-gray-500 text-sm">Pelanggan: {{ $pelanggan->nama }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-blue-500">Rp{{ number_format($faktur->total, 0, ',', '.') }}</p>
                        <p class="text-gray-500 text-sm">
                            @if($faktur->status == 'lunas')
                                <span class="text-green-500">Lunas</span>
                            @else
                                Jatuh tempo dalam {{ $faktur->tempo_hari }} hari
                            @endif
                        </p>
                    </div>
                </div>
            </a>
        </li>
        
        @empty
            <li class="py-4 text-center text-gray-500">Tidak ada faktur untuk pelanggan ini.</li>
        @endforelse
    </ul>

    <a href="{{ route('pelanggan.show', $pelanggan->id) }}" 
       class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mt-4 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
       <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>
</x-layout>
