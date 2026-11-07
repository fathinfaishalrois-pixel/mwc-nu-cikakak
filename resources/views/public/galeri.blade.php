@extends('layouts.app')
@section('title','Galeri MWC NU Cikakak')
@section('content')
<section class="page-hero section-pad"><div class="container"><span class="eyebrow">05 — Dokumentasi</span><h1>Jejak kegiatan,<br><span>dalam gambar.</span></h1><p>Pilih foto atau “Lihat foto &amp; detail” untuk membuka halaman dokumentasi.</p></div></section>
<section class="section-pad">
    <div class="container">
        <div class="photo-grid" aria-label="Galeri dokumentasi">
            @forelse($galeri as $g)
                @php($url = route('galeri.show', $g))
                <article class="photo-card">
                    <a class="photo-card-media" href="{{ $url }}" tabindex="-1" aria-hidden="true">
                        <x-media :path="$g->gambar" :alt="$g->judul" loading="lazy" />
                    </a>
                    <div class="photo-card-body">
                        <h2 class="photo-card-title"><a href="{{ $url }}">{{ $g->judul }}</a></h2>
                        <time class="photo-card-date">@if($g->tanggal){{ $g->tanggal->translatedFormat('d F Y') }}@else Dokumentasi MWC NU Cikakak @endif</time>
                        <a class="text-link" href="{{ $url }}">Lihat foto &amp; detail <span aria-hidden="true">↗</span></a>
                    </div>
                </article>
            @empty
                <div class="empty-state">Belum ada dokumentasi yang dipublikasikan.</div>
            @endforelse
        </div>
    </div>
</section>
@endsection
