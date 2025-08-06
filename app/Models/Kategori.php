<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $fillable = ['nama_kategori', 'deskripsi'];

    // Relasi: 1 kategori punya banyak produk
    public function produks(){
        return $this->hasMany(Produk::class, 'kategori_id');
    }
}
