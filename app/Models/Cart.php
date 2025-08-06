<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
     protected $fillable = ['user_id', 'kode_produk', 'jumlah_produk'];

    public function produks()
    {
        return $this->belongsTo(Produk::class, 'kode_produk', 'kode_produk');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
