@extends('layouts.app')

@section('title', 'Informasi Warga NU — MWC NU Cikakak')

@section('content')
    <section class="max-w-4xl mx-auto px-5 md:px-8 py-16">
        <p class="text-xs uppercase tracking-widest text-[#1F3A22] mb-4">Warga NU</p>
        <h1 class="font-heading text-3xl md:text-4xl mb-6">Informasi Warga NU Cikakak</h1>
        <p class="text-[#232620]/70 leading-relaxed mb-10 max-w-2xl">
            Ringkasan data warga NU yang tercatat di lingkungan MWC NU Cikakak. Data pribadi seperti NIK, nomor HP, dan alamat lengkap tidak ditampilkan di halaman publik demi menjaga privasi warga.
        </p>

        <div class="flex flex-wrap gap-3 mb-10">
            <a href="{{ route('anggota.daftar') }}" class="inline-flex items-center rounded-lg bg-[#087443] px-5 py-3 text-sm font-semibold text-white">Daftar Anggota Warga NU ↗</a>
            <a href="#sebaran" class="inline-flex items-center rounded-lg border border-[#232620]/20 px-5 py-3 text-sm font-semibold">Lihat sebaran warga</a>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-12">
            <div class="border border-[#232620]/10 p-6">
                <p class="text-xs uppercase tracking-widest text-[#232620]/50">Warga Aktif Tercatat</p>
                <p class="font-heading text-3xl text-[#1F3A22] mt-2">{{ $totalAktif }}</p>
            </div>
            <div class="border border-[#232620]/10 p-6">
                <p class="text-xs uppercase tracking-widest text-[#232620]/50">Cakupan Desa</p>
                <p class="font-heading text-3xl text-[#1F3A22] mt-2">{{ $totalDesa }}</p>
            </div>
        </div>

        <h2 id="sebaran" class="text-xs uppercase tracking-widest text-[#232620]/50 mb-4 border-b border-[#232620]/10 pb-2">Sebaran per Desa</h2>
        <div class="divide-y divide-[#232620]/10">
            @forelse ($perDesa as $item)
                <div class="py-3 flex justify-between text-sm">
                    <span>{{ $item->desa }}</span>
                    <span class="text-[#232620]/50">{{ $item->jumlah }} warga</span>
                </div>
            @empty
                <p class="text-sm text-[#232620]/50 py-3">Data belum tersedia.</p>
            @endforelse
        </div>
    </section>
@endsection
