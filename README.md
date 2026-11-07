# MWC NU Cikakak

Website profil organisasi dan CMS admin untuk MWC NU Cikakak, Desa Cikakak, Kecamatan Wangon, Kabupaten Banyumas.

## Stack

- Laravel 13
- PHP 8.3+ (image Vercel menggunakan PHP 8.4)
- SQLite/MySQL untuk lokal; PostgreSQL Supabase untuk deployment contoh
- FrankenPHP + Caddy untuk container Vercel
- Supabase Storage (S3-compatible) untuk file upload persisten

## Instalasi lokal (Laragon)

1. Pastikan PHP Laragon minimal 8.3 dan aktifkan ekstensi `ctype`, `curl`, `dom`, `fileinfo`, `mbstring`, `openssl`, `pdo`, driver PDO database yang dipakai (`pdo_mysql` atau `pdo_sqlite`), `tokenizer`, `xml`, dan `xmlwriter`.
2. Salin `.env.example` menjadi `.env`.
3. Jalankan `composer install`.
4. Jalankan `npm ci` lalu `npm run build`.
5. Jalankan `php artisan key:generate`.
6. Atur database di `.env`, lalu jalankan `php artisan migrate` hanya untuk database baru atau setelah memeriksa migration yang belum dijalankan.
7. Jalankan `php artisan db:seed` hanya untuk database pengembangan/demo yang memang boleh diisi data contoh.
8. Jalankan `php artisan storage:link` bila memakai penyimpanan file lokal.
9. Jalankan `php artisan serve`.

Jangan menjalankan `migrate:fresh` pada database yang berisi data. Jangan menimpa `.env` yang sudah berisi konfigurasi lokal.

## Deployment Vercel

Konfigurasi container ada di `Dockerfile.vercel`, `Caddyfile`, dan `vercel.json`. Panduan lengkap Supabase, environment variables, Storage, migration, dan push ada di `DEPLOYMENT-VERCEL-SUPABASE.md`.

Vercel adalah hosting aplikasi, bukan database permanen. Untuk konfigurasi contoh, siapkan Supabase PostgreSQL dan Supabase Storage secara terpisah.

## Admin CMS

URL: `/admin/login`

Akun demo untuk pengembangan:

- Email: `admin@mwc-nu-cikakak.test`
- Password: `password`

Jangan memakai password demo di production. Buat/ganti kredensial admin yang kuat sebelum situs dibuka ke publik.

## Fitur

- Website responsif untuk desktop, tablet, dan ponsel
- Struktur organisasi interaktif dan modal biodata
- Carousel berita dan kegiatan
- Detail berita, kegiatan, dan galeri
- CMS admin untuk pengurus, berita, kegiatan, agenda, galeri, organisasi, warga NU, dan infak
- Animasi, micro-interaction, dan kontrol sound

Konten awal pada seeder adalah data contoh. Periksa dan ganti sebelum penggunaan resmi.
