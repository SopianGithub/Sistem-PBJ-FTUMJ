<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftar_barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang', 'jumlah', 'unit', 'status'
    ];
}
