<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
{
    $barang = Barang::all();
    $keranjang = session()->get('keranjang', []);

    $total = 0;
    foreach ($keranjang as $item) {
        $total += $item['subtotal'];
    }

    return view('transaksi.index', compact('barang', 'keranjang', 'total'));
}

   public function tambah(Request $request)
{
    $request->validate([
        'barang_id' => 'required|exists:barangs,id',
        'jumlah' => 'required|integer|min:1',
    ]);

    $barang = Barang::findOrFail($request->barang_id);
    $keranjang = session()->get('keranjang', []);

    // sama seperti sebelumnya
    $found = false;
    foreach ($keranjang as &$item) {
        if ($item['id'] == $barang->id) {
            $item['jumlah'] += $request->jumlah;
            $item['subtotal'] = $item['jumlah'] * $item['harga'];
            $found = true;
            break;
        }
    }
    unset($item);

    if (!$found) {
        $keranjang[] = [
            'id' => $barang->id,
            'nama' => $barang->nama,
            'harga' => $barang->harga,
            'jumlah' => $request->jumlah,
            'subtotal' => $barang->harga * $request->jumlah
        ];
    }

    session()->put('keranjang', $keranjang);

    return redirect()->back()->with('success', 'Barang berhasil ditambahkan ke keranjang.');
}

    public function hapus($id)
    {
        $keranjang = session()->get('keranjang', []);
        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }
        return redirect()->back()->with('success', 'Barang dihapus dari keranjang.');
    }

    public function kosongkan()
    {
        session()->forget('keranjang');
        return redirect()->back()->with('success', 'Keranjang dikosongkan.');
    }

    public function struk()
    {
        $keranjang = session()->get('keranjang', []);
        return view('transaksi.struk', compact('keranjang'));
    }
   public function histori()
{
    $data = Transaksi::latest()->get();
    return view('transaksi.histori', compact('data'));
}


public function detail($id)
{
    $transaksi = Transaksi::findOrFail($id);
    return view('transaksi.detail', compact('transaksi'));
}

public function cetak($id)
{
    // ambil transaksi + user + detail + barang
    $transaksi = Transaksi::with(['user', 'detailTransaksi.barang'])->findOrFail($id);

    // ambil detail langsung dari relasi
    $detail = $transaksi->detailTransaksi;

    // lempar ke view
    return view('transaksi.print', compact('transaksi', 'detail'));
}

public function simpan()
{
    $keranjang = session()->get('keranjang', []);
    if (empty($keranjang)) {
        return redirect()->back()->with('error', 'Keranjang kosong.');
    }

    $total = 0;
    foreach ($keranjang as $item) {
        $total += $item['harga'] * $item['jumlah']; 
    }

    $transaksi = Transaksi::create([
        'kode_transaksi' => 'TRX-' . strtoupper(Str::random(6)),
        'tanggal' => now(),
        'total_harga' => $total,
        'user_id' => auth()->id(),
    ]);

    session()->forget('keranjang');

    return redirect()->route('transaksi.histori')->with('success', 'Transaksi berhasil disimpan.');
}
public function show($id)
{
    // Ambil transaksi + relasi user dan detail barang
    $transaksi = Transaksi::with(['user', 'detailTransaksi.barang'])->findOrFail($id);
    
    // Ambil detail dari relasi
    $detail = $transaksi->detailTransaksi;
    
    // Kirim ke view
    return view('transaksi.detail', compact('transaksi', 'detail'));
}
}
