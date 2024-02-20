<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';
    protected $hidden = [
        'password',
    ];
    protected $fillable = [
        'nama_karyawan',
        'id_jabatan',
        'nik',
        'password',
        'salt',
        'alamat',
        'ktp',
        'kk',
        'no_telpon',
        'nip'
    ];
}