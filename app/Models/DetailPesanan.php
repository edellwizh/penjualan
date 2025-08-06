<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;
    protected $table = 'detail_pesanan';
    protected $fillable = ['pesan_id', 'kode_produk', 'nama_produk', 'jumlah_produk', 'harga_satuan', 'subtotal'];

    // Relasi ke pesan
    public function pesan()
    {
        return $this->belongsTo(Pesan::class);
    }
}
