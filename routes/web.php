<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Histori;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Barang
    Route::resource('barang', BarangController::class);
    
    // Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/histori', [TransaksiController::class, 'histori'])->name('transaksi.histori');
    Route::get('/transaksi/struk/{id}', [TransaksiController::class, 'cetak'])->name('transaksi.struk');
    Route::get('/transaksi/{id}/detail', [TransaksiController::class, 'detail'])->name('transaksi.detail');
    Route::post('/transaksi/{id}/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');

    Route::post('/transaksi/simpan', [TransaksiController::class, 'simpan'])->name('transaksi.simpan');
    Route::post('/transaksi/tambah', [TransaksiController::class, 'tambah'])->name('transaksi.tambah');
    Route::post('/transaksi/hapus', [TransaksiController::class, 'hapus'])->name('transaksi.hapus');
});

// Auth scaffolding (breeze/jetstream)
require __DIR__.'/auth.php';
