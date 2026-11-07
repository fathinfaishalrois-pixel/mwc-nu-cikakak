@extends('layouts.app')

@section('title', 'Berita — MWC NU Cikakak')

@section('content')
    <section class="max-w-6xl mx-auto px-5 md:px-8 py-16">
        <p class="text-xs uppercase tracking-widest text-[#1F3A22] mb-4">Berita</p>
        <h1 class="font-heading text-3xl md:text-4xl mb-10">Berita MWC NU Cikakak</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 reveal-group">
            @forelse ($berita as $item)
                <article>
                    @if ($item->gambar)
                        <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-48 object-cover mb-4">
                    @endif
                    <p class="text-xs uppercase tracking-widest text-[#232620]/50 mb-2">
                        {{ optional($item->published_at)->translatedFormat('d M Y') }}
                        @if ($item->kategori) &middot; {{ $item->kategori->nama }} @endif
                    </p>
                    <h2 class="font-heading text-lg leading-snug mb-2">
                        <a href="{{ route('berita.show', $item->slug) }}" class="hover:text-[#1F3A22]">{{ $item->judul }}</a>
                    </h2>
                    @if ($item->penulis)
                        <p class="text-xs text-[#232620]/40">Oleh {{ $item->penulis }}</p>
                    @endif
                </article>
            @empty
                <p class="text-sm text-[#232620]/50 col-span-3">Belum ada berita.</p>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $berita->links() }}
        </div>
    </section>
@endsection
