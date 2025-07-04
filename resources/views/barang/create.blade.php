<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">➕ Tambah Barang</h4>
                </div>
                <div class="card-body">

                    {{-- Tampilkan error jika ada --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form --}}
                    <form action="{{ route('barang.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Barang</label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan nama barang" required>
                        </div>

                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control" id="stok" placeholder="Contoh: 50" min="0" required>
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga" class="form-control" id="harga" placeholder="Contoh: 10000" min="0" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('barang.index') }}" class="btn btn-secondary">← Kembali</a>
                            <button type="submit" class="btn btn-success">💾 Simpan</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS (opsional, kalau mau interaktif lebih lanjut) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
