<x-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Transactions Calendar</h1>

        <form method="GET" action="{{ route('transactions.calendar') }}" class="mb-4">
            <div class="flex items-center mb-4">
                <select name="month" class="border rounded p-2 mr-2">
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                        </option>
                    @endfor
                </select>

                <select name="year" class="border rounded p-2 mr-2">
                    @for ($y = date('Y') - 5; $y <= date('Y'); $y++)
                        <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>

                <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2">Filter</button>
            </div>

            <div class="flex items-center">
                <label class="mr-4">
                    <input type="checkbox" name="transaction_types[]" value="expense" {{ in_array('expense', $transactionTypes) ? 'checked' : '' }}>
                    Expense
                </label>
                <label>
                    <input type="checkbox" name="transaction_types[]" value="income" {{ in_array('income', $transactionTypes) ? 'checked' : '' }}>
                    Income
                </label>
            </div>
        </form>

        <!-- Navigasi Minggu -->
        <!--<div class="mb-4">-->
        <!--    <form method="GET" action="{{ route('transactions.calendar') }}" class="inline-block">-->
        <!--        <input type="hidden" name="week" value="{{ $week - 1 }}">-->
        <!--        <input type="hidden" name="month" value="{{ $month }}">-->
        <!--        <input type="hidden" name="year" value="{{ $year }}">-->
        <!--        <button type="submit" class="bg-gray-300 rounded px-4 py-2 mr-2">Minggu Sebelumnya</button>-->
        <!--    </form>-->
        <!--    <form method="GET" action="{{ route('transactions.calendar') }}" class="inline-block">-->
        <!--        <input type="hidden" name="week" value="{{ $week + 1 }}">-->
        <!--        <input type="hidden" name="month" value="{{ $month }}">-->
        <!--        <input type="hidden" name="year" value="{{ $year }}">-->
        <!--        <button type="submit" class="bg-gray-300 rounded px-4 py-2">Minggu Berikutnya</button>-->
        <!--    </form>-->
        <!--</div>-->

        <!-- Tabel Ringkasan Mingguan -->
        <!--<div class="bg-white p-6 rounded-lg shadow-lg mb-4">-->
        <!--    <h2 class="text-xl font-semibold mb-2">Weekly Summary</h2>-->
        <!--    <table class="min-w-full table-auto">-->
        <!--        <thead>-->
        <!--            <tr>-->
        <!--                <th class="px-4 py-2 border">Week</th>-->
        <!--                <th class="px-4 py-2 border">Total Income (Rp)</th>-->
        <!--                <th class="px-4 py-2 border">Total Expense (Rp)</th>-->
        <!--            </tr>-->
        <!--        </thead>-->
        <!--        <tbody>-->
        <!--            @foreach ($filteredSummary as $data)-->
        <!--                <tr>-->
        <!--                    <td class="px-4 py-2 border">Week {{ $data['week'] }}</td>-->
        <!--                    <td class="px-4 py-2 border">Rp {{ number_format($data['totalIncome'], 0, ',', '.') }}</td>-->
        <!--                    <td class="px-4 py-2 border">Rp {{ number_format($data['totalExpense'], 0, ',', '.') }}</td>-->
        <!--                </tr>-->
        <!--            @endforeach-->
        <!--        </tbody>-->
        <!--    </table>-->
        <!--</div>-->

        <!-- Kalender -->
        <div id="calendar"></div>
    </div>

    @push('scripts')
    <!-- FullCalendar Library -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                initialDate: '{{ $year }}-{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}-01',
                headerToolbar: false, // Menghilangkan toolbar
                buttonText: {
                    today: '' // Menghilangkan tombol "Today"
                },
                events: [
                    @foreach ($transactions as $transaction)
                    {
                        title: "{{ get_class($transaction) === 'App\Models\Expense' ? '-' : '+' }} Rp{{ number_format($transaction->amount, 0, ',', '.') }}",
                        start: "{{ $transaction->date }}",
                        color: "{{ get_class($transaction) === 'App\Models\Expense' ? '#f87171' : '#60a5fa' }}",
                        url: "{{ route('transactions.index', ['month' => $month, 'year' => $year]) }}", // Arahkan ke rute daftar transaksi
                    },
                    @endforeach
                ],
                eventClick: function(info) {
                    // Buka URL transaksi saat event diklik
                    window.location = info.event.url;
                }
            });

            calendar.render();
        });
    </script>
@endpush



<div class="container mx-auto flex justify-end items-center mt-4 md:justify-start">
            <a href="{{ route('expense.create') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>

</x-layout>
