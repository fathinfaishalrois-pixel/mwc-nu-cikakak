<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrganisasiController extends Controller
{
    public function index()
    {
        $organisasi = Organisasi::orderBy('jenis')->orderBy('nama')->paginate(20);

        return view('admin.organisasi.index', compact('organisasi'));
    }

    public function create()
    {
        return view('admin.organisasi.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('organisasi', 'public');
        }

        Organisasi::create($data);

        return redirect()->route('admin.organisasi.index')->with('success', 'Data lembaga/banom berhasil ditambahkan.');
    }

    public function edit(Organisasi $organisasi)
    {
        return view('admin.organisasi.edit', compact('organisasi'));
    }

    public function update(Request $request, Organisasi $organisasi)
    {
        $data = $this->validated($request);

        if ($request->hasFile('logo')) {
            $this->deleteFile($organisasi->logo);
            $data['logo'] = $request->file('logo')->store('organisasi', 'public');
        }

        $organisasi->update($data);

        return redirect()->route('admin.organisasi.index')->with('success', 'Data lembaga/banom berhasil diperbarui.');
    }

    public function destroy(Organisasi $organisasi)
    {
        $this->deleteFile($organisasi->logo);
        $organisasi->delete();

        return back()->with('success', 'Data lembaga/banom berhasil dihapus.');
    }

    private function deleteFile(?string $path): void
    {
        if ($path && ! Str::startsWith($path, 'assets/')) {
            Storage::disk('public')->delete($path);
        }
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jenis' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'ketua' => ['nullable', 'string', 'max:255'],
            'link' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);
    }
}
