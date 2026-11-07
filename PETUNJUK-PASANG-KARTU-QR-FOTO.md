# Petunjuk pemasangan fitur QR dan foto profil Warga NU

## Yang ditambahkan
- Form pendaftaran menerima foto profil opsional (JPG/JPEG, PNG, WEBP, maksimal 2 MB).
- Foto disimpan ke disk Laravel `public` di folder `storage/app/public/warga-nu`.
- Foto tampil pada kartu digital dan tautan foto tersedia pada detail profil.
- Sisi belakang kartu profil anggota menampilkan QR yang dibuat di browser. QR mengarah ke tautan profil pribadi anggota, bukan memuat NIK mentah di dalam kode QR.
- NIK tetap disamarkan pada halaman profil. QR menggunakan tautan token pribadi; siapa pun yang memiliki tautan itu dapat membuka halaman profil, jadi jangan membagikannya sembarangan.

## Langkah pemasangan aman
1. Cadangkan folder project dan file database, terutama `database/database.sqlite` jika menggunakan SQLite.
2. Ekstrak ZIP ini ke folder baru terlebih dahulu. Jangan menimpa project aktif sebelum cadangan siap.
3. Buka terminal pada folder project yang berisi file `artisan`.
4. Pastikan file `.env` berisi konfigurasi database yang benar. Jangan mengganti atau menghapus database yang berisi data lama.
5. Jalankan migrasi:
   ```bash
   php artisan migrate --force
   ```
   Untuk pengembangan lokal, `php artisan migrate` juga bisa digunakan. Jangan jalankan `migrate:fresh` karena menghapus tabel/data.
6. Buat tautan penyimpanan publik jika belum ada:
   ```bash
   php artisan storage:link
   ```
   Jika perintah melaporkan tautan sudah ada, jangan hapus folder `storage` atau foto; periksa `public/storage` terlebih dahulu.
7. Bangun ulang aset frontend:
   ```bash
   npm install
   npm run build
   ```
8. Jalankan aplikasi lokal sesuai setup Laravel kamu, lalu buka halaman Warga NU.
9. Tes pendaftaran dengan data uji yang bukan NIK asli: pilih foto JPG/PNG/WEBP di bawah 2 MB, kirim, dan pastikan halaman profil muncul.
10. Di halaman profil, balik kartu. QR harus tampil. Pindai QR dengan perangkat lain yang dapat mengakses alamat website tersebut. Jika memakai `127.0.0.1` atau `localhost`, QR hanya bisa dibuka di komputer yang sama; untuk tes lintas perangkat gunakan alamat LAN/server yang dapat dijangkau atau domain HTTPS.
11. Pastikan foto terlihat, QR membuka profil yang sesuai, status verifikasi benar, dan NIK tetap tersamarkan.
12. Tes berkas tidak valid: unggah berkas non-gambar atau gambar di atas 2 MB. Form harus menampilkan pesan ramah dan menolak unggahan.

## Catatan penting
- QR dimuat menggunakan pustaka QRCode.js dari CDN cdnjs saat halaman profil dibuka, sehingga koneksi internet diperlukan untuk membuat QR. Jika situs harus bekerja offline, pasang pustaka QR lokal dan ubah sumber script ke file lokal.
- QR saat ini membuka profil token pribadi, bukan halaman verifikasi publik. Ini mengurangi paparan data, tetapi token tetap merupakan akses privat. Jika nanti ingin QR yang bisa diperiksa publik, sebaiknya buat halaman verifikasi terpisah yang hanya menampilkan nama, kode kartu, foto (jika diizinkan), dan status anggota—jangan menampilkan NIK lengkap secara publik.
- Jangan menganggap pengujian sintaks sebagai jaminan bebas bug. Uji alur di browser dan database yang dipakai sebelum deploy produksi.

## Fitur baru: anggota mengganti foto sendiri

Anggota yang membuka tautan profil pribadinya sekarang dapat memilih foto baru di bagian **Foto profil kartu**, melihat pratinjau, lalu menekan **Simpan / Ganti Foto**. Tidak perlu mendaftar ulang dan kode kartu tidak berubah. Setelah berhasil, foto baru langsung dipakai pada kartu digital. Foto lama dihapus dari penyimpanan setelah foto baru berhasil disimpan.

- Endpoint pembaruan menggunakan token privat yang sama dengan halaman profil dan dilindungi CSRF Laravel.
- Maksimum 2 MB; format yang diterima JPG/JPEG, PNG, atau WEBP.
- Simpan tautan profil pribadi dengan aman. Siapa pun yang memiliki tautan token dapat membuka halaman profil dan mengubah foto, jadi jangan mengirim tautan ke grup publik.
- Setelah mengganti foto, muat ulang halaman jika gambar di cache browser masih menampilkan foto lama.
