<div class="container-fluid page-body-wrapper">
  <div class="row">
      <div class="col-lg-2 bg-white text-black position-fixed" style="z-index: 1030; top: 0; left: 0; bottom: 0;">
          <div class="sidebar">
              <div class="text-center mt-4">
                  <img src="{{asset('assets/image/logo.png')}}"  alt="Logo" width="150">
                </div>
              <!-- Tambahkan menu atau konten sidebar di sini -->
              <ul class="list-unstyled mt-3">
                <li class="nav-item menu-items">
                  <a class="nav-link" href="{{route('kasir.dashboard')}}">
                    <span class="menu-icon">
                      <i class="fa fa-house"></i>
                    <span class="menu-title">Dashboard</span></span>
                  </a>
                </li>
                <li class="nav-item menu-items">
                  <a class="nav-link" href="{{route('databarang.index')}}">
                    <span class="menu-icon">
                      <i class="fa fa-store"></i>
                    <span class="menu-title">Data Barang</span></span>
                  </a>
                </li>
                  <li class="nav-item menu-items">
                      <a class="nav-link" href="{{route('transaksi.index')}}">
                        <span class="menu-icon">
                          <i class="fa fa-money-bill-transfer"></i>
                        <span class="menu-title">Transaksi</span></span>
                      </a>
                    </li>
                <li class="nav-item menu-items">
                  <a class="nav-link" href="{{route('member.index')}}">
                    <span class="menu-icon">
                      <i class="fa fa-id-card"></i>
                    <span class="menu-title">Data Member</span></span>
                  </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="">
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
