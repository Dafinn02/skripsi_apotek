<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaPembelian extends Model
{
    use HasFactory;

    protected $table = 'rencana_pembelians';

    protected $fillable = [
        'supplier_id',
        'no_surat',
        'tanggal_pemesanan',
        'jenis_surat',
        'metode_pembayaran',
        'jatuh_tempo_pembayaran',
        'produk_id',
        'kuantitas',
        'satuan_id',
        'harga_beli',
        'total',
        'keterangan'
    ];
    

    public function pesanan_pembelian()
    {
        return $this->hasMany(PesananPembelian::class, 'rencana_pembelian_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id');
    }
}
