<?php
namespace App\Http\Controllers;
use App\Models\Berita;
class PublicBeritaController extends Controller
{
    public function index() { return view('public.berita', ['berita' => Berita::where('status','published')->latest('tanggal')->get()]); }
    public function show(string $slug) { return view('public.berita-detail', ['berita' => Berita::where('status','published')->where('slug',$slug)->firstOrFail()]); }
}
