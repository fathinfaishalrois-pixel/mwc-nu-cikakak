@extends('layouts.app')

@section('title', 'Agenda — MWC NU Cikakak')

@section('content')
    <section class="max-w-4xl mx-auto px-5 md:px-8 py-16">
        <p class="text-xs uppercase tracking-widest text-[#1F3A22] mb-4">Agenda</p>
        <h1 class="font-heading text-3xl md:text-4xl mb-10">Agenda MWC NU Cikakak</h1>

        <div class="mb-12">
            <h2 class="text-xs uppercase tracking-widest text-[#232620]/50 mb-4 border-b border-[#232620]/10 pb-2">Mendatang</h2>
            <div class="divide-y divide-[#232620]/10 reveal-group">
                @forelse ($mendatang as $item)
                    <div class="py-5 flex flex-col md:flex-row md:items-center gap-2 md:gap-8">
                        <span class="text-sm text-[#1F3A22] w-32 shrink-0">{{ $item->tanggal->translatedFormat('d M Y') }}</span>
                        <div>
                            <p class="font-heading text-lg">{{ $item->nama }}</p>
                            @if ($item->lokasi)
                                <p class="text-sm text-[#232620]/50">{{ $item->lokasi }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-[#232620]/50 py-5">Belum ada agenda mendatang.</p>
                @endforelse
            </div>
        </div>

        <div>
            <h2 class="text-xs uppercase tracking-widest text-[#232620]/50 mb-4 border-b border-[#232620]/10 pb-2">Sudah Berlalu</h2>
            <div class="divide-y divide-[#232620]/10">
                @forelse ($lewat as $item)
                    <div class="py-5 flex flex-col md:flex-row md:items-center gap-2 md:gap-8 opacity-60">
                        <span class="text-sm w-32 shrink-0">{{ $item->tanggal->translatedFormat('d M Y') }}</span>
                        <div>
                            <p class="font-heading text-lg">{{ $item->nama }}</p>
                            @if ($item->lokasi)
                                <p class="text-sm text-[#232620]/50">{{ $item->lokasi }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-[#232620]/50 py-5">Belum ada agenda yang lewat.</p>
                @endforelse
            </div>
            <div class="mt-6">
                {{ $lewat->links() }}
            </div>
        </div>
    </section>
@endsection
