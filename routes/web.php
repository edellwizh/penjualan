<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KamiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\StatusPesananController;
use App\Http\Controllers\TestimoniController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', [HomeController::class, 'index']);

Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'ShowRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout']);


// Route untuk user
Route::middleware(['auth', 'user-acces:user'])->prefix('user')->group(function(){

// Menampilkan semua produk
Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/tentangkami', [KamiController::class, 'TentangKami']);

// Menampilkan daftar testimoni user
Route::get('/testimoni', [TestimoniController::class, 'index']);

// Menampilkan form tambah testimoni
Route::get('/testimoni/tambah', [TestimoniController::class, 'ViewTambahTestimoni']);

// Simpan testimoni (POST)
Route::post('/testimoni/tambah', [TestimoniController::class, 'TambahTestimoni']);

// Detail produk
Route::get('/produk/detail/{kode_produk}', [ProdukController::class, 'DetailProduk']);

// Halaman Profile
Route::get('/profile', [AuthController::class, 'Profile']);

// Menampilkan form tambah profile
Route::get('/profile/edit', [AuthController::class, 'FormTambahProfile']);

// Simpan profile
Route::post('/profile/edit', [AuthController::class, 'UpdateProfile']);

// Menampilkan halaman keranjang belanja
Route::get('/keranjang', [KeranjangController::class, 'ViewKeranjang']);

// Menambah produk ke keranjang
Route::post('/keranjang/tambah', [KeranjangController::class, 'TambahKeranjang']);

// Mengubah jumlah produk di keranjang
Route::post('/keranjang/edit/{id}', [KeranjangController::class, 'UpdateKeranjang']);

// Menghapus produk dari keranjang
Route::delete('/keranjang/hapus/{id}', [KeranjangController::class, 'HapusKeranjang']);

// Menampilkan halaman checkout
Route::get('/pesan', [PesanController::class, 'ViewPesan']);

// Memproses pesanan dari halaman checkout
Route::post('/pesan', [PesanController::class, 'ProsesPesan']);

// Route untuk menampilkan halaman pembayaran
Route::get('/pembayaran', [PesanController::class, 'halamanPembayaran']);

// Route untuk redirect ke pembayaran berdasarkan ID pesanan
Route::get('/bayar/{id}', [PesanController::class, 'redirectToPembayaran'])->name('user.pembayaran');

// Route untuk menampilkan riwayat pesanan (semua atau detail)
Route::get('/riwayat-pemesanan', [PesanController::class, 'riwayatPemesanan']);

// Route untuk menampilkan detail status pesanan
Route::get('/detailstatus-pemesanan/{id}', [StatusPesananController::class, 'DetailPesanan']);

// Route untuk memproses pesanan setelah pembayaran
Route::get('/proses-pesanan/{id}', [PesanController::class, 'prosesPesanan'])->name('user.riwayat_pesanan');

});

// Route untuk admin
Route::middleware(['auth', 'user-acces:admin'])->prefix('admin')->group(function(){
Route::get('/home', [HomeController::class, 'ViewHome']);

// Menampilkan semua produk
Route::get('/produk', [ProdukController::class, 'index']);

// Menampilkan form tambah produk
Route::get('/produk/tambah', [ProdukController::class, 'ViewTambahProduk']);

// Menyimpan produk baru
Route::post('/produk/tambah', [ProdukController::class, 'TambahProduk']);

// Menampilkan form edit produk
Route::get('/produk/edit/{kode_produk}', [ProdukController::class, 'ViewEditProduk']);

// Menyimpan update produk
Route::put('/produk/edit/{kode_produk}', [ProdukController::class, 'UpdateProduk']);

// Menghapus produk
Route::delete('/produk/delete/{kode_produk}', [ProdukController::class, 'DeleteProduk']);

// Menampilkan laporan
Route::get('/laporan', [ProdukController::class, 'ViewLaporan']);

// Menampilkan print pdf
Route::get('/report', [ProdukController::class, 'print']);

// Menampilkan semua Kategori
Route::get('/kategori', [KategoriController::class, 'index']);

// Menampilkan form tambah kategori
Route::get('/kategori/tambah', [KategoriController::class, 'ViewTambahKategori']);

// Menyimpan kategori baru
Route::post('/kategori/tambah', [KategoriController::class, 'TambahKategori']);

// Menampilkan form edit kategori
Route::get('/kategori/edit/{id}', [KategoriController::class, 'ViewEditKategori']);

// Menyimpan update kategori
Route::put('/kategori/edit/{id}', [KategoriController::class, 'UpdateKategori']);

// Menghapus kategori
Route::delete('/kategori/delete/{id}', [KategoriController::class, 'DeleteKategori']);

// menampilkan  testimoni
Route::get('/testimoni', [TestimoniController::class, 'adminIndex']);

// Status admin  testimoni
Route::get('/testimoni/status/{id}', [TestimoniController::class, 'UpdateStatus']);

// menampilkan  testimoni
Route::get('/testimoni/delete/{id}', [TestimoniController::class, 'delete']);

// Route untuk menampilkan status
Route::get('/pesanan/status', [StatusPesananController::class, 'Status']);

// Route untuk menyimpan status baru
Route::post('/pesanan/status/{pesanan}', [StatusPesananController::class, 'updateStatus']);

// Route untuk pendapatan
Route::get('/pendapatan', [HomeController::class, 'indexPendapatan']);

// Route untuk detail pendapatan
Route::get('/pendapatan/{tanggal}', [HomeController::class, 'detailPendapatan']);
});