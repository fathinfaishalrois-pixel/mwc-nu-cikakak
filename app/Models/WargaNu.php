<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WargaNu extends Model
{
    protected $table = 'warga_nu';

    protected $fillable = [
        'nama', 'nik', 'jenis_kelamin', 'alamat', 'dusun', 'desa', 'no_hp', 'pekerjaan', 'foto', 'status', 'verification_status', 'rejection_reason', 'card_code', 'profile_token',
    ];
}
