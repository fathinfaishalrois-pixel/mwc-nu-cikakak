<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds for MWC NU Cikakak, Wangon, Banyumas.
     *
     * @return void
     */
    public function run()
    {
        // 1. Data Berita / Agenda MWC NU Cikakak Wangon
        $berita = [
            [
                'judul' => 'Pengajian Rutin Selapanan MWC NU Cikakak Wangon di Masjid Saka Tunggal',
                'slug' => 'pengajian-rutin-selapanan-mwc-nu-cikakak-wangon',
                'ringkasan' => 'Kegiatan selapanan jemaah Nahdliyin Cikakak Wangon dihadiri ratusan warga dengan khidmah di kawasan cagar budaya Saka Tunggal.',
                'isi' => 'Cikakak, Wangon - Pengurus MWC NU Cikakak menggelar Pengajian Rutin Selapanan yang bertempat di kompleks Masjid Saka Tunggal Cikakak, Wangon, Banyumas. Acara diawali dengan istighotsah bersama, simtuddurar, dan tausiyah kebangsaan oleh para ulama NU Wangon.',
                'kategori' => 'Kegiatan',
                'penulis' => 'LTM MWC NU Cikakak',
                'tanggal' => now()->subDays(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'LAZISNU Cikakak Wangon Salurkan Bantuan Paket Sembako untuk Warga Kurang Mampu',
                'slug' => 'lazisnu-cikakak-wangon-salurkan-bantuan-sembako',
                'ringkasan' => 'UPZIS LAZISNU Cikakak mendistribusikan 150 paket bantuan pangan hasil perolehan koin NU warga desa Cikakak.',
                'isi' => 'Wangon - Bertempat di Gedung MWC NU Cikakak Wangon, pengurus LAZISNU menyerahkan secara simbolis bantuan sembako kepada warga penerima manfaat. Program ini didukung penuh oleh perolehan Koin NU Cikakak Wangon.',
                'kategori' => 'Sosial',
                'penulis' => 'LAZISNU Cikakak',
                'tanggal' => now()->subDays(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Pelatihan Digitalisasi Banom Ansor dan Fatayat NU Cikakak Wangon',
                'slug' => 'pelatihan-digitalisasi-banom-ansor-fatayat-cikakak',
                'ringkasan' => 'Meningkatkan literasi media dan pengelolaan website dakwah digital bagi pemuda NU Cikakak, Wangon, Banyumas.',
                'isi' => 'Cikakak - GP Ansor bersama Fatayat NU Cikakak Wangon menyelenggarakan workshop pembuatan konten kreatif dan tata kelola media informasi organisasi berbasis web.',
                'kategori' => 'Pendidikan',
                'penulis' => 'Cyber NU Cikakak',
                'tanggal' => now()->subDays(8),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('posts')->insert($berita);

        // 2. Data Pengurus MWC NU Cikakak Wangon
        $pengurus = [
            [
                'nama' => 'KH. Ahmad Dahlan',
                'jabatan' => 'Rais Syuriah MWC NU Cikakak',
                'alamat' => 'Desa Cikakak RT 02/03, Kec. Wangon, Kab. Banyumas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Kyai Mustofa',
                'jabatan' => 'Katib Syuriah MWC NU Cikakak',
                'alamat' => 'Desa Cikakak RT 01/01, Kec. Wangon, Kab. Banyumas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'H. Sunarto, S.Pd.',
                'jabatan' => 'Ketua Tanfidziyah MWC NU Cikakak',
                'alamat' => 'Desa Cikakak RT 04/02, Kec. Wangon, Kab. Banyumas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ust. Ridwan Hidayat',
                'jabatan' => 'Sekretaris MWC NU Cikakak',
                'alamat' => 'Desa Cikakak RT 03/04, Kec. Wangon, Kab. Banyumas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('officers')->insert($pengurus);

        // 3. Data Lembaga & Banom
        $banom = [
            ['nama' => 'GP Ansor Cikakak', 'deskripsi' => 'Gerakan Pemuda Ansor Ranting Cikakak Wangon', 'ketua' => 'Sahabat Abdul Hamid'],
            ['nama' => 'Fatayat NU Cikakak', 'deskripsi' => 'Pemudi Nahdliyin Desa Cikakak Wangon', 'ketua' => 'Sahabati Nurul Aini'],
            ['nama' => 'IPNU Cikakak', 'deskripsi' => 'Ikatan Pelajar Nahdlatul Ulama Cikakak', 'ketua' => 'Rekan Irfan Fauzi'],
            ['nama' => 'IPPNU Cikakak', 'deskripsi' => 'Ikatan Pelajar Putri Nahdlatul Ulama Cikakak', 'ketua' => 'Rekanita Siti Mariam'],
            ['nama' => 'LAZISNU Cikakak', 'deskripsi' => 'Lembaga Amil Zakat, Infak, dan Sedekah NU Cikakak Wangon', 'ketua' => 'Ust. M. Sobirin'],
        ];

        DB::table('organizations')->insert($banom);
    }
}
