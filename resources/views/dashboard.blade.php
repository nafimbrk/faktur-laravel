<x-layout>
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

        <!-- Tampilkan Total Income, Expense, dan Balance -->
        <ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white mb-6">
            <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                <h3>Total Balance: Rp {{ number_format($totalBalance, 0, ',', '.') }}</h3>
            </li>
            <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                <h4>Profit & Loss: Rp {{ number_format($totalBalance, 0, ',', '.') }}</h4>
            </li>
            <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                <h3> 
                    <i class="fa-solid fa-plus py-1 px-1 bg-blue-600 text-white rounded"></i>
                    <span class="text-blue-600">Rp {{ number_format($totalIncome, 0, ',', '.') }}</span> <!-- Total Income -->
                </h3>
            </li>
            <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                <h3> 
                    <i class="fa-solid fa-minus py-1 px-1 bg-red-600 text-white rounded"></i>
                    <span class="text-red-600">Rp {{ number_format($totalExpense, 0, ',', '.') }}</span> <!-- Total Expense -->
                </h3>
            </li>
        </ul>

        <!-- Filter untuk memilih bulan dan tahun -->
<form method="GET" action="{{ route('dashboard') }}" class="mb-4 w-full">
    <div class="flex flex-col md:flex-row items-center md:space-x-4 w-full">
        <div class="w-full md:w-auto flex items-center">
            <label for="month" class="mr-2">Month:</label>
            <select name="month" id="month" class="border p-2 w-full md:w-auto">
                @foreach (range(1, 12) as $m)
                    <option value="{{ $m }}" {{ request('month', date('n')) == $m ? 'selected' : '' }}>
                        {{ date('F', mktime(0, 0, 0, $m, 10)) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="w-full md:w-auto flex items-center mt-2 md:mt-0">
            <label for="year" class="mr-2">Year:</label>
            <select name="year" id="year" class="border p-2 w-full md:w-auto">
                @foreach (range(date('Y'), 2000) as $y)
                    <option value="{{ $y }}" {{ request('year', date('Y')) == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="w-full md:w-auto mt-2 md:mt-0">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full md:w-auto">Filter</button>
        </div>
    </div>
</form>

        <!-- Monthly Profit & Loss -->
<div class="bg-white p-6 rounded-lg shadow-lg mb-6">
    <h1 class="text-2xl font-semibold mb-4">Monthly Profit & Loss</h1>

    <!-- Elemen Canvas untuk Chart -->
    <canvas id="profitLossChart" class="mt-6"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Ambil data dari PHP ke dalam format JavaScript
    const monthlyData = @json($monthlyData);

    const labels = monthlyData.map(data => data.monthName);
    const pnlData = monthlyData.map(data => data.pnl);

    // Membuat Chart
    const ctx = document.getElementById('profitLossChart').getContext('2d');
    const profitLossChart = new Chart(ctx, {
        type: 'bar', // Jenis grafik
        data: {
            labels: labels,
            datasets: [{
                label: 'Profit & Loss (Rp)',
                data: pnlData,
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna batang
                borderColor: 'rgba(75, 192, 192, 1)', // Warna garis tepi
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Profit & Loss (Rp)'
                    }
                }
            }
        }
    });
</script>



<div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Expense & Income Summary</h1>

    <!-- Tabs untuk memilih antara Expense atau Income -->
    <div class="mb-4 border-b-0">
        <ul class="flex flex-wrap text-sm font-medium text-center" id="transaction-tabs">
            <li class="mr-2">
                <a href="#expense-section" id="expense-tab" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg active">
                    Expense
                </a>
            </li>
            <li class="mr-2">
                <a href="#income-section" id="income-tab" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg">
                    Income
                </a>
            </li>
        </ul>
    </div>

    <!-- Expense Summary -->
    <div id="expense-section">
        <h2 class="text-xl font-semibold mb-2">Expense Summary</h2>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <canvas id="expenseChart"></canvas>
        </div>
    </div>

    <!-- Income Summary -->
    <div id="income-section" class="hidden">
        <h2 class="text-xl font-semibold mb-2">Income Summary</h2>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <canvas id="incomeChart"></canvas>
        </div>
    </div>
</div>

<!-- Script untuk toggle tampilan berdasarkan pilihan tab dan membuat Chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Set default ke Expense
        $('#income-section').hide();
        $('#expense-tab').addClass('text-blue-600 border-blue-600');

        $('#transaction-tabs a').on('click', function(event) {
            event.preventDefault();
            $('#transaction-tabs a').removeClass('text-blue-600 border-blue-600');
            $(this).addClass('text-blue-600 border-blue-600');
            if ($(this).attr('href') === '#income-section') {
                $('#expense-section').hide();
                $('#income-section').show();
            } else {
                $('#income-section').hide();
                $('#expense-section').show();
            }
        });

        // Data dari PHP ke dalam format JavaScript
        const monthlyData = @json($monthlyData);

        const expenseLabels = monthlyData.map(data => data.monthName);
        const expenseData = monthlyData.map(data => data.totalExpense);
        const incomeData = monthlyData.map(data => data.totalIncome);

        // Membuat Chart Expense
        const expenseCtx = document.getElementById('expenseChart').getContext('2d');
        new Chart(expenseCtx, {
            type: 'bar',
            data: {
                labels: expenseLabels,
                datasets: [{
                    label: 'Total Expense (Rp)',
                    data: expenseData,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna batang
                    borderColor: 'rgba(255, 99, 132, 1)', // Warna garis tepi
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Total Expense (Rp)'
                        }
                    }
                }
            }
        });

        // Membuat Chart Income
        const incomeCtx = document.getElementById('incomeChart').getContext('2d');
        new Chart(incomeCtx, {
            type: 'bar',
            data: {
                labels: expenseLabels,
                datasets: [{
                    label: 'Total Income (Rp)',
                    data: incomeData,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Warna batang
                    borderColor: 'rgba(54, 162, 235, 1)', // Warna garis tepi
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Total Income (Rp)'
                        }
                    }
                }
            }
        });
    });
</script>

        
        
        

        <!-- Tombol tambah income atau expense -->
        <div class="container mx-auto flex justify-end items-center mt-4 md:justify-start">
            <a href="{{ route('expense.create') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
    </div>





    
    
</x-layout>
