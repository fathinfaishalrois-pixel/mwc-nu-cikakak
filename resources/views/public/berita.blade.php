@extends('layouts.app')
@section('title','Berita MWC NU Cikakak')
@section('content')
<section class="page-hero section-pad"><div class="container"><span class="eyebrow">03 — Berita</span><h1>Catatan kecil dari<br><span>perjalanan</span> organisasi.</h1><p>Geser kartu berita dan klik salah satu untuk membaca isi lengkap tanpa meninggalkan halaman.</p></div></section>
<section class="section-pad soft-section"><div class="container"><div class="carousel carousel-fade news-carousel" data-carousel><button class="carousel-btn prev" data-carousel-prev aria-label="Berita sebelumnya">←</button><div class="carousel-track" data-carousel-track>@forelse($berita as $item)<button class="content-card carousel-item carousel-card" type="button" data-modal-open="berita-page-{{ $item->id }}"><span class="media-frame"><x-media :path="$item->thumbnail" :alt="$item->judul" /></span><span class="card-body"><span class="tag">{{ $item->kategori }}</span><strong class="card-title">{{ $item->judul }}</strong><time>{{ $item->tanggal->translatedFormat('d M Y') }}</time><span class="card-summary">{{ $item->ringkasan }}</span><span class="text-link">Baca selengkapnya →</span></span></button>@empty<div class="empty-state">Belum ada berita yang dipublikasikan.</div>@endforelse</div><button class="carousel-btn next" data-carousel-next aria-label="Berita berikutnya">→</button></div></div></section>
<section class="section-pad content-list-section" aria-labelledby="berita-list-title">
    <div class="container">
        <div class="section-heading section-row"><div><span class="eyebrow">Arsip informasi</span><h2 id="berita-list-title">Berita terbaru</h2><p>Pilih kartu untuk membaca berita selengkapnya tanpa meninggalkan halaman.</p></div></div>
        <div class="content-card-grid">
            @forelse($berita as $item)
                <button class="content-card content-list-card" type="button" data-modal-open="berita-page-{{ $item->id }}" aria-label="Baca berita {{ $item->judul }}">
                    <span class="media-frame"><x-media :path="$item->thumbnail" :alt="$item->judul" /></span>
                    <span class="card-body"><span class="tag">{{ $item->kategori }}</span><strong class="card-title">{{ $item->judul }}</strong><time>{{ $item->tanggal->translatedFormat('d M Y') }}</time><span class="card-summary">{{ $item->ringkasan }}</span><span class="text-link">Baca berita →</span></span>
                </button>
            @empty
                <div class="empty-state">Belum ada berita yang dipublikasikan.</div>
            @endforelse
        </div>
    </div>
</section>
@foreach($berita as $item)<div class="modal" id="berita-page-{{ $item->id }}" data-modal role="dialog" aria-modal="true" aria-labelledby="berita-page-title-{{ $item->id }}" hidden><div class="modal-backdrop" data-modal-close></div><div class="modal-dialog modal-dialog-article"><button class="modal-close" type="button" data-modal-close aria-label="Tutup">×</button><div class="modal-article-image"><x-media :path="$item->thumbnail" :alt="$item->judul" loading="eager" /></div><span class="tag">{{ $item->kategori }} · {{ $item->tanggal->translatedFormat('d F Y') }}</span><h2 id="berita-page-title-{{ $item->id }}">{{ $item->judul }}</h2>@if($item->penulis)<p class="article-meta">Ditulis oleh {{ $item->penulis }}</p>@endif<p class="lead">{{ $item->ringkasan }}</p><div class="article-body">@if(trim((string) $item->isi) !== ''){!! nl2br(e($item->isi)) !!}@else<p>{{ $item->ringkasan ?: 'Informasi lengkap berita ini akan diperbarui oleh pengurus.' }}</p>@endif</div><div class="modal-actions"><a class="btn btn-primary" href="{{ route('berita.show', $item->slug) }}">Buka halaman berita</a></div></div></div>@endforeach
@endsection
