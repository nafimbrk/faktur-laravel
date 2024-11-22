<x-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">All Transactions</h1>
        
        <form method="GET" action="{{ route('transactions.index') }}" class="mb-4">
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
        
<ul class="divide-y divide-gray-200">
    @foreach ($groupedTransactions as $date => $transactions)
        <li class="py-4">
            <!-- Menggunakan Flexbox untuk menata tanggal dan total income/expense secara horizontal -->
            <div class="flex justify-between items-center mb-2">
                <h2 class="font-semibold text-lg">{{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</h2>
                <div class="text-right">
                    <p <span class="text-blue-600 font-semibold">+Rp{{ number_format($totals[$date]['income'], 0, ',', '.') }}</span>     <span class="text-red-600 font-semibold">-Rp{{ number_format($totals[$date]['expense'], 0, ',', '.') }}</span></p>
                </div>
            </div>

            @foreach ($transactions as $transaction)
                <a href="{{ route('transactions.show', $transaction->id) }}" class="flex justify-between items-center">
                    <div class="mb-4">
                        <p class="font-medium">{{ $transaction->notes ?? 'No Notes' }}</p>
                        <p class="text-gray-500 text-sm">{{ \Carbon\Carbon::parse($transaction->date)->format('M d') }}</p>
                        <p class="text-xs text-gray-400">{{ get_class($transaction) === 'App\Models\Expense' ? 'Expense' : 'Income' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="{{ get_class($transaction) === 'App\Models\Expense' ? 'text-red-500' : 'text-blue-500' }}">
                            {{ get_class($transaction) === 'App\Models\Expense' ? '-Rp' . number_format(abs($transaction->amount), 0, ',', '.') : '+Rp' . number_format($transaction->amount, 0, ',', '.') }}
                        </p>
                    </div>
                </a>
            @endforeach
        </li>
    @endforeach
</ul>


<div class="container mx-auto flex justify-end items-center mt-4 md:justify-start">
            <a href="{{ route('expense.create') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
    </div>
</x-layout>
