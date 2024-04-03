<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $fillable = [
        'nama_supplier',
        'email',
        'no_telp',
        'alamat',
        'status'
    ];

    public function rencana_pembelian()
    {
        return $this->hasMany(RencanaPembelian::class, 'supplier_id', 'id');
    }

    public function pesanan_pembelian()
    {
        return $this->hasMany(PesananPembelian::class, 'supplier_id', 'id');
    }
}
