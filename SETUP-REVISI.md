# Catatan Revisi — MWC NU Cikakak

## Yang paling penting: file project yang Anda unggah tidak lengkap

Zip yang diunggah hanya berisi `resources/`, `routes/`, `database/` (migrasi + `database.sqlite`),
dan `public/`. Tidak ada folder **`app/`** (Controller & Model), **`composer.json`**, `config/`,
maupun `bootstrap/` — jadi hampir semua fitur di views (klik berita, profil, struktur, dst.) memang
belum bisa jalan karena backend-nya belum ada sama sekali. `routes/web.php` aslinya cuma punya 1 baris
route (`/`).

Saya bangun ulang bagian yang hilang berdasarkan views & migrasi yang sudah ada. **Merge folder ini ke
project Laravel Anda yang sebenarnya** (yang punya `vendor/`, `composer.json`, `.env`, dll — biasanya di
komputer/server Anda), lalu jalankan langkah di bawah. Jangan replace folder `vendor/` Anda.

## Yang sudah dikerjakan

1. **Detail berita bisa diklik** — dibuat `BeritaController`, route `berita.index` / `berita.show`, dst.
   Semua link yang sudah ada di Blade (`route('berita.show', $item->slug)`) sekarang punya tujuan nyata.
2. **Profil** — `public/profil.blade.php` diisi struktur Visi/Misi/Khidmah yang lebih lengkap (paragraf
   sejarah masih ditandai draf — perlu diverifikasi pengurus, saya tidak mengarang data resmi).
3. **Struktur & Lembaga/Banom** — `StrukturController` (pengurus) dan `OrganisasiPageController`
   (lembaga & banom, dikelompokkan per jenis) dibuat. Saya juga menambahkan seeder berisi daftar lembaga
   NU umum (LP Ma'arif, LAZISNU, dll) dan banom (Muslimat, Fatayat, GP Ansor, Banser, IPNU, IPPNU) sebagai
   kerangka awal — silakan lengkapi ketua & deskripsi lewat panel admin.
4. **Infak NU / Koin NU** — fitur baru lengkap: migrasi tabel `infak`, model `Infak`, halaman publik
   `/infak-koin-nu` (form lapor + rekap total + rekap per desa + riwayat terverifikasi), dan halaman admin
   untuk memverifikasi/menghapus laporan.
5. **Desain lebih hidup** — animasi *scroll-reveal* (elemen muncul saat di-scroll), angka statistik yang
   "berjalan" (counter animation) di halaman Infak, hover transition pada tombol/gambar, dan tombol toggle
   suara latar di navbar.

## Tentang "suara" (audio)

Saya menambahkan tombol toggle suara + elemen `<audio>` di layout (`layouts/app.blade.php`), tapi saya
**tidak menyertakan file audio** — saya tidak bisa membuat/mengambil berkas audio nyata dari sini. Silakan
taruh file musik instrumental/nasheed pendek (misalnya `ambient.mp3`) di `public/audio/ambient.mp3`, atau
ganti path di layout jika ingin nama lain. Tanpa file itu, tombolnya tetap muncul tapi tidak bersuara.

## Langkah menjalankan di project asli Anda

```bash
# 1. Copy folder app/, database/migrations, database/seeders, routes/web.php,
#    dan isi resources/ dari paket ini ke project Laravel Anda (timpa file lama).

# 2. Daftarkan middleware alias 'admin' (dipakai di routes/web.php):
#    - Laravel 11+: di bootstrap/app.php, dalam ->withMiddleware(function ($middleware) {
#          $middleware->alias(['admin' => \App\Http\Middleware\EnsureUserIsAdmin::class]);
#      });
#    - Laravel 10 ke bawah: di app/Http/Kernel.php, tambahkan ke $middlewareAliases / $routeMiddleware:
#          'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,

php artisan migrate        # menambahkan tabel infak (tabel lain tidak diubah/dihapus)
php artisan db:seed        # membuat akun admin default + kategori + template lembaga/banom
php artisan storage:link   # kalau belum pernah dijalankan (untuk Storage::url() pada gambar)
npm install && npm run build   # build ulang Tailwind (ada token font-heading/font-body baru)
```

Akun admin default dari seeder: `admin@mwcnucikakak.or.id` / `ubah-password-ini` —
**segera ganti password ini setelah login pertama.**

## File lama yang tampaknya tidak terpakai

`index.html` dan `index.html.html` di root project sepertinya prototipe statis (Bootstrap) dari tahap
awal, bukan bagian dari aplikasi Laravel ini. Aman dihapus kalau memang sudah tidak dipakai.

## Yang belum saya sentuh / perlu Anda lengkapi

- Kontak (`kontak.blade.php`) masih placeholder — isi alamat, WA, email resmi.
- Isi lengkap Visi/Misi/sejarah di Profil masih draf.
- Nama ketua & deskripsi tiap lembaga/banom masih kosong (kerangka nama sudah ada dari seeder).
- Belum ada gateway pembayaran otomatis untuk Infak/Koin NU (QRIS di form hanya sebagai pilihan metode,
  verifikasi masih manual oleh admin) — kalau butuh integrasi payment gateway beneran, itu pekerjaan
  terpisah yang perlu didiskusikan (butuh akun merchant, dsb).


## Fitur anggota dan verifikasi (revisi 3)
- Jalankan `php artisan migrate` untuk menambah kolom `verification_status` dan `rejection_reason`.
- Pendaftaran publik berstatus `pending`; admin menyetujui/menolak dari menu Warga NU.
- Kartu resmi hanya aktif saat `verification_status=approved` dan `status=aktif`.
- Kartu profil mendukung drag rotasi 3D dan tombol flip depan/belakang.
- Frontend project ini adalah Laravel Blade + JavaScript/CSS vanilla; HoloCard React/WebGL yang dikirim belum bisa dipasang langsung tanpa menambahkan React. Kartu pada halaman profil mempertahankan identitas visual proyek dan mengadaptasi interaksi 3D agar kompatibel tanpa mengubah stack lama.

## Perbaikan database Warga NU (SQLite/MySQL)

Jika pendaftaran menampilkan `table warga_nu has no column named verification_status`, database yang dipakai aplikasi belum memiliki kolom verifikasi. Dari folder project yang berisi file `artisan`, jalankan:

```bash
php artisan migrate:status
php artisan migrate
php artisan migrate:status
```

Jangan hapus `database/database.sqlite` dan jangan menjalankan `migrate:fresh`, karena keduanya dapat menghilangkan data. ZIP ini menyertakan migration verifikasi dan migration pemulihan yang memeriksa kolom sebelum menambahkannya. Pastikan `.env` menunjuk ke database yang sama dengan yang dipakai aplikasi (pada laporan error: `database/database.sqlite`). Jika aplikasi berjalan di terminal Laragon, hentikan server lalu jalankan kembali setelah migrasi selesai.
