<div class="wrapper">
  <div class="row">
      <div class="col-lg-2 bg-white text-black position-fixed" style="z-index: 1030; top: 0; left: 0; bottom: 0;">
          <div class="sidebar">
              <div class="text-center mt-4">
                  <img src="{{asset('assets/image/logo.png')}}"  alt="Logo" width="150">
                </div>
              <!-- Tambahkan menu atau konten sidebar di sini -->
              <ul class="list-unstyled mt-2">
                <li class="nav-item menu-items">
                  <a class="nav-link" href="{{route('admin.dashboard')}}">
                    <span class="menu-icon">
                      <i class="fa fa-house"></i>
                    <span class="menu-title">Dashboard</span>  </span>
                  </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                      <span class="menu-icon">
                        <i class="fa fa-table"></i>
                      <span class="menu-title">Data Master</span></span>
                      <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="auth">
                      <ul class="nav flex-column sub-menu">
                      <li class="nav-item menu-items">
                    <a class="nav-link" href="{{route('barang.index')}}">
                      <span class="menu-icon">
                        <i class="fa fa-store"></i>
                      </span>
                      <span class="menu-title">Data Barang</span>
                    </a>
                  </li>
                  <li class="nav-item menu-items">
                    <a class="nav-link" href="{{route('datakasir')}}">
                      <span class="menu-icon">
                        <i class="fa fa-id-card-clip"></i>
                      </span>
                      <span class="menu-title">Data Kasir</span>
                    </a>
                  </li>
                  </li>
                  <li class="nav-item menu-items">
                    <a class="nav-link" href="{{route('datamember')}}">
                      <span class="menu-icon">
                        <i class="fa fa-id-card"></i>
                      </span>
                      <span class="menu-title">Data Member</span>
                    </a>
                  </li>
                      </ul>
                    </div>
                  <li class="nav-item menu-items">
                      <a class="nav-link" href="{{route('kategori.index')}}">
                        <span class="menu-icon">
                          <i class="fa fa-layer-group"></i>
                        <span class="menu-title">Kategori</span></span>
                      </a>
                    </li>
                <li class="nav-item menu-items">
                  <a class="nav-link" href="#">
                    <span class="menu-icon">
                      <i class="fa fa-book"></i>
                    <span class="menu-title">Laporan Penjualan</span></span>
                  </a>
                </li>
              </ul>
          </div>
       </div>
    </div>
</div>
