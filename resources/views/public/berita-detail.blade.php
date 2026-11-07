@extends('layouts.app')
@section('title',$berita->judul.' — MWC NU Cikakak')
@section('content')
<article class="article-page section-pad"><div class="container article-narrow"><span class="tag">{{ $berita->kategori }}</span><h1>{{ $berita->judul }}</h1><div class="article-meta">{{ $berita->tanggal->translatedFormat('d F Y') }} · {{ $berita->penulis }}</div><div class="article-image"><x-media :path="$berita->thumbnail" :alt="$berita->judul" loading="eager"/></div><p class="lead">{{ $berita->ringkasan }}</p><div class="article-body">{!! nl2br(e($berita->isi)) !!}</div><a class="btn btn-ghost" href="{{ route('berita.index') }}">← Semua berita</a></div></article>
@endsection
