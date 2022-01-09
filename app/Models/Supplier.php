<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'nama_badan_usaha', 'alamat_badan_usaha', 'nomor_hp', 'email', 'alamat_web', 'surat_penawaran', 'status_pbj'
    ];
}
