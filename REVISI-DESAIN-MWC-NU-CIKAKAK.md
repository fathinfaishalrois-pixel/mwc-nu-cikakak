# Revisi Visual MWC NU Cikakak — Emerald Dominant

Paket ini adalah revisi visual lanjutan pada proyek Laravel yang diberikan. Struktur aplikasi, route, model, migration, autentikasi, dan modul administrasi dipertahankan.

## Arah visual terbaru

Identitas visual diubah menjadi **hijau emerald dominan + putih bersih + aksen antique gold**. Krem tidak lagi menjadi warna dasar utama.

| Peran | Warna | Kode |
|---|---|---|
| Emerald utama | Deep Emerald | `#073B2B` |
| Hijau utama | Emerald | `#087A49` |
| Hijau terang | Fresh Emerald | `#0B9258` |
| Putih | Clean White | `#FFFFFF` |
| Putih kehijauan | Soft White | `#F4FFF8` |
| Aksen premium | Antique Gold | `#C5A15B` |
| Teks | Charcoal Green | `#102C21` |

## Latar dan ornamen tiap halaman

- Seluruh halaman publik memiliki lapisan latar dekoratif geometris, radial light, dan garis arsitektural yang tidak mengganggu keterbacaan.
- Beranda: emerald glow dan pola radial medallion di sisi kanan.
- Tentang: garis geometris diagonal dengan cahaya emerald di sisi kiri.
- Berita: pola garis editorial dan medallion di area kanan atas.
- Kepengurusan: pola radial simetris yang memberi kesan struktur dan keteraturan.
- Kegiatan: garis diagonal dan emerald glow di bagian bawah.
- Galeri: garis vertikal halus dan dua titik cahaya dekoratif.
- Warga NU: emerald glow yang lebih kuat sebagai penekanan halaman layanan warga.
- Kontak: cahaya emerald kiri bawah dan gold kanan atas.
- Ornamen medallion utama bergerak satu putaran setiap 72 detik; posisi dan intensitas berbeda per halaman.

## Perubahan antarmuka

- Header navigasi menjadi emerald gelap dengan teks putih dan detail gold.
- Hero beranda dan hero berita menggunakan bidang emerald yang lebih dominan.
- Kartu konten menggunakan permukaan putih dengan border hijau lembut dan bayangan emerald.
- Footer menggunakan gradasi emerald gelap ke emerald.
- Arsip berita dan detail berita memakai editorial layout dengan kontras emerald/putih, foto utama, metadata, ringkasan, progres baca, tombol berbagi, dan berita terkait.
- Form admin berita memakai panel putih, fokus input emerald, pratinjau thumbnail, penghitung ringkasan, serta checklist editorial.
- Animasi menghormati `prefers-reduced-motion`.

## Berkas utama

- `resources/css/app.css` — sistem visual emerald-dominant dan dekorasi latar per halaman.
- `public/assets/site.css` — hasil build CSS yang dipakai layout.
- `resources/views/public/berita.blade.php` dan `berita-detail.blade.php` — halaman editorial berita.
- `resources/views/admin/berita/form.blade.php` — form admin berita.
- `resources/views/layouts/app.blade.php` — layout publik dan kelas identitas per halaman.

## Pemeriksaan yang dilakukan

- `node scripts/build-assets.mjs` berhasil.
- `node --check` untuk JavaScript berhasil.
- `php -l` untuk file PHP pada `app/`, `routes/`, `resources/views/`, `bootstrap/`, `config/`, dan migration berhasil.

## Belum diverifikasi

- PHPUnit dan pengujian HTTP Laravel belum dijalankan karena dependency `vendor/` tidak tersedia di lingkungan ini.
- Build deployment nyata di Vercel dan koneksi Supabase belum diuji karena membutuhkan kredensial dan project tujuan milik pemilik website.

Sebelum deployment, jalankan `composer install`, `npm ci`, `npm run build`, lalu `php artisan test` pada lingkungan PHP yang sesuai. Gunakan kredensial Supabase/Vercel milik project sendiri dan ikuti `DEPLOYMENT-VERCEL-SUPABASE.md`.
