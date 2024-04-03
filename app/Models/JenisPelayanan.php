<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPelayanan extends Model
{
    use HasFactory;

    protected $table = 'jenis_pelayanans';

    protected $fillable = [
        'nama_jenis_pelayanan',
        'deskripsi',
        'alur_pelayanan'
    ];
}
