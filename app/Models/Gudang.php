<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;

    protected $table = 'gudangs';

    protected $fillable = [
        'nama_gudang'
    ];

    public function rak()
    {
        return $this->hasMany(Rak::class, 'gudang_id', 'id');
    }
}
