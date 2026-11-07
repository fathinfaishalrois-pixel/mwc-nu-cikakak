# Deploy MWC NU Cikakak ke Vercel + Supabase

Project ini memakai Laravel 13 dan deployment container FrankenPHP. Konfigurasi Vercel ada di `Dockerfile.vercel`, `Caddyfile`, dan `vercel.json`.

> Catatan: Vercel Container Runtime saat ini berstatus beta. Berbeda dengan runtime `vercel-php` komunitas yang tidak lagi dipelihara/diarsipkan, konfigurasi ini mengikuti panduan Laravel + Docker yang diterbitkan Vercel. Uji deployment dan fitur paket Vercel sebelum produksi.

## 1. Siapkan kebutuhan

- Akun Vercel dan GitHub.
- Project Supabase untuk PostgreSQL.
- Supabase Storage dengan S3 credentials.
- PHP lokal minimal 8.3 dan Composer 2 untuk menjalankan migration dari komputer.
- Docker Desktop jika ingin mengetes container secara lokal; Vercel dapat membangun image saat deployment.

Image deployment memakai PHP 8.4, Node.js 22, dan memasang ekstensi PHP yang dibutuhkan Laravel serta driver PostgreSQL/MySQL/SQLite.

## 2. Database Supabase

1. Buat project Supabase.
2. Buka **Connect** dan salin connection string **Transaction Pooler** untuk aplikasi serverless. Gunakan host, username, password, database, dan port persis yang ditampilkan dashboard (umumnya port `6543`).
3. Jangan menebak host atau username. Encode karakter khusus pada password sesuai format URL bila diperlukan.
4. Siapkan backup database lama sebelum migrasi atau pemindahan data.

Vercel tidak otomatis menyediakan database relasional untuk aplikasi ini. Supabase PostgreSQL adalah database eksternal yang dipakai konfigurasi contoh.

## 3. Siapkan Supabase Storage

1. Buat bucket `mwc-media`.
2. Jadikan bucket public hanya jika semua gambar di dalamnya memang aman untuk dibuka publik.
3. Dari pengaturan S3 Storage Supabase, salin S3 Access Key ID, Secret Access Key, endpoint, dan region.
4. Jangan menggunakan `service_role` key sebagai S3 credential.
5. Bukti pembayaran/infak dan dokumen pribadi harus disimpan di bucket privat dengan URL bertanda tangan. Controller Infak yang ada masih menggunakan disk `public`; jangan menyimpan bukti transaksi nyata sebelum alur tersebut dipindahkan ke disk privat.

Folder lokal `storage/app/public` tidak menjadi penyimpanan permanen di Vercel. Pindahkan file upload lama ke bucket Supabase dan pastikan path yang tersimpan di database masih sesuai.

## 4. Siapkan APP_KEY

Dari folder project lokal:

```bash
php artisan key:generate --show
```

Simpan hasil `base64:...` untuk environment `APP_KEY` di Vercel. Gunakan key stabil untuk setiap environment; jangan membuat key baru pada setiap deployment dan jangan commit file `.env`.

## 5. Environment Variables Vercel

Buka **Vercel Project > Settings > Environment Variables**. Tambahkan nilai berikut untuk Production (tambahkan Preview/Development sesuai kebutuhan):

```dotenv
APP_NAME="MWC NU Cikakak"
APP_ENV=production
APP_KEY=base64:ISI_DENGAN_KEY_ASLI
APP_DEBUG=false
APP_URL=https://DOMAIN-VERCEL-ANDA
APP_LOCALE=id
APP_FALLBACK_LOCALE=id
APP_FAKER_LOCALE=id_ID

LOG_CHANNEL=stderr
LOG_LEVEL=warning

DB_CONNECTION=pgsql
DB_URL=postgresql://postgres.PROJECT_REF:PASSWORD@POOLER_HOST:6543/postgres
DB_SSLMODE=require
DB_SEARCH_PATH=public

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=true
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax
CACHE_STORE=database
QUEUE_CONNECTION=sync
APP_MAINTENANCE_DRIVER=cache
APP_MAINTENANCE_STORE=database

FILESYSTEM_DISK=public
PUBLIC_FILESYSTEM_DRIVER=s3
AWS_ACCESS_KEY_ID=S3_ACCESS_KEY_ID
AWS_SECRET_ACCESS_KEY=S3_SECRET_ACCESS_KEY
AWS_DEFAULT_REGION=REGION_DARI_SUPABASE
AWS_BUCKET=mwc-media
AWS_ENDPOINT=https://PROJECT_REF.supabase.co/storage/v1/s3
AWS_URL=https://PROJECT_REF.supabase.co/storage/v1/object/public/mwc-media
AWS_USE_PATH_STYLE_ENDPOINT=true
SUPABASE_PRIVATE_BUCKET=mwc-private
```

Ganti semua nilai contoh dengan nilai asli dari dashboard. Jangan menaruh secret di GitHub, `VITE_*`, atau file `.env` yang di-commit. File `.env.vercel.example` hanya template dan bukan konfigurasi siap pakai.

## 6. Migrasi database dengan aman

Audit ZIP menemukan dua file database lokal yang sengaja dipertahankan tanpa perubahan:

- `database/database.sqlite` memiliki skema terbaru dan tabel konten utama masih kosong.
- `database/database-backup.sqlite` berisi data lama: 15 pengurus, 9 berita, 9 kegiatan, 16 galeri, dan 1 akun pengguna.

Keduanya dikecualikan dari Git dan Docker image agar database lokal/backup tidak ikut terpublikasi. Data backup tidak otomatis dipindahkan ke Supabase. Buat backup tambahan, lalu lakukan proses ekspor/impor terpisah dengan pemetaan kolom yang sesuai sebelum situs production dibuka. Jangan menimpa salah satu file SQLite tersebut.

Jangan menjalankan `migrate:fresh`, `db:wipe`, atau `migrate:rollback` pada database yang berisi data.

Untuk database Supabase yang baru dan kosong:

1. Atur koneksi PostgreSQL sementara di `.env` lokal menggunakan koneksi yang dapat dijangkau komputer Anda.
2. Jalankan:

```bash
php artisan config:clear
php artisan migrate:status
php artisan migrate --pretend
php artisan migrate --force
```

3. Periksa tabel dan kolom melalui Supabase Table Editor.
4. Jalankan seeder hanya bila memang ingin mengisi data demo. Jangan seed akun demo ke production tanpa mengganti password.

Jika database lama berisi data dari SQLite/MySQL, membuat tabel di Supabase **tidak otomatis memindahkan data**. Ekspor dan impor data perlu dilakukan sebagai langkah terpisah setelah backup. Jangan mengubah nama tabel, kolom, atau query aplikasi hanya untuk memaksa proses migrasi.

## 7. Push ke GitHub dan deploy

1. Ekstrak ZIP project yang sudah dioptimalkan.
2. Buat repository GitHub baru atau gunakan repository project Anda.
3. Pastikan `.env`, `vendor`, `node_modules`, file SQLite, cache, dan log tidak ikut di-commit.
4. Commit dan push seluruh source code.
5. Import repository di Vercel, pilih Root Directory yang berisi `vercel.json` dan `Dockerfile.vercel`.
6. Pastikan framework deployment menggunakan **Container** bila dashboard meminta pilihan framework. `Dockerfile.vercel` dan `vercel.json` sudah disiapkan untuk container runtime.
7. Tambahkan Environment Variables pada langkah 5, lalu deploy.

Vercel akan membangun image FrankenPHP, memasang dependency Composer production, membangun asset, lalu mengarahkan request ke Laravel melalui `public/index.php`.

## 8. Setelah deploy

- Buka `/up` untuk health check Laravel.
- Uji halaman beranda, berita, kegiatan, kepengurusan, dan galeri.
- Uji login admin, session, logout, dan CRUD.
- Uji upload gambar dan pastikan objek masuk ke Supabase Storage.
- Uji detail berita/kegiatan, pendaftaran warga, dan halaman profil.
- Periksa Vercel Runtime Logs dan Supabase Logs.
- Pastikan data privat tidak terbuka ke publik.

## 9. Catatan runtime dan troubleshooting

- Container Vercel bersifat ephemeral/stateless. Jangan mengandalkan file lokal sebagai database, cache lintas instance, session, atau penyimpanan upload permanen.
- Session/cache aplikasi disetel ke database; tabel `sessions`, `cache`, dan `cache_locks` disiapkan oleh migration bawaan proyek.
- Upload disk `public` diarahkan ke Supabase S3 melalui `PUBLIC_FILESYSTEM_DRIVER=s3`.
- `QUEUE_CONNECTION=sync` menjalankan job dalam request. Tidak ada daemon queue/scheduler permanen di container web.
- Jangan jalankan `php artisan config:cache` saat image dibangun karena Vercel memasok secret pada runtime. Jangan menjalankan migration otomatis saat container mulai; lakukan sebagai release step terpisah.
- `SQLSTATE[08006]`, `could not find driver`, atau timeout: cek `DB_URL`, driver `pdo_pgsql`, port/host pooler, SSL mode, dan kredensial.
- `SQLSTATE[HY000] [1045]`: khusus MySQL, periksa `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` pada environment target.
- `No application encryption key`: isi `APP_KEY` di Vercel dan redeploy.
- CSS/JS tidak muncul: periksa Build Logs dan pastikan `public/assets/site.css`, `site.js`, serta `premium.js` berhasil dibangun.
- Gambar gagal muncul: periksa bucket, region, URL publik, endpoint S3, dan kredensial.
- Jika deploy memberi 502: periksa Runtime Logs, Docker build, Caddyfile, dan port `PORT`.
