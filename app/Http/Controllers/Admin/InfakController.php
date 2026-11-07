<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Infak;
use Illuminate\Http\Request;

class InfakController extends Controller
{
    public function index(Request $request)
    {
        $infak = Infak::query()
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->string('status')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $totalTerkumpul = Infak::terverifikasi()->sum('jumlah');
        $totalPending = Infak::where('status', 'pending')->count();

        return view('admin.infak.index', compact('infak', 'totalTerkumpul', 'totalPending'));
    }

    public function verify(Infak $infak)
    {
        $infak->update(['status' => 'terverifikasi']);

        return back()->with('success', 'Laporan infak/koin NU berhasil diverifikasi.');
    }

    public function destroy(Infak $infak)
    {
        $infak->delete();

        return back()->with('success', 'Data infak/koin NU berhasil dihapus.');
    }
}
