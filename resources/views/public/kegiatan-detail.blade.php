@extends('layouts.app')
@section('title',$kegiatan->nama.' — MWC NU Cikakak')
@section('content')
<article class="article-page section-pad"><div class="container article-narrow"><span class="tag">{{ $kegiatan->tanggal->translatedFormat('d F Y') }}</span><h1>{{ $kegiatan->nama }}</h1><div class="article-meta">{{ $kegiatan->waktu }} · {{ $kegiatan->lokasi }}</div><div class="article-image"><x-media :path="$kegiatan->foto" :alt="$kegiatan->nama" loading="eager"/></div><p class="lead">{{ $kegiatan->ringkasan }}</p><div class="article-body">{!! nl2br(e($kegiatan->deskripsi)) !!}</div><a class="btn btn-ghost" href="{{ route('kegiatan.index') }}">← Semua kegiatan</a></div></article>
@endsection
