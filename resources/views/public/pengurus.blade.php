@extends('layouts.app')
@section('title','Kepengurusan MWC NU Cikakak')
@section('content')
<section class="page-hero section-pad">
    <div class="container">
        <span class="eyebrow">02 — Struktur</span>
        <h1>Struktur yang jelas,<br><span>amanah</span> yang terhubung.</h1>
        <p>Komposisi visual mengikuti referensi: 1 pimpinan → 2 pengurus inti → 3 koordinator → 9 anggota. Klik kartu mana pun untuk membuka biodata lengkap.</p>
    </div>
</section>

<section class="section-pad org-section">
    <div class="container">
        <div class="org-stage" data-reveal>
            @if($root)
                <div class="org-level org-level-root">
                    <div class="org-node org-node-root" data-reveal style="--delay:40ms">
                        <button class="person-card org-card org-root-card" type="button" data-modal-open="person-{{ $root->id }}" aria-label="Lihat profil {{ $root->nama }}">
                            <span class="person-photo"><x-media :path="$root->foto" :alt="$root->nama" /></span>
                            <span class="person-info"><strong>{{ $root->nama }}</strong><small>{{ $root->jabatan }}</small><em>{{ $root->bidang }}</em></span>
                            <span class="person-link">Lihat biodata ↗</span>
                        </button>
                    </div>
                </div>

                <div class="org-connector org-connector-main" aria-hidden="true"></div>

                <div class="org-level org-level-two">
                    <div class="org-rail" aria-hidden="true"></div>
                    @foreach($level2 as $p)
                        <div class="org-node org-node-two" data-reveal style="--delay:{{ 100 + ($loop->index * 90) }}ms">
                            <span class="org-branch" aria-hidden="true"></span>
                            <button class="person-card org-card" type="button" data-modal-open="person-{{ $p->id }}" aria-label="Lihat profil {{ $p->nama }}">
                                <span class="person-photo"><x-media :path="$p->foto" :alt="$p->nama" /></span>
                                <span class="person-info"><strong>{{ $p->nama }}</strong><small>{{ $p->jabatan }}</small><em>{{ $p->bidang }}</em></span>
                                <span class="person-link">Lihat biodata ↗</span>
                            </button>
                        </div>
                    @endforeach
                </div>

                <div class="org-connector org-connector-main" aria-hidden="true"></div>

                <div class="org-level org-level-three">
                    <div class="org-rail" aria-hidden="true"></div>
                    @foreach($level3 as $p)
                        <div class="org-node org-node-three" data-reveal style="--delay:{{ 250 + ($loop->index * 70) }}ms">
                            <span class="org-branch" aria-hidden="true"></span>
                            <button class="person-card org-card" type="button" data-modal-open="person-{{ $p->id }}" aria-label="Lihat profil {{ $p->nama }}">
                                <span class="person-photo"><x-media :path="$p->foto" :alt="$p->nama" /></span>
                                <span class="person-info"><strong>{{ $p->nama }}</strong><small>{{ $p->jabatan }}</small><em>{{ $p->bidang }}</em></span>
                                <span class="person-link">Lihat biodata ↗</span>
                            </button>
                        </div>
                    @endforeach
                </div>

                <div class="org-connector org-connector-main" aria-hidden="true"></div>

                <div class="org-level org-level-four">
                    @foreach($level4 as $p)
                        <div class="org-node org-node-four" data-reveal style="--delay:{{ 420 + ($loop->index * 45) }}ms">
                            <span class="org-branch" aria-hidden="true"></span>
                            <button class="person-card org-card" type="button" data-modal-open="person-{{ $p->id }}" aria-label="Lihat profil {{ $p->nama }}">
                                <span class="person-photo"><x-media :path="$p->foto" :alt="$p->nama" /></span>
                                <span class="person-info"><strong>{{ $p->nama }}</strong><small>{{ $p->jabatan }}</small><em>{{ $p->bidang }}</em></span>
                                <span class="person-link">Lihat biodata ↗</span>
                            </button>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">Belum ada data kepengurusan aktif.</div>
            @endif
        </div>
        <div class="org-hint" data-reveal>✦ Klik setiap kartu untuk membuka biodata lengkap · geser horizontal bila layar sempit</div>
    </div>
</section>

@foreach($items as $p)
<div class="modal" id="person-{{ $p->id }}" data-modal role="dialog" aria-modal="true" aria-labelledby="person-title-{{ $p->id }}" hidden>
 <div class="modal-backdrop" data-modal-close></div>
 <div class="modal-dialog modal-dialog-profile">
  <button class="modal-close" type="button" data-modal-close aria-label="Tutup">×</button>
  <div class="modal-profile-head">
   <div class="modal-photo"><x-media :path="$p->foto" :alt="$p->nama" /></div>
   <div><span class="eyebrow">{{ $p->jabatan }}</span><h2 id="person-title-{{ $p->id }}">{{ $p->nama }}</h2><p class="modal-meta">{{ $p->bidang }} · Periode {{ $p->periode }}</p><p class="modal-bio">{{ $p->bio }}</p></div>
  </div>
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
@endsection
