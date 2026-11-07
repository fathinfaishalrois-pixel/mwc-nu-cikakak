@extends('layouts.app')

@section('title', 'Lembaga & Banom — MWC NU Cikakak')

@section('content')
    <section class="max-w-5xl mx-auto px-5 md:px-8 py-16">
        <p class="text-xs uppercase tracking-widest text-[#1F3A22] mb-4">Lembaga &amp; Banom</p>
        <h1 class="font-heading text-3xl md:text-4xl mb-10 reveal">Lembaga & Badan Otonom</h1>

        @forelse ($organisasi as $jenis => $items)
            <div class="mb-12">
                <h2 class="text-xs uppercase tracking-widest text-[#232620]/50 mb-5 border-b border-[#232620]/10 pb-2">
                    {{ $jenis ?: 'Lainnya' }}
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 reveal-group">
                    @foreach ($items as $item)
                        <div class="flex gap-4">
                            @if ($item->logo)
                                <img src="{{ Storage::url($item->logo) }}" alt="{{ $item->nama }}" class="w-16 h-16 object-cover shrink-0">
                            @endif
                            <div>
                                <h3 class="font-heading text-lg">
                                    @if ($item->link)
                                        <a href="{{ $item->link }}" target="_blank" rel="noopener" class="hover:text-[#1F3A22]">{{ $item->nama }}</a>
                                    @else
                                        {{ $item->nama }}
                                    @endif
                                </h3>
                                @if ($item->ketua)
                                    <p class="text-sm text-[#232620]/50">Ketua: {{ $item->ketua }}</p>
                                @endif
                                @if ($item->deskripsi)
                                    <p class="text-sm text-[#232620]/70 mt-1 leading-relaxed">{{ $item->deskripsi }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <p class="text-sm text-[#232620]/50">Data lembaga dan banom belum tersedia.</p>
        @endforelse
    </section>
@endsection
