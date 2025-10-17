<!-- Footer User -->
      @auth
        @if (Auth::user()->role === 'user')
        <footer>
            <div class="container">
        <div class="row justify-content-center text-center">
            <!-- Tautan Cepat -->
            <div class="col-md-2">
                <h6 class="fw-bold">Tautan Cepat</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ url(Auth::user()->role.'/produk') }}" class="text-primary" class="nav-link">Produk</a></li>
                    <li><a href="{{ url(Auth::user()->role.'/tentangkami') }}" class="text-primary" class="nav-link">Tentang Kami</a></li>
                    <li><a href="{{ url(Auth::user()->role.'/testimoni') }}" class="text-primary" class="nav-link">Testimoni</a></li>
                </ul>
            </div>
            <!-- Untuk Wanita -->
            <div class="col-md-2">
                <h6 class="fw-bold">Kebutuhan sehari-hari</h6>
                <ul class="list-unstyled">
                    <li></li>
                    <li>Makanan</li>
                    <li>Minuman</li>
                    <li>dan lain-lain</li>
                </ul>
            </div>
            <!-- Untuk Pria -->
            <div class="col-md-2">
                <h6 class="fw-bold">Kebutuhan Sekunder</h6>
                <ul class="list-unstyled">
                    <li>Skincare</li>
                    <li>Pakaian</li>
                </ul>
            </div>
        </div>
    </div>
    
            <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-md-2"><a href="https://www.instagram.com/" class="text-decoration-none text-dark"><i class="bi bi-instagram"></i>katalogxxxx</a></div>
                <div class="col-md-2"><a href="" class="text-decoration-none text-dark"><i class="bi bi-envelope"></i>katalogxxxx@gmail.com</a></div>
                <div class="col-md-2"><a href="https://web.whatsapp.com/" class="text-decoration-none text-dark"><i class="bi bi-whatsapp"></i>(+62)85578033102</a></div>
            </div>
            <div class="p-3">
                <a href="https://www.google.co.id/maps?hl=id" class="text-decoration-none text-dark">
                <i class="bi bi-geo-alt-fill"></i>
                Jalan Cendrawasih No. 25, RT 03/RW 05, Kelurahan Mulyorejo, Kecamatan Sukomanunggal, Kota Surabaya, Jawa Timur, 60112.</a>
            </div>
            <div class="footer-line"></div>
            <p class="py-3">&copy; 2025 Aplikasi Penjualan</p>
            </div>
        </footer>
        @endif
      @endauth

<!-- Footer Admin -->
  @auth
        @if (Auth::user()->role === 'admin')
       <div class="footer-admin">
        <p>&copy; 2025 Aplikasi Penjualan</p>
       </div>
       @endif
      @endauth

           <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    </body>
</html>