<?php

namespace App\Http\Controllers;

use App\Models\Infak;
use Illuminate\Http\Request;

class InfakController extends Controller
{
    public function index()
    {
        $totalTerkumpul = Infak::terverifikasi()->sum('jumlah');
        $totalDonatur = Infak::terverifikasi()->count();

        $rekapDesa = Infak::terverifikasi()
            ->selectRaw('desa, sum(jumlah) as total')
            ->whereNotNull('desa')
            ->groupBy('desa')
            ->orderByDesc('total')
            ->take(8)
            ->get();

        $riwayat = Infak::terverifikasi()->latest()->take(10)->get();

        return view('public.infak.index', compact('totalTerkumpul', 'totalDonatur', 'rekapDesa', 'riwayat'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'program' => ['required', 'in:koin_nu,infak_umum'],
            'nama_donatur' => ['required', 'string', 'max:255'],
            'no_hp' => ['nullable', 'string', 'max:30'],
            'dusun' => ['nullable', 'string', 'max:255'],
            'desa' => ['nullable', 'string', 'max:255'],
            'jumlah' => ['required', 'integer', 'min:1000'],
            'metode' => ['required', 'in:tunai,transfer,qris'],
            'catatan' => ['nullable', 'string', 'max:1000'],
            'bukti' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('bukti')) {
            $data['bukti'] = $request->file('bukti')->store('infak', 'public');
        }

        Infak::create($data);

        return back()->with('success', 'Terima kasih, laporan infak/koin NU Anda telah kami terima dan akan diverifikasi oleh pengurus.');
    }
}
