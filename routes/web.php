<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\FakturController;
use App\Http\Controllers\PembayaranController;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{barang}/update', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{barang}/delete', [BarangController::class, 'destroy'])->name('barang.destroy');
Route::get('/barang/{id}', [BarangController::class, 'show'])->name('barang.show');






Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
Route::post('/pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');
Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
Route::put('/pelanggan/{id}/update', [PelangganController::class, 'update'])->name('pelanggan.update');
Route::delete('/pelanggan/{id}/delete', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');
Route::get('/pelanggan/{id}', [PelangganController::class, 'show'])->name('pelanggan.show');
Route::get('/pelanggan/{pelanggan}/faktur', [PelangganController::class, 'faktur'])->name('pelanggan.faktur');


Route::get('/fakturs', [FakturController::class, 'index'])->name('fakturs.index');
Route::get('/fakturs/create', [FakturController::class, 'create'])->name('fakturs.create');
Route::post('/fakturs/store', [FakturController::class, 'store'])->name('fakturs.store');
Route::get('/fakturs/{id}/edit', [FakturController::class, 'edit'])->name('fakturs.edit');
Route::put('/fakturs/{id}/update', [FakturController::class, 'update'])->name('fakturs.update');
Route::delete('/fakturs/{id}', [FakturController::class, 'destroy'])->name('fakturs.destroy');
Route::get('/fakturs/{id}', [FakturController::class, 'show'])->name('fakturs.show');
Route::get('/faktur/{id}/cetak', [FakturController::class, 'cetakPdf'])->name('faktur.cetak');
Route::get('/fakturs/{id}/summary', [FakturController::class, 'summary'])->name('fakturs.summary');


Route::post('/fakturs/{id}/send-email', [FakturController::class, 'sendEmail'])->name('fakturs.sendEmail');


// web.php
Route::get('/pembayaran/create/{faktur}', [PembayaranController::class, 'create'])->name('pembayaran.create');
Route::post('/pembayaran/store/{faktur}', [PembayaranController::class, 'store'])->name('pembayaran.store');



Route::get('/fakturs/{faktur}/riwayat', [PembayaranController::class, 'riwayat'])->name('pembayaran.riwayat');


use App\Http\Controllers\FinanceController;
use App\Http\Controllers\TransactionController;

Route::get('/dashboard', [FinanceController::class, 'index'])->name('dashboard');

// Routes for Income
Route::get('/income', [FinanceController::class, 'incomeIndex'])->name('income.index');
Route::get('/income/create', [FinanceController::class, 'createIncome'])->name('income.create');
Route::post('/income', [FinanceController::class, 'storeIncome'])->name('income.store');

// Routes for Expense
Route::get('/expense', [FinanceController::class, 'expenseIndex'])->name('expense.index');
Route::get('/expense/create', [FinanceController::class, 'createExpense'])->name('expense.create');
Route::post('/expense', [FinanceController::class, 'storeExpense'])->name('expense.store');


Route::get('/dashboard/monthly-PL/{month}', [FinanceController::class, 'getMonthlyPL'])->name('monthly.PL');

Route::get('/dashboard/monthly-PL/{month}', [FinanceController::class, 'getMonthlyPL']);
Route::get('/dashboard/{type}-detail/{month}', [FinanceController::class, 'getTransactionDetail']);



Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');


// routes/web.php
Route::get('/calendar', [TransactionController::class, 'calendar'])->name('transactions.calendar');





Route::get('/faktur-baru/{id}', [FakturController::class, 'showNew'])->name('faktur.showNew');

