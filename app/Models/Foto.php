<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'foto';

    protected $fillable = ['galeri_id', 'file', 'caption'];

    public function galeri()
    {
        return $this->belongsTo(Galeri::class);
    }
}
