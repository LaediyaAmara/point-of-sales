<!DOCTYPE html>
<html>
<head>
    <title>Struk Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .struk { width: 300px; margin: auto; }
        .struk h2, .struk p { text-align: center; }
    </style>
</head>
<body>
    <div class="struk">
        <h2>Struk Transaksi</h2>
        <p>Kode: {{ $transaksi->kode_transaksi }}</p>
        <p>Tanggal: {{ \Carbon\Carbon::parse($transaksi->created_at)->format('d M Y H:i') }}</p>
        <p>Total: Rp{{ number_format($transaksi->total) }}</p>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
