<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengusul extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pengusul', 'id_user', 'no_identitas', 'status_pengusul', 'no_hp', 'email', 'keterangan', 'surat_penawaran', 'jenis_usulan', 'status_app_validator'
    ];
}
