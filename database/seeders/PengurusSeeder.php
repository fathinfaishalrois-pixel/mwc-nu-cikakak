<?php

namespace Database\Seeders;

use App\Models\Pengurus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PengurusSeeder extends Seeder
{
    public function run(): void
    {
        // Prototype fiktif dengan komposisi visual 1 → 2 → 3 → 9 seperti referensi.
        $rows = [
            ['KH Ahmad Fadli','Ketua MWC NU Cikakak','Pimpinan',null,1,'Sukabumi','1973-04-12','Pondok Pesantren / Pendidikan Keagamaan','Desa Cikakak, Wangon','ahmad.fadli@mwc-cikakak.test','0812-7000-1001'],

            ['Siti Rahmawati','Sekretaris','Administrasi & Kesekretariatan','KH Ahmad Fadli',1,'Banyumas','1987-09-21','S1 Administrasi Publik','Desa Cikakak, Wangon','siti.rahmawati@mwc-cikakak.test','0812-7000-1002'],
            ['Ahmad Naufal','Bendahara','Keuangan','KH Ahmad Fadli',2,'Banyumas','1985-02-08','S1 Ekonomi Syariah','Desa Cikakak, Wangon','ahmad.naufal@mwc-cikakak.test','0812-7000-1003'],

            ['Ust. Rizki Anwar','Koordinator Dakwah','Dakwah & Pendidikan','Siti Rahmawati',1,'Banyumas','1986-11-03','S1 Komunikasi & Penyiaran Islam','Desa Cikakak, Wangon','rizki.anwar@mwc-cikakak.test','0812-7000-1004'],
            ['Rina Kurniasari','Koordinator Sosial','Pelayanan Masyarakat','Siti Rahmawati',2,'Banyumas','1990-01-25','S1 Kesejahteraan Sosial','Desa Cikakak, Wangon','rina.kurniasari@mwc-cikakak.test','0812-7000-1005'],
            ['Nurul Hidayah','Koordinator Pendidikan','Pendidikan & Literasi','Ahmad Naufal',1,'Banyumas','1989-12-14','S1 Pendidikan','Desa Cikakak, Wangon','nurul.hidayah@mwc-cikakak.test','0812-7000-1006'],

            ['Syarif Hidayatullah','Anggota Bidang Dakwah','Dakwah & Pendidikan','Ust. Rizki Anwar',1,'Banyumas','1990-04-22','S1 Hukum Keluarga Islam','Desa Cikakak, Wangon','syarif.hidayatullah@mwc-cikakak.test','0812-7000-1007'],
            ['Fauzan Hakim','Anggota Bidang Dakwah','Dakwah & Pendidikan','Ust. Rizki Anwar',2,'Banyumas','1992-05-15','S1 Manajemen','Desa Cikakak, Wangon','fauzan.hakim@mwc-cikakak.test','0812-7000-1008'],
            ['Dimas Prasetyo','Anggota Bidang Dakwah','Dakwah & Pendidikan','Ust. Rizki Anwar',3,'Banyumas','1993-03-09','SMA / Kader Organisasi','Desa Cikakak, Wangon','dimas.prasetyo@mwc-cikakak.test','0812-7000-1009'],

            ['Aulia Fitria','Anggota Bidang Sosial','Pelayanan Masyarakat','Rina Kurniasari',1,'Banyumas','1995-07-19','S1 Kesehatan Masyarakat','Desa Cikakak, Wangon','aulia.fitria@mwc-cikakak.test','0812-7000-1010'],
            ['Nanda Putri Lestari','Anggota Bidang Sosial','Pelayanan Masyarakat','Rina Kurniasari',2,'Banyumas','1997-10-05','S1 Ilmu Komunikasi','Desa Cikakak, Wangon','nanda.lestari@mwc-cikakak.test','0812-7000-1011'],
            ['Bagus Ramadhan','Anggota Bidang Sosial','Pelayanan Masyarakat','Rina Kurniasari',3,'Banyumas','1996-01-28','S1 Teknik Informatika','Desa Cikakak, Wangon','bagus.ramadhan@mwc-cikakak.test','0812-7000-1012'],

            ['A. Nurul Mutmainnah','Anggota Bidang Pendidikan','Pendidikan & Literasi','Nurul Hidayah',1,'Banyumas','1991-09-10','S1 Pendidikan Bahasa','Desa Cikakak, Wangon','nurul.mutmainnah@mwc-cikakak.test','0812-7000-1013'],
            ['M. Ilham Fauzi','Anggota Bidang Pendidikan','Pendidikan & Literasi','Nurul Hidayah',2,'Banyumas','1994-08-30','D3 Desain Komunikasi Visual','Desa Cikakak, Wangon','ilham.fauzi@mwc-cikakak.test','0812-7000-1014'],
            ['Ust. Fajar Maulana','Anggota Bidang Pendidikan','Pendidikan & Literasi','Nurul Hidayah',3,'Cilacap','1982-06-17','S1 Pendidikan Agama Islam','Desa Cikakak, Wangon','fajar.maulana@mwc-cikakak.test','0812-7000-1015'],
        ];

        $ids = [];
        foreach ($rows as $i => [$nama,$jabatan,$bidang,$parent,$urutan,$tempat,$lahir,$pendidikan,$alamat,$email,$telepon]) {
            $item = Pengurus::create([
                'nama' => $nama,
                'slug' => Str::slug($nama),
                'jabatan' => $jabatan,
                'bidang' => $bidang,
                'foto' => 'assets/placeholders/pengurus-'.($i + 1).'.svg',
                'periode' => '2026–2029',
                'parent_id' => $parent ? $ids[$parent] : null,
                'urutan' => $urutan,
                'bio' => 'Pengurus fiktif untuk kebutuhan prototype website MWC NU Cikakak. Profil ini dapat diganti dengan biodata resmi melalui panel admin.',
                'deskripsi' => 'Bertugas mendukung koordinasi organisasi, pelayanan warga, kaderisasi, dan pelaksanaan program kerja sesuai bidangnya. Seluruh narasi pada prototype ini bersifat contoh dan bukan data kepengurusan resmi.',
                'tempat_lahir' => $tempat,
                'tanggal_lahir' => $lahir,
                'pendidikan' => $pendidikan,
                'alamat' => $alamat,
                'email' => $email,
                'telepon' => $telepon,
                'status' => true,
            ]);
            $ids[$nama] = $item->id;
        }
    }
}
