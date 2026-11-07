<?php

namespace App\Http\Controllers;

use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index()
    {
        return view('public.galeri', [
            'galeri' => Galeri::where('status', true)->latest('tanggal')->get(),
        ]);
    }

    public function show(Galeri $galeri)
    {
        abort_unless($galeri->status, 404);

        return view('public.galeri.show', compact('galeri'));
    }
}
