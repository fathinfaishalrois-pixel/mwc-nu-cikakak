@extends('layouts.app')
@section('title','Kegiatan MWC NU Cikakak')
@section('content')
<section class="page-hero section-pad"><div class="container"><span class="eyebrow">04 — Kegiatan</span><h1>Agenda yang membuat<br>silaturahmi <span>bergerak.</span></h1><p>Geser kartu untuk melihat agenda lainnya, lalu klik “Lihat detail” untuk membuka halaman kegiatan.</p></div></section>
<section class="section-pad">
    <div class="container">
        <div class="carousel activity-carousel" data-carousel aria-label="Carousel kegiatan terbaru">
            <button class="carousel-btn prev" data-carousel-prev type="button" aria-label="Kegiatan sebelumnya">←</button>
            <div class="carousel-track" data-carousel-track>
                @forelse($kegiatan as $item)
                    @php($url = route('kegiatan.show', $item->slug))
                    <article class="content-card carousel-item activity-card">
                        <a class="activity-card-media" href="{{ $url }}" tabindex="-1" aria-hidden="true">
                            <x-media :path="$item->foto" :alt="$item->nama" />
                        </a>
                        <div class="activity-card-body">
                            <span class="tag">{{ $item->tanggal->translatedFormat('d M Y') }}@if($item->lokasi) · {{ $item->lokasi }}@endif</span>
                            <h2 class="activity-card-title"><a href="{{ $url }}">{{ $item->nama }}</a></h2>
                            @if($item->ringkasan)<p class="activity-card-summary">{{ $item->ringkasan }}</p>@endif
                            <a class="text-link" href="{{ $url }}">Lihat detail <span aria-hidden="true">→</span></a>
                        </div>
                    </article>
                @empty
                    <div class="empty-state">Belum ada kegiatan yang dipublikasikan.</div>
                @endforelse
            </div>
            <button class="carousel-btn next" data-carousel-next type="button" aria-label="Kegiatan berikutnya">→</button>
        </div>
    </div>
</section>
@endsection
