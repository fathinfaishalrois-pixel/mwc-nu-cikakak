<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;

class StrukturController extends Controller
{
    public function index()
    {
        $pengurus = Pengurus::orderBy('urutan')->orderBy('id')->get();

        return view('public.struktur', compact('pengurus'));
    }
}
