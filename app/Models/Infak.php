<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Infak extends Model
{
    protected $table = 'infak';

    protected $fillable = [
        'program', 'nama_donatur', 'no_hp', 'dusun', 'desa', 'jumlah', 'metode', 'catatan', 'bukti', 'status',
    ];

    public function scopeTerverifikasi($query)
    {
        return $query->where('status', 'terverifikasi');
    }
}
