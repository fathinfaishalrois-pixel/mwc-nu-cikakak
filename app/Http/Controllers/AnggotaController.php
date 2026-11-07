<?php

namespace App\Http\Controllers;

use App\Models\WargaNu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function create()
    {
        return view('public.anggota-daftar');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'digits:16', 'unique:warga_nu,nik'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'alamat' => ['required', 'string', 'max:1000'],
            'dusun' => ['nullable', 'string', 'max:255'],
            'desa' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:30'],
            'pekerjaan' => ['nullable', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nama.max' => 'Nama terlalu panjang. Maksimal 255 karakter.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari tepat 16 angka.',
            'nik.unique' => 'NIK ini sudah terdaftar. Jika ini data Anda, gunakan tautan profil yang pernah diberikan atau hubungi pengurus.',
            'jenis_kelamin.required' => 'Silakan pilih jenis kelamin.',
            'jenis_kelamin.in' => 'Pilihan jenis kelamin tidak valid. Silakan pilih kembali.',
            'alamat.required' => 'Alamat lengkap wajib diisi.',
            'alamat.max' => 'Alamat terlalu panjang. Maksimal 1.000 karakter. Silakan ringkas alamat.',
            'dusun.max' => 'Nama dusun terlalu panjang. Maksimal 255 karakter.',
            'desa.required' => 'Nama desa wajib diisi.',
            'desa.max' => 'Nama desa terlalu panjang. Maksimal 255 karakter.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.max' => 'Nomor HP terlalu panjang. Maksimal 30 karakter.',
            'pekerjaan.max' => 'Nama pekerjaan terlalu panjang. Maksimal 255 karakter.',
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
            '*.string' => 'Periksa kembali isian ini.',
        ]);

        do {
            $cardCode = 'MWC-' . strtoupper(Str::random(3)) . '-' . strtoupper(Str::random(4));
        } while (WargaNu::where('card_code', $cardCode)->exists());

        $token = Str::random(64);
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('warga-nu', 'public');
        }
        $warga = WargaNu::create([
            ...$data,
            'status' => 'tidak_aktif',
            'verification_status' => 'pending',
            'card_code' => $cardCode,
            'profile_token' => hash('sha256', $token),
        ]);

        return redirect()->route('anggota.profil', ['token' => $token])
            ->with('success', 'Pendaftaran tersimpan. Kartu masih menunggu verifikasi pengurus.');
    }

    public function profile(string $token)
    {
        $warga = WargaNu::where('profile_token', hash('sha256', $token))->firstOrFail();

        return view('public.anggota-profil', compact('warga', 'token'));
    }

    public function updatePhoto(Request $request, string $token)
    {
        $warga = WargaNu::where('profile_token', hash('sha256', $token))->firstOrFail();

        $validated = $request->validate([
            'foto' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'foto.required' => 'Pilih foto terlebih dahulu.',
            'foto.image' => 'File yang dipilih harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        $oldPhoto = $warga->foto;
        $newPhoto = $validated['foto']->store('warga-nu', 'public');
        $warga->foto = $newPhoto;
        $warga->save();

        if ($oldPhoto && $oldPhoto !== $newPhoto) {
            Storage::disk('public')->delete($oldPhoto);
        }

        return redirect()->route('anggota.profil', ['token' => $token])
            ->with('success', 'Foto profil berhasil diperbarui dan kartu anggota sudah menggunakan foto terbaru.');
    }
}
