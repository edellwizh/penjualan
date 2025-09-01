<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';
    protected $primaryKey = 'kode_produk'; // ganti primary key
    public $incrementing = true; // defaultnya true, tapi kita tulis biar jelas
    protected $keyType = 'int'; // karena auto increment integer

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'deskripsi',
        'harga',
        'jumlah_produk',
        'image',
        'kategori_id'
    ];

    public function kategoris()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
