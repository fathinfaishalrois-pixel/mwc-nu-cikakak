<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar berita.
     */
    public function index()
    {
        return view('admin.berita.index', [
            'items' => Berita::latest('tanggal')->paginate(15),
        ]);
    }

    /**
     * Menampilkan form tambah berita dengan tanggal hari ini.
     */
    public function create()
    {
        $item = new Berita();
        $item->tanggal = now('Asia/Jakarta')->toDateString();

        return view('admin.berita.form', [
            'item' => $item,
            'action' => route('admin.berita.store'),
            'method' => 'POST',
        ]);
    }

    /**
     * Menyimpan berita baru.
     */
    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['slug'] = $this->slug($data['judul']);
        $data['thumbnail'] = $this->upload($request);

        Berita::create($data);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil disimpan.');
    }

    /**
     * Menampilkan form edit berita.
     */
    public function edit(Berita $berita)
    {
        return view('admin.berita.form', [
            'item' => $berita,
            'action' => route('admin.berita.update', $berita),
            'method' => 'PUT',
        ]);
    }

    /**
     * Memperbarui berita.
     */
    public function update(Request $request, Berita $berita)
    {
        $data = $this->validated($request);

        $data['slug'] = $this->slug($data['judul'], $berita->id);

        if ($request->hasFile('thumbnail')) {
            $this->delete($berita->thumbnail);
            $data['thumbnail'] = $this->upload($request);
        }

        $berita->update($data);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Menghapus berita.
     */
    public function destroy(Berita $berita)
    {
        $this->delete($berita->thumbnail);
        $berita->delete();

        return back()->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Validasi data berita.
     * Tanggal hanya boleh hari ini atau tanggal sebelumnya
     * berdasarkan zona waktu Asia/Jakarta.
     */
    private function validated(Request $request): array
    {
        $today = now('Asia/Jakarta')->toDateString();

        return $request->validate([
            'judul' => ['required', 'string', 'max:220'],
            'kategori' => ['required', 'string', 'max:100'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'ringkasan' => ['nullable', 'string', 'max:600'],
            'isi' => ['required', 'string', 'max:30000'],
            'penulis' => ['nullable', 'string', 'max:120'],
            'tanggal' => [
                'required',
                'date_format:Y-m-d',
                'before_or_equal:' . $today,
            ],
            'status' => ['required', 'in:draft,published'],
        ], [
            'tanggal.required' => 'Tanggal berita wajib diisi.',
            'tanggal.date_format' => 'Format tanggal berita tidak valid.',
            'tanggal.before_or_equal' => 'Tanggal berita tidak boleh melebihi hari ini.',
        ]);
    }

    /**
     * Membuat slug unik.
     */
    private function slug(string $title, ?int $ignore = null): string
    {
        $base = Str::slug($title) ?: 'berita';
        $slug = $base;
        $number = 2;

        while (
            Berita::where('slug', $slug)
                ->when($ignore, fn ($query) => $query->where('id', '!=', $ignore))
                ->exists()
        ) {
            $slug = $base . '-' . $number++;
        }

        return $slug;
    }

    /**
     * Upload thumbnail berita.
     */
    private function upload(Request $request): ?string
    {
        return $request->hasFile('thumbnail')
            ? $request->file('thumbnail')->store('berita', 'public')
            : null;
    }

    /**
     * Menghapus thumbnail yang tersimpan di storage.
     */
    private function delete(?string $path): void
    {
        if ($path && !Str::startsWith($path, 'assets/')) {
            Storage::disk('public')->delete($path);
        }
    }
}
