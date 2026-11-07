@extends('layouts.app')

@section('title', 'Infak & Koin NU — MWC NU Cikakak')
@section('meta_description', 'Program Infak NU dan Koin NU MWC NU Cikakak — kumpulan recehan warga untuk kemandirian jam\'iyah.')

@section('content')
    <section class="max-w-5xl mx-auto px-5 md:px-8 py-16">
        <p class="text-xs uppercase tracking-widest text-[#1F3A22] mb-4 reveal">Kemandirian Jam'iyah</p>
        <h1 class="font-heading text-3xl md:text-4xl mb-4 reveal">Infak NU &amp; Koin NU</h1>
        <p class="max-w-2xl text-[#232620]/70 leading-relaxed mb-12 reveal">
            Koin NU adalah gerakan mengumpulkan infak recehan warga NU secara rutin di tingkat ranting/dusun,
            untuk mendukung kegiatan dakwah, sosial, dan operasional MWC NU Cikakak. Setiap laporan akan
            diverifikasi oleh pengurus sebelum ditampilkan pada rekapitulasi publik.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
            <div class="border border-[#232620]/10 bg-white p-6 counter-card reveal">
                <p class="text-xs uppercase tracking-widest text-[#232620]/50">Total Terkumpul (Terverifikasi)</p>
                <p class="font-heading text-3xl text-[#1F3A22] mt-2" data-counter="{{ $totalTerkumpul }}">0</p>
            </div>
            <div class="border border-[#232620]/10 bg-white p-6 counter-card reveal">
                <p class="text-xs uppercase tracking-widest text-[#232620]/50">Jumlah Donatur</p>
                <p class="font-heading text-3xl text-[#1F3A22] mt-2" data-counter="{{ $totalDonatur }}" data-plain="1">0</p>
            </div>
            <div class="border border-[#232620]/10 bg-white p-6 reveal">
                <p class="text-xs uppercase tracking-widest text-[#232620]/50">Metode</p>
                <p class="font-heading text-lg text-[#1F3A22] mt-2">Tunai &middot; Transfer &middot; QRIS</p>
            </div>
        </div>

        @if ($rekapDesa->isNotEmpty())
            <div class="mb-16 reveal">
                <h2 class="text-xs uppercase tracking-widest text-[#232620]/50 mb-4 border-b border-[#232620]/10 pb-2">Rekap per Desa</h2>
                <div class="divide-y divide-[#232620]/10">
                    @foreach ($rekapDesa as $item)
                        <div class="py-3 flex justify-between text-sm">
                            <span>{{ $item->desa }}</span>
                            <span class="text-[#232620]/50">Rp {{ number_format($item->total, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="reveal">
                <h2 class="font-heading text-xl text-[#1F3A22] mb-5">Lapor Infak / Koin NU</h2>

                @if (session('success'))
                    <div class="mb-5 border-l-4 border-[#1F3A22] bg-[#1F3A22]/5 px-4 py-3 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('infak.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs uppercase tracking-widest mb-1.5">Program</label>
                        <select name="program" class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
                            <option value="koin_nu" @selected(old('program', 'koin_nu') === 'koin_nu')>Koin NU</option>
                            <option value="infak_umum" @selected(old('program') === 'infak_umum')>Infak Umum</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest mb-1.5">Nama Donatur</label>
                        <input type="text" name="nama_donatur" value="{{ old('nama_donatur') }}" required
                            class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs uppercase tracking-widest mb-1.5">Dusun</label>
                            <input type="text" name="dusun" value="{{ old('dusun') }}"
                                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
                        </div>
                        <div>
                            <label class="block text-xs uppercase tracking-widest mb-1.5">Desa</label>
                            <input type="text" name="desa" value="{{ old('desa') }}"
                                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs uppercase tracking-widest mb-1.5">Jumlah (Rp)</label>
                            <input type="number" name="jumlah" min="1000" value="{{ old('jumlah') }}" required
                                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
                        </div>
                        <div>
                            <label class="block text-xs uppercase tracking-widest mb-1.5">Metode</label>
                            <select name="metode" class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
                                <option value="tunai" @selected(old('metode', 'tunai') === 'tunai')>Tunai</option>
                                <option value="transfer" @selected(old('metode') === 'transfer')>Transfer</option>
                                <option value="qris" @selected(old('metode') === 'qris')>QRIS</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest mb-1.5">No. HP (opsional)</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                            class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest mb-1.5">Bukti Transfer (opsional)</label>
                        <input type="file" name="bukti" accept="image/*" class="w-full text-sm">
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest mb-1.5">Catatan</label>
                        <textarea name="catatan" rows="3"
                            class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">{{ old('catatan') }}</textarea>
                    </div>

                    <button type="submit" class="bg-[#1F3A22] text-white text-xs uppercase tracking-widest px-6 py-3 hover:bg-[#17301A] transition-transform hover:-translate-y-0.5">
                        Kirim Laporan
                    </button>
                </form>
            </div>

            <div class="reveal">
                <h2 class="font-heading text-xl text-[#1F3A22] mb-5">Riwayat Terverifikasi</h2>
                <div class="divide-y divide-[#232620]/10">
                    @forelse ($riwayat as $item)
                        <div class="py-3 flex justify-between text-sm">
                            <div>
                                <p>{{ $item->nama_donatur }}</p>
                                <p class="text-xs text-[#232620]/40">{{ $item->created_at->translatedFormat('d M Y') }} &middot; {{ $item->desa ?? '—' }}</p>
                            </div>
                            <span class="text-[#1F3A22] font-medium">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-[#232620]/50 py-3">Belum ada laporan terverifikasi.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
