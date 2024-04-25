          <div class="sidebar">
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
                    <a class="nav-link" href="{{ route('laporan.index')}}">
                      <span class="menu-icon">
                        <i class="fa fa-book"></i>
                      <span class="menu-title">Laporan Penjualan</span></span>
                    </a>
                  </li>
              </ul>
          </div>
