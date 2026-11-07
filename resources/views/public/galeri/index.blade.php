@extends('layouts.app')

@section('title', 'Dokumentasi & Galeri — MWC NU Cikakak')

@section('content')
    <section class="max-w-6xl mx-auto px-5 md:px-8 py-12 md:py-16">
        <p class="text-xs uppercase tracking-widest text-[#1F3A22] mb-4">Dokumentasi</p>
        <h1 class="font-heading text-3xl md:text-4xl mb-8 md:mb-10">Galeri Kegiatan</h1>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-10 reveal-group">
            @forelse ($galeri as $item)
                <a href="{{ route('galeri.show', $item) }}" class="block group min-w-0">
                    @if ($item->gambar)
                        <img src="{{ Str::startsWith($item->gambar, 'assets/') ? asset($item->gambar) : Storage::url($item->gambar) }}" alt="{{ $item->judul }}" class="w-full aspect-[4/3] md:aspect-auto md:h-56 object-cover mb-3 md:mb-4 rounded-xl" loading="lazy" draggable="false">
                    @else
                        <div class="w-full aspect-[4/3] md:h-56 bg-[#232620]/5 mb-3 md:mb-4 rounded-xl"></div>
                    @endif
                    <p class="text-[10px] md:text-xs uppercase tracking-widest text-[#232620]/50 mb-1">
                        {{ optional($item->tanggal)->translatedFormat('d M Y') }}
                    </p>
                    <h2 class="font-heading text-base md:text-lg leading-snug group-hover:text-[#1F3A22]">{{ $item->judul }}</h2>
                </a>
            @empty
                <p class="text-sm text-[#232620]/50 col-span-2 md:col-span-3">Belum ada dokumentasi.</p>
            @endforelse
        </div>

        <div class="mt-10 md:mt-12">
            {{ $galeri->links() }}
        </div>
    </section>
@endsection
