<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Support\PlaceholderImage;
class DatabaseSeeder extends Seeder
{
 public function run(): void
 {
  $this->call([UserSeeder::class,PengurusSeeder::class,BeritaSeeder::class,KegiatanSeeder::class,GaleriSeeder::class]);
  for($i=1;$i<=15;$i++) PlaceholderImage::ensure('assets/placeholders/pengurus-'.$i.'.svg','Pengurus '.$i,'Foto Pengurus');
  for($i=1;$i<=7;$i++) PlaceholderImage::ensure('assets/placeholders/berita-'.$i.'.svg','Berita '.$i,'Thumbnail Berita');
  for($i=1;$i<=7;$i++) PlaceholderImage::ensure('assets/placeholders/kegiatan-'.$i.'.svg','Kegiatan '.$i,'Foto Kegiatan');
  for($i=1;$i<=12;$i++) PlaceholderImage::ensure('assets/placeholders/galeri-'.$i.'.svg','Galeri '.$i,'Dokumentasi');
 }
}
