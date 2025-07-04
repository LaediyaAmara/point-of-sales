<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $barang = Barang::when($search, function ($query, $search) {
        return $query->where('nama', 'like', "%$search%")
                     ->orWhere('kode', 'like', "%$search%");
    })->get();

    return view('barang.index', compact('barang'));
}

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
        ]);

        $kode = 'BRG-' . time();

        $barang = Barang::create([
    'nama' => $request->nama,
    'harga' => $request->harga,
    'stok' => $request->stok,
    'kode_barang' => 'BRG-' . strtoupper(Str::random(5)),
]);


        return redirect('/barang')->with('success', 'Barang berhasil ditambahkan');
    }

    // ✅ Tambahkan di bawah store()
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update([
            'nama' => $request->nama,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate!');
    }

    // (Optional) untuk hapus barang
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
    
}

