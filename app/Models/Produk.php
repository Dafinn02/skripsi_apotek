<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';

    protected $fillable = [
        'tipe_produk',
        'nama_produk',
        'nama_pabrik',
        'kode_produk',
        'satuan_id',
        'harga_beli',
        'harga_jual',
        'harga_alternatif',
        'harga_online',
        'zat_aktif',
        'bentuk_kekuatan',
        'kategori_id',
        'rak_id',
        'stok_minimal',
        'stok_maksimal',
        'periode_pembelian',
        'status',
        'katalog',
        'resep',
        'perhitungan_komisi_penjualan',
        'komisi_penjualan',
    ];

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    // public function rencana_pembelian()
    // {
    //     return $this->hasMany(RencanaPembelian::class, 'produk_id', 'id');
    // }

    // public function pesanan_pembelian()
    // {
    //     return $this->hasMany(PesananPembelian::class, 'produk_id', 'id');
    // }
}
