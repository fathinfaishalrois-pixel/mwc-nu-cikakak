<?php
namespace App\Http\Controllers;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Kegiatan;
use App\Models\Pengurus;
class HomeController extends Controller
{
    public function __invoke()
    {
        return view('public.home', [
            'pengurus' => Pengurus::where('status', true)->orderBy('urutan')->orderBy('nama')->get(),
            'berita' => Berita::where('status', 'published')->latest('tanggal')->take(9)->get(),
            'kegiatan' => Kegiatan::where('status', 'published')->latest('tanggal')->take(9)->get(),
            'galeri' => Galeri::where('status', true)->latest('tanggal')->take(10)->get(),
        ]);
    }
}
