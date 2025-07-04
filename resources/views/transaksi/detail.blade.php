<h2>Detail Transaksi</h2>
<p><strong>Kasir:</strong> {{ $transaksi->user->name }}</p>
<p><strong>Kode:</strong> {{ $transaksi->kode_transaksi }}</p>
<p><strong>Tanggal:</strong> {{ $transaksi->tanggal }}</p>
<p><strong>Total:</strong> Rp{{ number_format($transaksi->total_harga) }}</p>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Barang</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detail as $item)
        <tr>
            <td>{{ $item->barang->nama }}</td>
            <td>Rp{{ number_format($item->barang->harga) }}</td>
            <td>{{ $item->qty }}</td>
            <td>Rp{{ number_format($item->subtotal) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Tombol cetak -->
<form action="{{ route('transaksi.cetak', $transaksi->id) }}" method="POST" target="_blank">
    @csrf
    <button type="submit">🖨️ Cetak Struk</button>
</form>
