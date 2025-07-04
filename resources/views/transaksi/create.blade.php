@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Buat Transaksi</h1>

    <form action="{{ route('transaksi.simpan') }}" method="POST">
        @csrf

        <div class="mb-4">
            <h5>Barang</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="barang-wrapper">
                    <tr>
                        <td>
                            <select name="barang_id[]" class="form-control barang-select" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}" data-harga="{{ $barang->harga }}">
                                        {{ $barang->nama_barang }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="qty[]" class="form-control qty" value="1" min="1"></td>
                        <td><input type="text" class="form-control harga" readonly></td>
                        <td><input type="text" class="form-control subtotal" readonly></td>
                        <td><button type="button" class="btn btn-danger btn-remove">Hapus</button></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-success" id="add-row">Tambah Barang</button>
        </div>

        <div class="mb-3">
            <label for="total" class="form-label">Total Belanja</label>
            <input type="number" id="total" name="total" class="form-control" readonly required>
        </div>

        <div class="mb-3">
            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                <option value="Cash">Cash</option>
                <option value="Transfer">Transfer</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="bayar" class="form-label">Uang Dibayar</label>
            <input type="number" id="bayar" name="bayar" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="kembalian" class="form-label">Kembalian</label>
            <input type="text" id="kembalian" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function updateSubtotal(row) {
    let harga = parseInt(row.find('.barang-select option:selected').data('harga')) || 0;
    let qty = parseInt(row.find('.qty').val()) || 1;
    let subtotal = harga * qty;
    row.find('.harga').val(harga);
    row.find('.subtotal').val(subtotal);
    updateTotal();
}

function updateTotal() {
    let total = 0;
    $('.subtotal').each(function() {
        total += parseInt($(this).val()) || 0;
    });
    $('#total').val(total);

    let bayar = parseInt($('#bayar').val()) || 0;
    $('#kembalian').val(bayar - total);
}

// Saat pilih barang atau qty berubah
$(document).on('change', '.barang-select, .qty', function() {
    let row = $(this).closest('tr');
    updateSubtotal(row);
});

// Tambah row baru
$('#add-row').click(function() {
    let row = $('#barang-wrapper tr:first').clone();
    row.find('select').val('');
    row.find('input').val('');
    $('#barang-wrapper').append(row);
});

// Hapus row
$(document).on('click', '.btn-remove', function() {
    if($('#barang-wrapper tr').length > 1) {
        $(this).closest('tr').remove();
        updateTotal();
    }
});

// Update kembalian saat bayar diinput
$('#bayar').on('input', updateTotal);
</script>
@endsection
