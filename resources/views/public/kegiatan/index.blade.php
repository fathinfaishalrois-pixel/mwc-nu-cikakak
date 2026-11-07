@extends('layouts.app')

@section('title', 'Kegiatan — MWC NU Cikakak')

@section('content')
<section class="page-hero section-pad">
    <div class="container">
        <span class="eyebrow">04 — Kegiatan</span>
        <h1>Kegiatan MWC NU Cikakak</h1>
        <p>Geser kartu di perangkat mobile, lalu ketuk kartu kegiatan untuk membuka detail dalam popup.</p>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="carousel carousel-fade agenda-page-carousel" data-carousel>
            <button class="carousel-btn prev" data-carousel-prev type="button" aria-label="Kegiatan sebelumnya">←</button>
            <div class="carousel-track" data-carousel-track>
                @forelse ($kegiatan as $item)
                    <button class="content-card carousel-item carousel-card" type="button" data-modal-open="kegiatan-page-{{ $item->id }}" aria-label="Buka detail {{ $item->nama }}">
                        <span class="media-frame"><x-media :path="$item->foto" :alt="$item->nama" /></span>
                        <span class="card-body">
                            <span class="tag">{{ $item->tanggal->translatedFormat('d M Y') }} @if($item->lokasi) · {{ $item->lokasi }} @endif</span>
                            <strong class="card-title">{{ $item->nama }}</strong>
                            <span class="card-summary">{{ $item->ringkasan }}</span>
                            <span class="text-link">Lihat detail ↗</span>
                        </span>
                    </button>
                @empty
                    <div class="empty-state">Belum ada kegiatan yang dipublikasikan.</div>
                @endforelse
            </div>
            <button class="carousel-btn next" data-carousel-next type="button" aria-label="Kegiatan berikutnya">→</button>
        </div>
    </div>
</section>

<section class="section-pad content-list-section" aria-labelledby="kegiatan-list-title">
    <div class="container">
        <div class="section-heading section-row"><div><span class="eyebrow">Dokumentasi & cerita</span><h2 id="kegiatan-list-title">Jelajahi kegiatan</h2><p>Pilih kartu untuk melihat dokumentasi dan penjelasan kegiatan secara lengkap.</p></div></div>
        <div class="content-card-grid">
            @forelse($kegiatan as $item)
                <button class="content-card content-list-card" type="button" data-modal-open="kegiatan-page-{{ $item->id }}" aria-label="Lihat kegiatan {{ $item->nama }}">
                    <span class="media-frame"><x-media :path="$item->foto" :alt="$item->nama" /></span>
                    <span class="card-body"><span class="tag">{{ $item->tanggal->translatedFormat('d M Y') }} @if($item->lokasi) · {{ $item->lokasi }} @endif</span><strong class="card-title">{{ $item->nama }}</strong><span class="card-summary">{{ $item->ringkasan }}</span><span class="text-link">Lihat penjelasan →</span></span>
                </button>
            @empty
                <div class="empty-state">Belum ada kegiatan yang dipublikasikan.</div>
            @endforelse
        </div>
    </div>
</section>

@foreach($kegiatan as $item)
<div class="modal" id="kegiatan-page-{{ $item->id }}" data-modal role="dialog" aria-modal="true" aria-labelledby="kegiatan-page-title-{{ $item->id }}" hidden>
    <div class="modal-backdrop" data-modal-close></div>
    <div class="modal-dialog modal-dialog-article">
        <button class="modal-close" type="button" data-modal-close aria-label="Tutup">×</button>
        <div class="modal-article-image"><x-media :path="$item->foto" :alt="$item->nama" loading="eager" /></div>
        <span class="tag">{{ $item->tanggal->translatedFormat('d F Y') }}</span>
        <h2 id="kegiatan-page-title-{{ $item->id }}">{{ $item->nama }}</h2>
        <p class="article-meta">{{ $item->waktu ?: 'Waktu menyesuaikan' }} @if($item->lokasi) · {{ $item->lokasi }} @endif</p>
        <p class="lead">{{ $item->ringkasan }}</p>
        <div class="article-body">{!! nl2br(e($item->deskripsi)) !!}</div>
        <div class="modal-actions">
            <a class="btn btn-primary" href="{{ route('kegiatan.show', $item->slug) }}">Buka halaman kegiatan</a>
        </div>
    </div>
</div>
@endforeach
@endsection
