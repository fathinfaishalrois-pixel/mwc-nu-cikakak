<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['Kajian Ahad Pagi dan Silaturahmi Warga','2026-09-13','06.00–08.00 WIB','Aula Serbaguna Cikakak'],
            ['Kelas Kader Muda: Organisasi dan Pelayanan','2026-09-19','13.00–16.00 WIB','Ruang Belajar MWC NU Cikakak'],
            ['Bakti Sosial dan Layanan Warga','2026-09-26','08.00–12.00 WIB','Lapangan Desa Cikakak'],
            ['Pelatihan Publikasi Digital','2026-10-03','09.00–12.00 WIB','Sekretariat MWC NU Cikakak'],
            ['Silaturahmi Pengurus dan Tokoh Masyarakat','2026-10-10','19.30–21.00 WIB','Balai Pertemuan Desa'],
            ['Forum Perencanaan Program Akhir Tahun','2026-10-17','13.30–16.00 WIB','Sekretariat MWC NU Cikakak'],
            ['Evaluasi Program Bidang dan Dokumentasi','2026-10-24','13.30–15.30 WIB','Sekretariat MWC NU Cikakak'],
            ['Kelas Literasi Digital untuk Relawan','2026-10-31','09.00–12.00 WIB','Ruang Belajar MWC NU Cikakak'],
            ['Gerakan Bersih Lingkungan dan Tanam Pohon','2026-11-07','07.00–11.00 WIB','Lingkungan Desa Cikakak'],
        ];

        foreach ($rows as $i => [$nama,$tanggal,$waktu,$lokasi]) {
            Kegiatan::create([
                'nama'=>$nama,
                'slug'=>Str::slug($nama),
                'foto'=>'assets/media/nuu/nuu-'.str_pad((($i + 2) % 18 + 1), 2, '0', STR_PAD_LEFT).'.jpg',
                'tanggal'=>$tanggal,
                'waktu'=>$waktu,
                'lokasi'=>$lokasi,
                'ringkasan'=>'Agenda prototype dengan dokumentasi visual referensi. Data kegiatan, waktu, peserta, dan narasi bersifat dummy sampai diganti data resmi.',
                'deskripsi'=>'Agenda ini merupakan contoh untuk memperlihatkan bagaimana kegiatan sosial, silaturahmi, kaderisasi, dan pelayanan warga ditampilkan secara visual. Seluruh detail acara pada prototype ini fiktif dan dapat diperbarui melalui panel admin.',
                'status'=>'published',
            ]);
        }
    }
}
