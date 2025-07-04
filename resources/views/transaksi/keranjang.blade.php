<form action="{{ route('transaksi.simpan') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-success">Simpan Transaksi</button>
</form>
