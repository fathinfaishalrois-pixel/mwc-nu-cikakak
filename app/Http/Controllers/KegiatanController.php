<?php
namespace App\Http\Controllers;
use App\Models\Kegiatan;
class KegiatanController extends Controller
{
    public function index() { return view('public.kegiatan', ['kegiatan' => Kegiatan::where('status','published')->latest('tanggal')->get()]); }
    public function show(string $slug) { return view('public.kegiatan-detail', ['kegiatan' => Kegiatan::where('status','published')->where('slug',$slug)->firstOrFail()]); }
}
