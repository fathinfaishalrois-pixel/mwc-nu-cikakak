@extends('layouts.app')
@section('title','MWC NU Cikakak | Desa Cikakak, Wangon, Banyumas')
@section('content')
<section class="hero section-pad">
 <div class="nu-depth-grid" aria-hidden="true">
  <div class="nu-grid-lines"></div>
  <div class="nu-logo-drift draggable" data-nu-drift>
   <span class="nu-logo-mark">NU</span>
   <span class="nu-logo-ring"></span>
  </div>
  <div class="nu-grid-dot dot-a"></div><div class="nu-grid-dot dot-b"></div><div class="nu-grid-dot dot-c"></div>
 </div>
 <div class="container hero-grid">
  <div class="hero-copy" data-reveal><span class="eyebrow">Desa Cikakak · Kecamatan Wangon</span><h1>Merawat tradisi,<br><span>menguatkan</span> kebersamaan.</h1><p>MWC NU Cikakak hadir sebagai ruang koordinasi, pelayanan, dan pengembangan kegiatan kemasyarakatan yang tumbuh bersama warga.</p><div class="hero-actions"><a class="btn btn-primary" href="{{ route('pengurus.index') }}">Lihat kepengurusan <span>↗</span></a><a class="btn btn-ghost" href="{{ route('kegiatan.index') }}">Jelajahi kegiatan</a></div><div class="hero-meta"><span><b>01</b> Organisasi</span><span><b>02</b> Pelayanan</span><span><b>03</b> Kolaborasi</span></div></div>
  <div class="hero-art" data-reveal><div class="orb orb-a"></div><div class="orb orb-b"></div><div class="hero-panel"><span class="mini-label">MWC NU Cikakak</span><div class="hero-emblem">نُو</div><h3>Ruang khidmat yang dekat dengan warga.</h3><p>Informasi kepengurusan, program, berita, dan dokumentasi dalam satu ruang digital.</p><div class="hero-location">⌖ Banyumas, Jawa Tengah</div></div></div>
 </div>
</section>
<section class="marquee-strip"><div>KHIDMAT <span>•</span> SILATURAHMI <span>•</span> PEMBERDAYAAN <span>•</span> PENDIDIKAN <span>•</span> KOLABORASI <span>•</span> KHIDMAT <span>•</span></div></section>
<section class="section-pad intro-section"><div class="container split-grid"><div data-reveal><span class="eyebrow">01 — Tentang</span><h2 class="display">Organisasi yang tumbuh dari <em>kedekatan.</em></h2></div><div data-reveal><p class="lead">Website ini menjadi ruang informasi MWC NU Cikakak: memperkenalkan struktur pengurus, mendokumentasikan kegiatan, dan membuka akses informasi organisasi secara lebih rapi.</p><a class="text-link" href="{{ route('tentang') }}">Kenali MWC NU Cikakak <span>→</span></a></div></div></section>
<section class="section-pad soft-section"><div class="container"><x-section-heading eyebrow="02 — Nilai" title="Visi dan misi" text="Arah sederhana untuk menjaga organisasi tetap relevan, tertib, dan dekat dengan masyarakat."/><div class="vision-grid"><article class="vision-card vision-main" data-reveal><span>VISI</span><h3>Menjadi ruang khidmat yang adaptif, terpercaya, dan bermanfaat bagi masyarakat.</h3><div class="number">01</div></article><article class="mission-list" data-reveal><div><b>01</b><p>Menguatkan koordinasi pengurus dan komunikasi yang terbuka.</p></div><div><b>02</b><p>Mendorong pendidikan, kaderisasi, dan kegiatan sosial yang inklusif.</p></div><div><b>03</b><p>Mendokumentasikan program agar mudah diakses dan diteruskan.</p></div></article></div></div></section>
<section class="section-pad"><div class="container"><div class="section-row"><x-section-heading eyebrow="03 — Kepengurusan" title="Orang-orang di balik khidmat." text="Struktur dibuat bertingkat seperti referensi. Klik setiap kartu untuk membuka biodata lengkap."/><a class="btn btn-ghost" href="{{ route('pengurus.index') }}">Lihat struktur lengkap</a></div><div class="people-grid">@foreach($pengurus->take(6) as $p)<button class="person-card" type="button" data-modal-open="person-{{ $p->id }}" data-reveal><span class="person-photo"><x-media :path="$p->foto" :alt="$p->nama" /></span><span class="person-info"><strong>{{ $p->nama }}</strong><small>{{ $p->jabatan }}</small><em>{{ $p->bidang }}</em></span><span class="person-link">Lihat biodata ↗</span></button>@endforeach</div></div></section>
<section class="section-pad soft-section"><div class="container"><div class="section-row"><x-section-heading eyebrow="04 — Berita" title="Cerita yang sedang berjalan." text="Geser kartu untuk melihat berita lainnya. Kartu di tepi otomatis dibuat lebih lembut agar fokus berada di tengah."/><a class="text-link" href="{{ route('berita.index') }}">Semua berita →</a></div><div class="carousel carousel-fade news-carousel" data-carousel><button class="carousel-btn prev" data-carousel-prev aria-label="Berita sebelumnya">←</button><div class="carousel-track" data-carousel-track>@foreach($berita as $item)<button class="content-card carousel-item carousel-card news-card" type="button" data-modal-open="berita-{{ $item->id }}" data-news-trigger data-reveal><span class="media-frame"><x-media :path="$item->thumbnail" :alt="$item->judul" /></span><span class="card-body"><span class="tag">{{ $item->kategori }}</span><strong class="card-title">{{ $item->judul }}</strong><time datetime="{{ $item->tanggal->toDateString() }}">{{ $item->tanggal->translatedFormat('d M Y') }}</time><span class="card-summary">{{ $item->ringkasan }}</span><span class="text-link">Baca selengkapnya →</span></span></button>@endforeach</div><button class="carousel-btn next" data-carousel-next aria-label="Berita berikutnya">→</button></div></div></section>
<section class="section-pad"><div class="container"><div class="section-row"><x-section-heading eyebrow="05 — Kegiatan" title="Agenda yang mendekatkan." text="Agenda dummy siap tampil sejak awal. Geser kartu langsung dengan kursor atau sentuhan untuk melihat agenda lainnya."/><a class="text-link" href="{{ route('kegiatan.index') }}">Semua kegiatan →</a></div><div class="carousel carousel-fade agenda-carousel" data-carousel><div class="carousel-track" data-carousel-track>@foreach($kegiatan as $item)<button class="content-card carousel-item carousel-card agenda-card" type="button" data-modal-open="kegiatan-{{ $item->id }}" data-reveal><span class="media-frame"><x-media :path="$item->foto" :alt="$item->nama" /></span><span class="card-body"><span class="tag">{{ $item->tanggal->translatedFormat('d M Y') }} · {{ $item->lokasi }}</span><strong class="card-title">{{ $item->nama }}</strong><span class="card-summary">{{ $item->ringkasan }}</span><span class="text-link">Lihat detail →</span></span></button>@endforeach</div></div></div></section>
<section class="section-pad gallery-preview"><div class="container"><div class="section-row"><x-section-heading eyebrow="06 — Galeri" title="Jejak dalam gambar." text="Semua dokumentasi prototype sudah terisi. Klik kartu untuk membuka detail dalam modal popup."/><a class="text-link" href="{{ route('galeri.index') }}">Buka galeri →</a></div><div class="gallery-grid">@foreach($galeri->take(8) as $g)<button class="gallery-item" type="button" data-modal-open="galeri-{{ $g->id }}" aria-label="Buka dokumentasi {{ $g->judul }}" data-reveal><x-media :path="$g->gambar" :alt="$g->judul" /><span>{{ $g->judul }}</span><small>{{ optional($g->tanggal)->translatedFormat('d F Y') }}</small></button>@endforeach</div></div></section>
<section class="cta-section"><div class="container cta-box" data-reveal><div><span class="eyebrow">Ruang komunikasi</span><h2>Ada cerita atau kegiatan yang ingin disampaikan?</h2><p>Hubungi tim MWC NU Cikakak untuk kebutuhan informasi prototype ini.</p></div><a class="btn btn-light" href="{{ route('kontak') }}">Hubungi kami ↗</a></div></section>

{{-- Modal biodata lengkap pengurus --}}
@foreach($pengurus as $p)
<div class="modal" id="person-{{ $p->id }}" data-modal role="dialog" aria-modal="true" aria-labelledby="person-title-{{ $p->id }}" hidden>
 <div class="modal-backdrop" data-modal-close></div>
 <div class="modal-dialog modal-dialog-profile">
  <button class="modal-close" type="button" data-modal-close aria-label="Tutup">×</button>
  <div class="modal-profile-head"><div class="modal-photo"><x-media :path="$p->foto" :alt="$p->nama" /></div><div><span class="eyebrow">{{ $p->jabatan }}</span><h2 id="person-title-{{ $p->id }}">{{ $p->nama }}</h2><p class="modal-meta">{{ $p->bidang }} · Periode {{ $p->periode }}</p><p class="modal-bio">{{ $p->bio }}</p></div></div>
  <div class="profile-facts profile-facts-public">
   <div><small>Jabatan</small><strong>{{ $p->jabatan }}</strong></div>
   <div><small>Bidang</small><strong>{{ $p->bidang ?: 'Pelayanan organisasi' }}</strong></div>
   <div><small>Periode</small><strong>{{ $p->periode ?: '2026–2031' }}</strong></div>
   <div><small>Pendidikan</small><strong>{{ $p->pendidikan ?: 'Pendidikan keagamaan' }}</strong></div>
   <div><small>Status</small><strong>Pengurus aktif</strong></div>
  </div>
  <div class="modal-description"><span class="eyebrow">Peran & kontribusi</span><p>{{ $p->deskripsi }}</p></div>
 </div>
</div>
@endforeach

{{-- Modal detail berita --}}
@foreach($berita as $item)
<div class="modal" id="berita-{{ $item->id }}" data-modal role="dialog" aria-modal="true" aria-labelledby="berita-title-{{ $item->id }}" hidden>
 <div class="modal-backdrop" data-modal-close></div><div class="modal-dialog modal-dialog-article"><button class="modal-close" type="button" data-modal-close aria-label="Tutup">×</button><div class="modal-article-image"><x-media :path="$item->thumbnail" :alt="$item->judul" loading="eager" /></div><span class="tag">{{ $item->kategori }} · {{ $item->tanggal->translatedFormat('d F Y') }}</span><h2 id="berita-title-{{ $item->id }}">{{ $item->judul }}</h2>@if($item->penulis)<p class="article-meta">Ditulis oleh {{ $item->penulis }}</p>@endif<p class="lead">{{ $item->ringkasan }}</p><div class="article-body">@if(trim((string) $item->isi) !== ''){!! nl2br(e($item->isi)) !!}@else<p>{{ $item->ringkasan ?: 'Informasi lengkap berita ini akan diperbarui oleh pengurus.' }}</p>@endif</div></div></div>
@endforeach


{{-- Modal detail galeri/dokumentasi --}}
@foreach($galeri as $g)
<div class="modal" id="galeri-{{ $g->id }}" data-modal role="dialog" aria-modal="true" aria-labelledby="galeri-title-{{ $g->id }}" hidden>
 <div class="modal-backdrop" data-modal-close></div>
 <div class="modal-dialog modal-dialog-article">
  <button class="modal-close" type="button" data-modal-close aria-label="Tutup">×</button>
  <div class="modal-article-image"><x-media :path="$g->gambar" :alt="$g->judul" loading="eager" /></div>
  <span class="tag">Dokumentasi @if($g->tanggal) · {{ $g->tanggal->translatedFormat('d F Y') }} @endif</span>
  <h2 id="galeri-title-{{ $g->id }}">{{ $g->judul }}</h2>
  @if($g->deskripsi)<p class="lead">{{ $g->deskripsi }}</p>@endif
  <div class="modal-actions"><a class="btn btn-primary" href="{{ route('galeri.show', $g) }}">Buka halaman dokumentasi</a></div>
 </div>
</div>
@endforeach

{{-- Modal detail kegiatan --}}
@foreach($kegiatan as $item)
<div class="modal" id="kegiatan-{{ $item->id }}" data-modal role="dialog" aria-modal="true" aria-labelledby="kegiatan-title-{{ $item->id }}" hidden>
 <div class="modal-backdrop" data-modal-close></div><div class="modal-dialog modal-dialog-article"><button class="modal-close" type="button" data-modal-close aria-label="Tutup">×</button><div class="modal-article-image"><x-media :path="$item->foto" :alt="$item->nama" loading="eager" /></div><span class="tag">{{ $item->tanggal->translatedFormat('d F Y') }}</span><h2 id="kegiatan-title-{{ $item->id }}">{{ $item->nama }}</h2><p class="article-meta">{{ $item->waktu ?: 'Waktu menyesuaikan' }} @if($item->lokasi) · {{ $item->lokasi }} @endif</p><p class="lead">{{ $item->ringkasan }}</p><div class="article-body">@if(trim((string) $item->deskripsi) !== ''){!! nl2br(e($item->deskripsi)) !!}@else<p>{{ $item->ringkasan ?: 'Informasi lengkap kegiatan ini akan diperbarui oleh pengurus.' }}</p>@endif</div></div></div>
@endforeach
@endsection
