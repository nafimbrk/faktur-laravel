<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Transaction;

class TransactionController extends Controller
{

    public function index(Request $request)
{
    // Ambil bulan dan tahun dari request, jika tidak ada, gunakan bulan dan tahun saat ini
    $currentMonth = date('m');
    $currentYear = date('Y');

    $month = $request->input('month', $currentMonth);
    $year = $request->input('year', $currentYear);

    // Ambil pilihan jenis transaksi dari request
    $transactionTypes = $request->input('transaction_types', ['expense', 'income']); // Default ke semua jenis transaksi

    // Ambil data transaksi berdasarkan pilihan
    $expenses = in_array('expense', $transactionTypes) ? Expense::whereYear('date', $year)->whereMonth('date', $month)->get() : collect();
    $incomes = in_array('income', $transactionTypes) ? Income::whereYear('date', $year)->whereMonth('date', $month)->get() : collect();

    // Gabungkan kedua koleksi
    $transactions = $expenses->concat($incomes);

    // Urutkan berdasarkan tanggal secara descending
    $transactions = $transactions->sortByDesc('date');

    // Kelompokkan transaksi berdasarkan tanggal
    $groupedTransactions = $transactions->groupBy(function ($transaction) {
        return \Carbon\Carbon::parse($transaction->date)->format('Y-m-d'); // Menggunakan format tanggal untuk grup
    });

    // Hitung total untuk setiap tanggal
    $totals = [];
    foreach ($groupedTransactions as $date => $group) {
        $totals[$date] = [
            'income' => $group->whereInstanceOf(Income::class)->sum('amount'),
            'expense' => $group->whereInstanceOf(Expense::class)->sum('amount'),
        ];
    }

    return view('transactions.index', compact('groupedTransactions', 'totals', 'month', 'year', 'transactionTypes'));
}



    





























public function show($id)
{
    // Ambil data transaksi berdasarkan ID (Pastikan ID unik antar tabel)
    $transaction = Expense::find($id) ?? Income::find($id) ?? Transaction::find($id);

    // Pastikan bahwa transaksi ditemukan
    if (!$transaction) {
        abort(404); // Jika tidak ditemukan, tampilkan halaman 404
    }

    return view('transactions.show', compact('transaction'));
}





// app/Http/Controllers/TransactionController.php

public function calendar(Request $request)
{
    $currentMonth = date('m');
    $currentYear = date('Y');
    $currentWeek = date('W');

    // Ambil minggu, bulan, dan tahun dari request
    $week = $request->input('week', $currentWeek);
    $month = $request->input('month', $currentMonth);
    $year = $request->input('year', $currentYear);

    // Ambil transaction types
    $transactionTypes = $request->input('transaction_types', ['expense', 'income']);

    // Ambil transaksi expense dan income
    $expenses = in_array('expense', $transactionTypes) ? Expense::whereYear('date', $year)->whereMonth('date', $month)->get() : collect();
    $incomes = in_array('income', $transactionTypes) ? Income::whereYear('date', $year)->whereMonth('date', $month)->get() : collect();

    $transactions = $expenses->concat($incomes);

    // Kelompokkan transaksi per minggu
    $summary = [];
    foreach ($transactions as $transaction) {
        $weekOfYear = \Carbon\Carbon::parse($transaction->date)->weekOfYear;

        if (!isset($summary[$weekOfYear])) {
            $summary[$weekOfYear] = [
                'week' => $weekOfYear,
                'totalIncome' => 0,
                'totalExpense' => 0,
            ];
        }

        if ($transaction instanceof Expense) {
            $summary[$weekOfYear]['totalExpense'] += $transaction->amount;
        } else {
            $summary[$weekOfYear]['totalIncome'] += $transaction->amount;
        }
    }

    // Mengindeks ulang array summary untuk mengurutkan
    $summary = array_values($summary);
    
    // Filter summary berdasarkan minggu yang diminta
    $filteredSummary = array_filter($summary, fn($data) => $data['week'] == $week);

    return view('transactions.calendar', compact('transactions', 'filteredSummary', 'month', 'year', 'transactionTypes', 'week'));
}




}

