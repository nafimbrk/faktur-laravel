<x-layout>
    <div class="container mx-auto max-w-2xl p-6">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Transaction Details</h1>
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-700">Amount:</p>
                <p class="{{ get_class($transaction) === 'App\Models\Expense' ? 'text-red-600' : 'text-blue-600' }} font-medium">
                    {{ get_class($transaction) === 'App\Models\Expense' ? '-Rp' . number_format(abs($transaction->amount), 0, ',', '.') : '+Rp' . number_format($transaction->amount, 0, ',', '.') }}
                </p>
            </div>
            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-700">Date:</p>
                <p class="text-gray-800">{{ \Carbon\Carbon::parse($transaction->date)->format('F j, Y') }}</p>
            </div>
            
            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-700">Category:</p>
                <p class="text-gray-800">{{ $transaction->category ?? 'N/A' }}</p>
            </div>
            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-700">Notes:</p>
                <p class="text-gray-800">{{ $transaction->notes ?? 'No Notes' }}</p>
            </div>
        </div>
        <a href="{{ route('transactions.index') }}" class="inline-block mt-6 text-blue-600 font-semibold hover:underline">
            &larr; Back to All Transactions
        </a>
    </div>
</x-layout>
