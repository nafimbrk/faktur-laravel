<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function index(Request $request)
{
    $month = $request->input('month', date('m')); // Default ke bulan sekarang jika tidak ada yang dipilih
    $year = $request->input('year', date('Y'));   // Default ke tahun sekarang jika tidak ada yang dipilih

    // Hitung total income, expense, dan balance untuk bulan dan tahun yang dipilih
    $totalIncome = Income::whereYear('date', $year)
        ->whereMonth('date', $month)
        ->sum('amount');

    $totalExpense = Expense::whereYear('date', $year)
        ->whereMonth('date', $month)
        ->sum('amount');

    $totalBalance = $totalIncome - $totalExpense;

    // Definisikan $monthlyData dengan kunci yang tepat
    $monthlyData = [
        [
            'monthName' => date('F', mktime(0, 0, 0, $month, 10)),
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'pnl' => $totalBalance, // Profit & Loss
        ],
    ];

    // Kirim data ke view
    return view('dashboard', compact('totalIncome', 'totalExpense', 'totalBalance', 'monthlyData', 'month', 'year'));
}


    

    // Halaman create Income
    public function createIncome()
    {
        $categories = ['Salary', 'Donation', 'Gift', 'Other'];  // Misalkan kategori untuk income
        return view('income.create', compact('categories'));
    }

    // Simpan Income
    public function storeIncome(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        Income::create([
            'amount' => $request->amount,
            'date' => $request->date,
            'category' => $request->category,
            'notes' => $request->notes,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Income berhasil ditambahkan!');
    }

    // Halaman create Expense
    public function createExpense()
    {
        $categories = ['Food', 'Donation', 'Transportation', 'Other'];  // Misalkan kategori untuk expense
        return view('expense.create', compact('categories'));
    }

    // Simpan Expense
    public function storeExpense(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category' => 'required|string',
            'notes' => 'nullable|string',
            'foto' => 'nullable'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        Expense::create([
            'amount' => $request->amount,
            'date' => $request->date,
            'category' => $request->category,
            'notes' => $request->notes,
            'foto' => $request->foto
        ]);

        return redirect()->route('transactions.index')->with('success', 'Expense berhasil ditambahkan!');
    }




    


    public function getMonthlyPL($month)
{
    $yearMonth = explode('-', $month);
    $year = $yearMonth[0];
    $month = $yearMonth[1];

    $totalIncome = Income::whereYear('incomes.date', $year)->whereMonth('incomes.date', $month)->sum('amount');
    $totalExpense = Expense::whereYear('expenses.date', $year)->whereMonth('expenses.date', $month)->sum('amount');
    
    $monthlyPL = $totalIncome - $totalExpense;
    
    return response()->json(['monthlyPL' => $monthlyPL]);
}




public function getTransactionDetail($type, $month)
{
    $yearMonth = explode('-', $month);
    $year = $yearMonth[0];
    $month = $yearMonth[1];

    if ($type == 'income') {
        $amount = Income::whereYear('incomes.date', $year)->whereMonth('incomes.date', $month)->sum('amount');
    } else {
        $amount = Expense::whereYear('expenses.date', $year)->whereMonth('expenses.date', $month)->sum('amount');
    }

    return response()->json(['amount' => $amount]);
}



public function getPnl(Request $request)
{
    $month = $request->month;

    // Misalnya data diambil dari tabel incomes dan expenses
    $totalIncome = DB::table('incomes')->whereMonth('date', $month)->sum('amount');
    $totalExpense = DB::table('expenses')->whereMonth('date', $month)->sum('amount');

    // Hitung P&L
    $pnl = $totalIncome - $totalExpense;

    return response()->json([
        'monthName' => date("F", mktime(0, 0, 0, $month, 10)),
        'pnlAmount' => $pnl
    ]);
}


}
