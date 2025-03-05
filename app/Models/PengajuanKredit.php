<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanKredit extends Model
{
    use HasFactory;

    protected $fillable = [
        'konsumen_id',
        'merk_kendaraan',
        'model_kendaraan',
        'warna_kendaraan',
        'harga_kendaraan',
        'tenor',
        'dp_persen',
        'dp_nominal',
        'status',
        'catatan_approval',
        'marketing_id',
        'approver_id'
    ];

    public function konsumen()
    {
        return $this->belongsTo(Konsumen::class);
    }

    public function marketing()
    {
        return $this->belongsTo(User::class, 'marketing_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}
