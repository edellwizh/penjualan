<!-- Header User -->
          <nav class="navbar navbar-expand-lg bg-blue">
          <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
              <!-- <img src="{{ asset('logo.png') }}" alt="Logo" height="40"> -->
              <span class="fw-semibold">Sandang Sehat Indonesia</span>
            </a>
            <div class="collapse navbar-collapse justify-content-end">
              <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ url(Auth::user()->role.'/produk') }}">Produk</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url(Auth::user()->role.'/tentangkami') }}">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url(Auth::user()->role.'/testimoni') }}">Testimoni</a></li>
              </ul>
              <div class="d-flex gap-3 ms-3">
                <a href="{{ url(Auth::user()->role.'/keranjang') }}" class="text-dark">
                  <i class="bi bi-cart3 fs-5"></i>
                </a>
                <a href="{{ url(Auth::user()->role.'/profile') }}" class="text-dark">
                <i class="bi bi-person fs-5"></i></a>
              </div>
            </div>
          </div>
        </nav>
     </ul>
   </div>