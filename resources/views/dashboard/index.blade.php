<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard POS Amarou</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8faff;
        }
        .navbar {
            background-color:rgb(147, 187, 248);
        }
        .navbar-brand, .navbar .nav-link, .navbar .text-white {
            color: #fff !important;
        }
        .sidebar {
            position: fixed;
            top: 56px;
            bottom: 0;
            left: 0;
            width: 220px;
            background-color: #e9f2ff;
            padding-top: 20px;
            border-right: 1px solid #dee2e6;
        }
        .sidebar a {
            color: #0d6efd;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
            font-weight: 500;
        }
        .sidebar a:hover {
            background-color: #d0e5ff;
            border-radius: 5px;
        }
        .content {
            margin-left: 220px;
            padding: 20px;
            margin-top: 56px;
        }
        .navbar-profile img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }
        .card {
            border: none;
            border-radius: 12px;
        }
        .card h5 {
            font-weight: 600;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top shadow">
    <div class="container-fluid">
        <span class="navbar-brand">📊 POINT OF SALES APP</span>
        <div class="d-flex align-items-center ms-auto navbar-profile">
            <span class="text-white me-2">Halo, {{ Auth::user()->name ?? 'User' }}  <div class="dropdown">
        <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
          {{ Auth::user()->name }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          
          <li><hr class="dropdown-divider"></li>
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="dropdown-item" type="submit">Logout</button>
            </form>
          </li>
        </ul>
      </div></span>
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}" alt="Profile">
            
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div class="sidebar">
    <a href="/dashboard">🏠 Dashboard</a>
    <a href="/barang">🛒 Kelola Barang</a>
    <a href="/transaksi">➕ Transaksi</a>
    <a href="/transaksi/histori">📑 Histori Transaksi</a>
    <a href="/profile">👤 Profil</a>
    
</div>

<!-- Content -->
<div class="content">
    <h3 class="mb-4 text-primary">Selamat Datang di Dashboard POS</h3>

    <div class="row g-4">
        <!-- Total Barang -->
        <div class="col-md-4">
            <div class="card bg-white shadow-sm p-3">
                <h5>Total Barang</h5>
                <p class="display-6 text-primary">{{ $totalBarang }}</p>
            </div>
        </div>

        <!-- Total Transaksi -->
        <div class="col-md-4">
            <div class="card bg-white shadow-sm p-3">
                <h5>Total Transaksi</h5>
                <p class="display-6 text-success">{{ $totalTransaksi }}</p>
            </div>
        </div>

        <!-- Pendapatan Hari Ini -->
        <div class="col-md-4">
            <div class="card bg-white shadow-sm p-3">
                <h5>Pendapatan Hari Ini</h5>
                <p class="display-6 text-warning">Rp{{ number_format($pendapatanHariIni) }}</p>
            </div>
        </div>
    </div>

    <!-- Navigasi -->
    <div class="mt-5">
        <a href="{{ route('barang.index') }}" class="btn btn-outline-primary me-2">🛒 Kelola Barang</a>
        <a href="{{ route('transaksi.index') }}" class="btn btn-outline-success me-2">➕ Buat Transaksi</a>
        <a href="{{ route('transaksi.histori') }}" class="btn btn-outline-secondary">📑 Histori</a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
