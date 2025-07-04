<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalTransaksi = Transaksi::count();
        $pendapatanHariIni = Transaksi::whereDate('created_at', now()->toDateString())->sum('total_harga');

        return view('dashboard.index', compact('totalBarang', 'totalTransaksi', 'pendapatanHariIni'));
    }
}
