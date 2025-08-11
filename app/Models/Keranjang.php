<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

        protected $table = 'keranjang';

    protected $fillable = [
        'user_id',
        'kode_produk',
        'quantity',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'kode_produk', 'kode_produk');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}