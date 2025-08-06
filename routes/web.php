<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KamiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PesanController;
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

// Simpan tambah keranjang
Route::post('/keranjang/tambah/{kode_produk}', [KeranjangController::class, 'TambahKeranjang']);

// Menampilkan keranjang
Route::get('/keranjang', [KeranjangController::class, 'ViewKeranjang']);

// Menghapus keranjang
Route::post('/keranjang/delete/{kode_produk}', [KeranjangController::class, 'DeleteKeranjang']);

// Proses pemesanan dari keranjang
Route::post('/keranjang/pesan', [PesanController::class, 'PesanKeranjang']);

// Menampilkan struk berdasarkan ID pesan
Route::get('/struk/{id}', [PesanController::class, 'ViewPesanan']);

// Menampilkan halaman profile
Route::get('/profile', [AuthController::class, 'Profile']);

// Menampilkan form alamat
Route::get('/profile/tambah/alamat', [AuthController::class, 'ViewTambahAlamat']);

// Menyimpan alamat
Route::post('/profile/alamat', [AuthController::class, 'TambahAlamat']);

// Menampilkan form update profile 
Route::get('/profile/edit', [AuthController::class, 'editProfile']);

// Menyimpan update profile
Route::put('/profile/update', [AuthController::class, 'updateProfile']);
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
});