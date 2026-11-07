<?php

namespace App\Http\Controllers;

use App\Models\Agenda;

class AgendaPageController extends Controller
{
    public function index()
    {
        $mendatang = Agenda::whereDate('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal')
            ->get();

        $lewat = Agenda::whereDate('tanggal', '<', now()->toDateString())
            ->orderByDesc('tanggal')
            ->paginate(10);

        return view('public.agenda', compact('mendatang', 'lewat'));
    }
}
