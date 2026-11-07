<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    protected $table = 'organisasi';

    protected $fillable = ['nama', 'jenis', 'deskripsi', 'ketua', 'logo', 'link'];
}
