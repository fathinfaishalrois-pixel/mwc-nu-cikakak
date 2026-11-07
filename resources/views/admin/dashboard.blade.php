@extends('layouts.admin')
@section('title','Dashboard Admin — MWC NU Cikakak')
@section('heading','Dashboard')
@section('content')
<div class="stats-grid">
@php
$statRoutes = ['pengurus'=>'admin.pengurus.index','berita'=>'admin.berita.index','kegiatan'=>'admin.kegiatan.index','agenda'=>'admin.agenda.index','galeri'=>'admin.galeri.index','organisasi'=>'admin.organisasi.index','warga-nu'=>'admin.warga-nu.index'];
@endphp
@foreach($counts as $key=>$value)
@if(isset($statRoutes[$key]))
<a class="stat-card" href="{{ route($statRoutes[$key]) }}"><span>{{ $key === 'warga-nu' ? 'Warga NU' : ucfirst($key) }}</span><strong>{{ $value }}</strong><em>Kelola →</em></a>
@endif
@endforeach
</div>
<div class="admin-grid-two">
<section class="admin-panel"><div class="panel-head"><h2>Berita terbaru</h2><a href="{{ route('admin.berita.create') }}">+ Tambah</a></div>@forelse($berita as $item)<div class="admin-list-row"><div><strong>{{ $item->judul }}</strong><small>{{ $item->tanggal->translatedFormat('d M Y') }} · {{ $item->status }}</small></div><a href="{{ route('admin.berita.edit',$item) }}">Edit</a></div>@empty<p class="muted">Belum ada berita.</p>@endforelse</section>
<section class="admin-panel"><div class="panel-head"><h2>Kegiatan terbaru</h2><a href="{{ route('admin.kegiatan.create') }}">+ Tambah</a></div>@forelse($kegiatan as $item)<div class="admin-list-row"><div><strong>{{ $item->nama }}</strong><small>{{ $item->tanggal->translatedFormat('d M Y') }} · {{ $item->status }}</small></div><a href="{{ route('admin.kegiatan.edit',$item) }}">Edit</a></div>@empty<p class="muted">Belum ada kegiatan.</p>@endforelse</section>
</div>
<section class="admin-panel" style="margin-top:1rem"><div class="panel-head"><div><h2>Kontrol konten</h2><p class="muted">Semua data yang tampil di website dikelola dari panel ini. Tidak perlu mengubah Blade untuk menambah berita atau dokumentasi.</p></div></div><div class="admin-actions-grid"><a class="btn btn-primary" href="{{ route('admin.berita.create') }}">+ Simpan Berita</a><a class="btn btn-primary" href="{{ route('admin.galeri.create') }}">+ Simpan Dokumentasi</a><a class="btn btn-primary" href="{{ route('admin.kegiatan.create') }}">+ Simpan Kegiatan</a><a class="btn btn-primary" href="{{ route('admin.pengurus.create') }}">+ Simpan Pengurus</a></div></section>
@endsection
