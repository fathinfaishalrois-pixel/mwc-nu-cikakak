<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Kegiatan extends Model
{
    protected $table = 'kegiatan';
    protected $fillable = ['nama','slug','foto','tanggal','waktu','lokasi','ringkasan','deskripsi','status'];
    protected function casts(): array { return ['tanggal' => 'date']; }
}
