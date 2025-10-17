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

Route::get('/', function () {
    return view('welcome');
});


// AUTH CONTROLLER
// Menampilkan login
Route::get('/login', [AuthController::class, 'viewLogin']);

// Proses login
Route::post('/login', [AuthController::class, 'login']);

// Menampilkan register
Route::get('/register', [AuthController::class, 'viewRegister']);

// tambah register
Route::post('/register', [AuthController::class, 'register']);

// Proses logout
Route::post('/logout', [AuthController::class, 'logout']);


###########################################
# USER
##########################################

Route::middleware(['auth', 'user-acces:user'])->prefix('user')->group(function(){

// AUTH CONTROLLER
// Menampilkan profile
Route::get('/profile', [AuthController::class, 'Profile']);

// Menampilkan tambah profile
Route::get('/profile/edit', [AuthController::class, 'FormTambahProfile']);

// Proses ubah 
Route::post('/profile/edit', [AuthController::class, 'UpdateProfile']);


// PRODUK CONTROLLER
// Menampilkan semua produk
Route::get('/produk', [ProdukController::class, 'index']);

// Detail produk
Route::get('/produk/detail/{kode_produk}', [ProdukController::class, 'detailProduk']);

// TESTIMONI CONTROLLER
Route::get('/testimoni', [TestimoniController::class, 'index']);

// Proses tambah
Route::post('/testimoni/tambah', [TestimoniController::class, 'tambahTestimoni']);


// HOMECONTROLLER
// Menampilkan detail status
Route::get('/detailstatus-pemesanan/{id}', [HomeController::class, 'detailStatususer']);


// KERANJANG CONTROLLER
// Menampilkan 
Route::get('/keranjang', [KeranjangController::class, 'viewKeranjang']);

// Proses tambah
Route::post('/keranjang/tambah', [KeranjangController::class, 'TambahKeranjang']);

// Proses update
Route::post('/keranjang/edit/{id}', [KeranjangController::class, 'UpdateKeranjang']);

// hapus
Route::delete('/keranjang/hapus/{id}', [KeranjangController::class, 'HapusKeranjang']);


// PESAN CONTROLLER
// Menampilkan 
Route::get('/pesan', [PesanController::class, 'viewPesan']);

// Proses
Route::post('/pesan', [PesanController::class, 'prosesPesan']);

// Menampilkan
Route::get('/pembayaran', [PesanController::class, 'halamanPembayaran']);

// Proses bayar sekarang
Route::get('/bayar/{id}', [PesanController::class, 'redirectToPembayaran'])->name('user.pembayaran');

// Proses ubah status pesanan diproses
Route::get('/riwayat-pemesanan', [PesanController::class, 'riwayatPemesanan']);

// Menampilkan
Route::get('/proses-pesanan/{id}', [PesanController::class, 'prosesPesanan'])->name('user.riwayat_pesanan');

// KAMI CONTROLLER
Route::get('/tentangkami', [KamiController::class, 'TentangKami']);

});

###########################################
# ADMIN
##########################################

// HOME CONTROLLER
Route::middleware(['auth', 'user-acces:admin'])->prefix('admin')->group(function(){
Route::get('/home', [HomeController::class, 'homeAdmin']);

// Menampilkan pendapatan
Route::get('/pendapatan', [HomeController::class, 'Pendapatan']);

// Menampilkan detail pendapatan
Route::get('/pendapatan/{tanggal}', [HomeController::class, 'detailPendapatan']);

// Menampilkan detail pesanan
Route::get('/detailpesanan/{id}', [HomeController::class, 'detailPesananadmin']);

// Export pdf
Route::get('/report-pendapatan/{tanggal}', [HomeController::class, 'exportPendapatanPdf']);

// Route untuk menyimpan status baru
Route::post('/pesanan/status/{pesanan}', [StatusPesananController::class, 'updateStatus']);



// KATEGORI CONTROLLER
// Menampilkan semua Kategori
Route::get('/kategori', [KategoriController::class, 'index']);

// Menampilkan tombol
Route::get('/kategori/tambah', [KategoriController::class, 'viewtambahKategori']);

// Proses tambah
Route::post('/kategori/tambah', [KategoriController::class, 'tambahKategori']);

// Menampilkan tombol
Route::get('/kategori/edit/{id}', [KategoriController::class, 'vieweditKategori']);

// Proses update
Route::put('/kategori/edit/{id}', [KategoriController::class, 'updateKategori']);

// Proses Hapus
Route::delete('/kategori/delete/{id}', [KategoriController::class, 'deleteKategori']);


// PRODUK CONTROLLER
// Menampilkan semua produk
Route::get('/produk', [ProdukController::class, 'index']);

// Menampilkan tombol
Route::get('/produk/tambah', [ProdukController::class, 'viewtambahProduk']);

// Proses tambah
Route::post('/produk/tambah', [ProdukController::class, 'tambahProduk']);

// Menampilkan tombol
Route::get('/produk/edit/{kode_produk}', [ProdukController::class, 'vieweditProduk']);

// Proses update
Route::put('/produk/edit/{kode_produk}', [ProdukController::class, 'updateProduk']);

// Proses hapus
Route::delete('/produk/delete/{kode_produk}', [ProdukController::class, 'deleteProduk']);

// Menampilkan laporan
Route::get('/laporan', [ProdukController::class, 'viewLaporan']);

// Menampilkan print laporan
Route::get('/report', [ProdukController::class, 'print']);


// TESTIMONI CONTROLLER
// Menampilkan  
Route::get('/testimoni', [TestimoniController::class, 'adminIndex']);

// Ubah status
Route::get('/testimoni/status/{id}', [TestimoniController::class, 'updateStatus']);

// Hapus
Route::get('/testimoni/delete/{id}', [TestimoniController::class, 'delete']);


});