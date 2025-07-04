@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Barang</h4>
        <a href="{{ route('barang.create') }}" class="btn btn-primary">Tambah Barang</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kode Barang</th>
                <th>Barcode</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barang as $b)
            <tr>
                <td>{{ $b->nama }}</td>
                <td>{{ $b->kode ?? '-' }}</td>
                <td>
                    @if($b->kode)
                        {!! DNS1D::getBarcodeHTML($b->kode, 'C128') !!}
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>Rp{{ number_format($b->harga) }}</td>
                <td>{{ $b->stok }}</td>
                <td>
                    <a href="{{ route('barang.edit', $b->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('barang.destroy', $b->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus barang ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
