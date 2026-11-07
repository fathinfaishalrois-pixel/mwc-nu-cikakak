@extends('layouts.app')
@section('title',$pengurus->nama.' — MWC NU Cikakak')
@section('content')
<section class="section-pad"><div class="container detail-person"><div class="detail-photo"><x-media :path="$pengurus->foto" :alt="$pengurus->nama" loading="eager"/></div><div><span class="eyebrow">{{ $pengurus->jabatan }}</span><h1>{{ $pengurus->nama }}</h1><p class="lead">{{ $pengurus->bidang }} · {{ $pengurus->periode }}</p><div class="prose"><p>{{ $pengurus->bio }}</p><p>{{ $pengurus->deskripsi }}</p></div><a class="btn btn-ghost" href="{{ route('pengurus.index') }}">← Kembali ke struktur</a></div></div></div></section>
@endsection
