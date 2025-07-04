@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-4">
    <div class="card border-primary mb-3">
      <div class="card-body text-primary">
        <h5 class="card-title">Total Barang</h5>
        <p class="card-text fs-4">{{ $barangCount }}</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card border-success mb-3">
      <div class="card-body text-success">
        <h5 class="card-title">Total Transaksi</h5>
        <p class="card-text fs-4">{{ $transaksiCount }}</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card border-warning mb-3">
      <div class="card-body text-warning">
        <h5 class="card-title">Pendapatan</h5>
        <p class="card-text fs-4">Rp{{ number_format($totalPendapatan,0,',','.') }}</p>
      </div>
    </div>
  </div>
</div>
@endsection
