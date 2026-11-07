<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['Musyawarah Program Kerja MWC NU Cikakak','Organisasi','2026-08-29','Forum penyusunan agenda pelayanan organisasi untuk satu periode ke depan.'],
            ['Gerakan Berbagi untuk Warga Cikakak','Sosial','2026-08-24','Kolaborasi relawan dalam menyalurkan paket kebutuhan pokok secara tertib dan tepat sasaran.'],
            ['Penguatan Literasi Keagamaan Generasi Muda','Pendidikan','2026-08-18','Ruang belajar bersama untuk membangun tradisi membaca, berdiskusi, dan berkhidmat.'],
            ['Koordinasi Bidang Dakwah dan Pendidikan','Dakwah','2026-08-11','Pertemuan pengurus bidang membahas program kajian dan pendampingan masyarakat.'],
            ['Pelatihan Administrasi Organisasi Berbasis Digital','Kaderisasi','2026-08-04','Pelatihan ringan untuk membuat pengelolaan arsip dan agenda lebih rapi.'],
            ['Rembuk Warga dan Pemetaan Potensi Desa','Kemasyarakatan','2026-07-28','Diskusi partisipatif untuk memetakan kebutuhan serta potensi kegiatan masyarakat.'],
            ['Tim Media Menyusun Kalender Publikasi','Media','2026-07-21','Penyusunan jadwal dokumentasi agar setiap kegiatan memiliki cerita dan arsip visual yang rapi.'],
            ['Kader Muda Membuka Ruang Belajar Bersama','Kepemudaan','2026-07-15','Pertemuan perdana kader muda untuk berbagi gagasan tentang organisasi, teknologi, dan pelayanan.'],
            ['Silaturahmi Pengurus dengan Tokoh Masyarakat','Kemasyarakatan','2026-07-08','Dialog santai untuk mendengar masukan warga dan menyusun kolaborasi kegiatan berikutnya.'],
        ];

        foreach ($rows as $i => [$judul,$kategori,$tanggal,$ringkasan]) {
            Berita::create([
                'judul'=>$judul,
                'slug'=>Str::slug($judul),
                'kategori'=>$kategori,
                'thumbnail'=>'assets/media/nuu/nuu-'.str_pad((($i + 8) % 18 + 1), 2, '0', STR_PAD_LEFT).'.jpg',
                'ringkasan'=>$ringkasan,
                'isi'=>$ringkasan."\n\nKonten ini merupakan materi fiktif untuk prototype website. Informasi dapat diganti melalui panel admin sebelum digunakan untuk publikasi resmi.\n\nTim pengurus dapat menambahkan foto, kutipan, susunan acara, dan informasi narahubung pada versi produksi.",
                'penulis'=>'Tim Media MWC NU Cikakak',
                'tanggal'=>$tanggal,
                'status'=>'published',
            ]);
        }
    }
}
