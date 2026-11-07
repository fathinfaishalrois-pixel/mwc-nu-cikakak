<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Berita extends Model
{
    protected $table = 'berita';
    protected $fillable = ['judul','slug','kategori','thumbnail','ringkasan','isi','penulis','tanggal','status'];
    protected function casts(): array { return ['tanggal' => 'date']; }
}
