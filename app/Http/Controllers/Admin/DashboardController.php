<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Kegiatan;
use App\Models\Organisasi;
use App\Models\Pengurus;
use App\Models\WargaNu;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'counts' => [
                'pengurus' => Pengurus::count(),
                'berita' => Berita::count(),
                'kegiatan' => Kegiatan::count(),
                'agenda' => Agenda::count(),
                'galeri' => Galeri::count(),
                'organisasi' => Organisasi::count(),
                'warga-nu' => WargaNu::count(),
                'pendaftar-menunggu' => WargaNu::where('verification_status', 'pending')->count(),
            ],
            'berita' => Berita::latest('tanggal')->take(5)->get(),
            'kegiatan' => Kegiatan::latest('tanggal')->take(5)->get(),
        ]);
    }
}
