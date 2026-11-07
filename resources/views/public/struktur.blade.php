@extends('layouts.app')

@section('title', 'Struktur Pengurus — MWC NU Cikakak')

@section('content')
    <section class="max-w-5xl mx-auto px-5 md:px-8 py-16">
        <p class="text-xs uppercase tracking-widest text-[#1F3A22] mb-4">Struktur Organisasi</p>
        <h1 class="font-heading text-3xl md:text-4xl mb-10 reveal">Pengurus MWC NU Cikakak</h1>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 reveal-group">
            @forelse ($pengurus as $item)
                <div>
                    @if ($item->foto)
                        <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->nama }}" class="w-full aspect-square object-cover mb-3 transition-transform duration-500 hover:scale-105">
                    @else
                        <div class="w-full aspect-square bg-[#232620]/5 mb-3"></div>
                    @endif
                    <p class="font-heading text-base leading-snug">{{ $item->nama }}</p>
                    <p class="text-xs uppercase tracking-widest text-[#232620]/50 mt-1">{{ $item->jabatan }}</p>
                    @if ($item->periode)
                        <p class="text-xs text-[#232620]/40 mt-0.5">{{ $item->periode }}</p>
                    @endif
                </div>
            @empty
                <p class="text-sm text-[#232620]/50 col-span-4">Data struktur pengurus belum tersedia.</p>
            @endforelse
        </div>
    </section>
@endsection
