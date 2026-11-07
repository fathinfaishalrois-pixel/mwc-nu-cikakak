@extends('layouts.app')

@section('title', $berita->judul . ' — MWC NU Cikakak')
@section('meta_description', Str::limit(strip_tags($berita->isi), 150))

@section('content')
    <article class="max-w-3xl mx-auto px-5 md:px-8 py-16">
        <p class="text-xs uppercase tracking-widest text-[#1F3A22] mb-4">
            @if ($berita->kategori) {{ $berita->kategori->nama }} @endif
        </p>
        <h1 class="font-heading text-3xl md:text-4xl leading-tight mb-4">{{ $berita->judul }}</h1>
        <p class="text-sm text-[#232620]/50 mb-10">
            {{ optional($berita->published_at)->translatedFormat('d F Y') }}
            @if ($berita->penulis) &middot; Oleh {{ $berita->penulis }} @endif
        </p>

        @if ($berita->gambar)
            <img src="{{ Storage::url($berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-auto mb-10">
        @endif

        <div class="prose-editorial leading-relaxed text-[#232620]/85 space-y-5">
            {!! nl2br(e($berita->isi)) !!}
        </div>
    </article>

    @if ($terkait->isNotEmpty())
        <section class="max-w-6xl mx-auto px-5 md:px-8 py-16 border-t border-[#232620]/10">
            <h2 class="font-heading text-2xl text-[#1F3A22] mb-8">Berita Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach ($terkait as $item)
                    <article>
                        @if ($item->gambar)
                            <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-40 object-cover mb-3">
                        @endif
                        <h3 class="font-heading text-base leading-snug">
                            <a href="{{ route('berita.show', $item->slug) }}" class="hover:text-[#1F3A22]">{{ $item->judul }}</a>
                        </h3>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
@endsection
