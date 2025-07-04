<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Histori Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    

</head>
 <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">← Kembali ke Dashboard</a>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4">📜 Histori Transaksi</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (!$data || $data->isEmpty())
        <div class="alert alert-info">Belum ada transaksi.</div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                         <th>Barcode</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>User</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $trx)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><span class="badge bg-primary">{{ $trx->kode_transaksi }}</span></td>
                             <td>
                {{-- Barcode --}}
                {!! DNS1D::getBarcodeHTML($trx->kode_transaksi, 'C128') !!}
            </td>
                            <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y H:i') }}</td>
                            <td>Rp{{ number_format($trx->total_harga) }}</td>
                            <td>{{ $trx->user->name ?? '-' }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('transaksi.detail', $trx->id) }}" class="btn btn-sm btn-info">Detail</a>
                                <form action="{{ route('transaksi.cetak', $trx->id) }}" method="POST" target="_blank">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-secondary">🖨 Cetak</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- Optional: Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
