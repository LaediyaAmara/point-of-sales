<table>
    <thead>
        <tr>
            <th>Nama Barang</th>
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

<form action="{{ route('transaksi.cetak', $transaksi->id) }}" method="POST" target="_blank">
    @csrf
    <button type="submit">🖨️ Cetak Struk</button>
</form>
