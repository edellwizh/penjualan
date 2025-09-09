<!-- Header Admin -->
     <div class="sidebar">
          <h2>Dashboard Penjualan</h2>
          <ul>
              <li><a href="{{ url(Auth::user()->role.'/home') }}">Home</a></li>
              <li><a href="{{ url(Auth::user()->role.'/produk') }}">Produk</a></li>
              <li><a href="{{ url(Auth::user()->role.'/testimoni') }}">Testimoni</a></li>
              <li><a href="{{ url(Auth::user()->role.'/pesanan/status') }}">Status Pemesanan</a></li></li>
              <li><a href="{{ url(Auth::user()->role.'/laporan') }}">Laporan Produk</a></li>
              <li><a href="#">Pengaturan</a></li>
              <form action="{{ url('logout') }}" method="post">
                @csrf
                <button type="submit" class="text-decoration-none bg-transparent border-0 text-white" style="font-size: 18px;">logout</button>
              </form>

          </ul>
     </div>
    