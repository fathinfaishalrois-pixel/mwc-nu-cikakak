<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';

    protected $fillable = ['nama', 'tanggal', 'waktu', 'lokasi', 'deskripsi'];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
