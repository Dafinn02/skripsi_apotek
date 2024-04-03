<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;

    protected $table = 'satuans';

    protected $fillable = [
        'nama_satuan'
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'satuan_id', 'id');
    }

    public function rencana_pembelian()
    {
        return $this->hasMany(RencanaPembelian::class, 'satuan_id', 'id');
    }

    public function pesanan_pembelian()
    {
        return $this->hasMany(PesananPembelian::class, 'satuan_id', 'id');
    }
}
