<nav class="navbar navbar-expand fixed-top flex-row navbar-white bg-white">
  <div class="container-fluid">
      <a class="navbar-brand" href="#">Market Fless</a>
      <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      {{ Auth::guard('kasir')->user()->name }}
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                  </div>
              </li>
          </ul>
      </div>
  </div>
</nav>
