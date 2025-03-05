<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'nik',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_telpon',
        'email',
        'status_perkawinan',
        'pekerjaan',
        'penghasilan_bulanan'
    ];

    public function pengajuanKredits()
    {
        return $this->hasMany(PengajuanKredit::class);
    }
}
