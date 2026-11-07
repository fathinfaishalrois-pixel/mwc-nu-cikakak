<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;

class OrganisasiPageController extends Controller
{
    public function index()
    {
        $organisasi = Organisasi::orderBy('jenis')->orderBy('nama')->get()->groupBy(function ($item) {
            return $item->jenis ?: 'Lainnya';
        });

        return view('public.organisasi.index', compact('organisasi'));
    }
}
