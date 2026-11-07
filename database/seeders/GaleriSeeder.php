<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            'Rapat Koordinasi Pengurus','Kajian dan Silaturahmi','Pelayanan Sosial Warga','Kelas Kader Muda',
            'Forum Pendidikan','Kegiatan Kepemudaan','Dokumentasi Dakwah','Kolaborasi Masyarakat',
            'Ruang Kreatif Media','Musyawarah Program','Bakti Lingkungan','Temu Relawan',
            'Pelatihan Administrasi','Forum Tokoh Masyarakat','Kegiatan Literasi','Persiapan Bakti Sosial',
        ];
        foreach ($titles as $i => $judul) {
            Galeri::create([
                'judul'=>$judul,
                'gambar'=>'assets/media/nuu/nuu-'.str_pad((($i % 18) + 1), 2, '0', STR_PAD_LEFT).'.jpg',
                'deskripsi'=>'Dokumentasi visual referensi yang diunggah untuk prototype. Detail lokasi, peserta, dan konteks pada foto perlu diverifikasi sebelum dipakai sebagai dokumentasi resmi.',
                'tanggal'=>date('Y-m-d',strtotime('-'.($i * 3).' days')),
                'status'=>true,
            ]);
        }
    }
}
