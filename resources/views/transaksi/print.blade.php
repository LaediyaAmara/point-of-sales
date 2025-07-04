<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            width: 250px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        td, th {
            padding: 4px;
            border-bottom: 1px dashed #000;
        }
        h2, p {
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .total {
            font-weight: bold;
        }
        .center {
            text-align: center;
        }
    </style>
</head>
<body onload="window.print()">
    <h2>Nama Toko</h2>
    <p>Jl. Contoh Alamat No. 123</p>
    <hr>

    <p><strong>Kode:</strong> {{ $transaksi->kode_transaksi }}</p>
    <p><strong>Kasir:</strong> {{ $transaksi->user->name }}</p>
    <p><strong>Tanggal:</strong> {{ $transaksi->tanggal }}</p>

    <table>
        <thead>
            <tr>
                <th>Barang</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Sub</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail as $item)
            <tr>
                <td>{{ $item->barang->nama }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ number_format($item->barang->harga) }}</td>
                <td>{{ number_format($item->subtotal) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total: Rp{{ number_format($transaksi->total_harga) }}</p>

    <hr>
    <p class="center">Terima kasih!</p>
</body>
</html>
