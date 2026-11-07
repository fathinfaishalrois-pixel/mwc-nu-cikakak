<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WargaNu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WargaNuController extends Controller
{
    public function index(Request $request)
    {
        $warga = WargaNu::query()
            ->when($request->filled('q'), function ($q) use ($request) {
                $term = $request->string('q');
                $q->where(function ($qq) use ($term) {
                    $qq->where('nama', 'like', "%{$term}%")
                        ->orWhere('nik', 'like', "%{$term}%")
                        ->orWhere('desa', 'like', "%{$term}%");
                });
            })
            ->when($request->filled('status'), fn ($q) => $q->where('verification_status', $request->string('status')))
            ->orderByRaw("CASE verification_status WHEN 'pending' THEN 0 WHEN 'rejected' THEN 1 ELSE 2 END")
            ->orderBy('nama')
            ->paginate(20)
            ->withQueryString();

        return view('admin.warga-nu.index', compact('warga'));
    }

    public function create()
    {
        return view('admin.warga-nu.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('warga-nu', 'public');
        }

        $data['verification_status'] = 'approved';
        $data['card_code'] = $this->newCardCode();
        $data['profile_token'] = hash('sha256', Str::random(64));

        WargaNu::create($data);

        return redirect()->route('admin.warga-nu.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function edit(WargaNu $wargaNu)
    {
        return view('admin.warga-nu.edit', compact('wargaNu'));
    }

    public function update(Request $request, WargaNu $wargaNu)
    {
        $data = $this->validated($request, $wargaNu->id);

        if ($request->hasFile('foto')) {
            $this->deleteFile($wargaNu->foto);
            $data['foto'] = $request->file('foto')->store('warga-nu', 'public');
        }

        $wargaNu->update($data);

        return redirect()->route('admin.warga-nu.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(WargaNu $wargaNu)
    {
        $this->deleteFile($wargaNu->foto);
        $wargaNu->delete();

        return back()->with('success', 'Data warga berhasil dihapus.');
    }

    public function approve(WargaNu $wargaNu)
    {
        $wargaNu->update(['verification_status' => 'approved', 'status' => 'aktif', 'rejection_reason' => null]);
        return back()->with('success', 'Anggota disetujui. Kartu sekarang berstatus aktif.');
    }

    public function reject(Request $request, WargaNu $wargaNu)
    {
        $data = $request->validate(['rejection_reason' => ['required', 'string', 'max:1000']]);
        $wargaNu->update(['verification_status' => 'rejected', 'status' => 'tidak_aktif', 'rejection_reason' => $data['rejection_reason']]);
        return back()->with('success', 'Pendaftaran ditolak dan alasannya disimpan.');
    }

    public function deactivate(WargaNu $wargaNu)
    {
        $wargaNu->update(['status' => 'tidak_aktif']);
        return back()->with('success', 'Kartu/keanggotaan dinonaktifkan.');
    }

    private function newCardCode(): string
    {
        do {
            $code = 'MWC-'.strtoupper(Str::random(3)).'-'.strtoupper(Str::random(4));
        } while (WargaNu::where('card_code', $code)->exists());

        return $code;
    }

    private function deleteFile(?string $path): void
    {
        if ($path && ! Str::startsWith($path, 'assets/')) {
            Storage::disk('public')->delete($path);
        }
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['nullable', 'string', 'max:32', 'unique:warga_nu,nik'.($ignoreId ? ",{$ignoreId}" : '')],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'alamat' => ['nullable', 'string'],
            'dusun' => ['nullable', 'string', 'max:255'],
            'desa' => ['nullable', 'string', 'max:255'],
            'no_hp' => ['nullable', 'string', 'max:30'],
            'pekerjaan' => ['nullable', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'in:aktif,tidak_aktif'],
        ]);
    }
}
