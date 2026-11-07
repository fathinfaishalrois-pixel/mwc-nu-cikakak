@extends('layouts.app')

@section('title', $kegiatan->judul . ' — MWC NU Cikakak')
@section('meta_description', Str::limit(strip_tags($kegiatan->deskripsi), 150))

@section('content')
    <article class="max-w-3xl mx-auto px-5 md:px-8 py-16">
        <p class="text-xs uppercase tracking-widest text-[#1F3A22] mb-4">Kegiatan</p>
        <h1 class="font-heading text-3xl md:text-4xl leading-tight mb-4">{{ $kegiatan->judul }}</h1>
        <p class="text-sm text-[#232620]/50 mb-10">
            {{ $kegiatan->tanggal->translatedFormat('d F Y') }}
            @if ($kegiatan->waktu) &middot; {{ \Illuminate\Support\Carbon::parse($kegiatan->waktu)->format('H:i') }} WIB @endif
            @if ($kegiatan->lokasi) &middot; {{ $kegiatan->lokasi }} @endif
        </p>

        @if ($kegiatan->gambar)
            <img src="{{ Storage::url($kegiatan->gambar) }}" alt="{{ $kegiatan->judul }}" class="w-full h-auto mb-10">
        @endif

        <div class="prose-editorial leading-relaxed text-[#232620]/85 space-y-5">
            {!! nl2br(e($kegiatan->deskripsi)) !!}
        </div>
    </article>
@endsection
