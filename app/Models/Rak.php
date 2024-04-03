<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    use HasFactory;

    protected $table = 'raks';

    protected $fillable = [
        'gudang_id',
        'nama_rak'
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'rak_id', 'id');
    }

    public function gudang()
    {
        return $this->belongsTo(Rak::class, 'gudang_id', 'id');
    }
}
