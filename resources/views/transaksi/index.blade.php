<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- CARD KERANJANG -->
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">🛒 Keranjang Belanja</h5>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (empty($keranjang))
                        <p class="text-muted">Keranjang masih kosong.</p>
                    @else
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Barang</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($keranjang as $index => $item)
                                    <tr>
                                        <td>{{ $item['nama'] }}</td>
                                        <td>Rp{{ number_format($item['harga']) }}</td>
                                        <td>{{ $item['jumlah'] }}</td>
                                        <td>Rp{{ number_format($item['subtotal']) }}</td>
                                        <td>
                                            <form action="{{ route('transaksi.hapus') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="index" value="{{ $index }}">
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="text-end">
                            <h5>Total: <span class="badge bg-success fs-5">Rp{{ number_format($total) }}</span></h5>
                        </div>
                    @endif
                </div>
            </div>

            <!-- FORM SIMPAN -->
            <div class="text-end">
                <form action="{{ route('transaksi.simpan') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-lg btn-success" {{ empty($keranjang) ? 'disabled' : '' }}>
                        💾 Simpan Transaksi
                    </button>
                </form>
            </div>
        </div>

        <!-- CARD TAMBAH BARANG -->
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">➕ Tambah Barang</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('transaksi.tambah') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="barang_id" class="form-label">Pilih Barang</label>
                            <select name="barang_id" id="barang_id" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                @foreach ($barang as $b)
                                    <option value="{{ $b->id }}">{{ $b->nama }} - Rp{{ number_format($b->harga) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" min="1" placeholder="Qty" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Tambah ke Keranjang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
