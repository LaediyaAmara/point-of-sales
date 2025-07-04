<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
  <div class="container">
    <a class="navbar-brand fw-bold text-primary" href="{{ route('dashboard') }}">POINT OF SALES APP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('barang.*') ? 'active' : '' }}" href="{{ route('barang.index') }}">Barang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('transaksi.*') ? 'active' : '' }}" href="{{ route('transaksi.index') }}">Transaksi</a>
        </li>
      </ul>

      <div class="dropdown">
        <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
          {{ Auth::user()->name }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="dropdown-item" type="submit">Logout</button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
