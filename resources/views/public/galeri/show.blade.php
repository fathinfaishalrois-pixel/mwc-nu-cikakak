@extends('layouts.app')

@section('title', $galeri->judul . ' — MWC NU Cikakak')

@section('content')
<article class="article-page section-pad">
    <div class="container article-narrow">
        <span class="tag">Dokumentasi @if($galeri->tanggal) · {{ $galeri->tanggal->translatedFormat('d F Y') }} @endif</span>
        <h1>{{ $galeri->judul }}</h1>

        @if ($galeri->gambar)
            <div class="article-image">
                <x-media :path="$galeri->gambar" :alt="$galeri->judul" loading="eager" />
            </div>
        @endif

        <p class="lead">{{ $galeri->deskripsi ?: 'Dokumentasi kegiatan MWC NU Cikakak, Desa Cikakak, Kecamatan Wangon, Kabupaten Banyumas.' }}</p>

        <a class="btn btn-ghost" href="{{ route('galeri.index') }}">← Kembali ke Galeri</a>
    </div>
</article>
@endsection
