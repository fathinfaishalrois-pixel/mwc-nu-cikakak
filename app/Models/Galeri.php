<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
        'judul', 'gambar', 'deskripsi', 'tanggal', 'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'status' => 'boolean',
        ];
    }

    public function foto()
    {
        return $this->hasMany(Foto::class, 'galeri_id');
    }
}
