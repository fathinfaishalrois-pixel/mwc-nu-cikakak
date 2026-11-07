<?php

namespace App\Http\Controllers;

use App\Models\WargaNu;

class WargaNuPageController extends Controller
{
    public function index()
    {
        $totalAktif = WargaNu::where('status', 'aktif')->count();
        $totalDesa = WargaNu::whereNotNull('desa')->distinct('desa')->count('desa');

        $perDesa = WargaNu::selectRaw('desa, count(*) as jumlah')
            ->whereNotNull('desa')
            ->where('status', 'aktif')
            ->groupBy('desa')
            ->orderByDesc('jumlah')
            ->get();

        return view('public.warga-nu', compact('totalAktif', 'totalDesa', 'perDesa'));
    }
}
