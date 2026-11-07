@extends('layouts.app')

@section('title', 'Profil — MWC NU Cikakak')
@section('meta_description', 'Profil, sejarah, visi dan misi Majelis Wakil Cabang Nahdlatul Ulama Cikakak.')

@section('content')
    <section class="max-w-5xl mx-auto px-5 md:px-8 pt-16 pb-10">
        <p class="text-xs uppercase tracking-widest text-[#1F3A22] mb-4 reveal">Profil</p>
        <h1 class="font-heading text-3xl md:text-4xl mb-8 reveal">MWC NU Cikakak</h1>

        <div class="prose-editorial space-y-5 text-[#232620]/80 leading-relaxed max-w-3xl reveal">
            <p>
                Majelis Wakil Cabang Nahdlatul Ulama (MWC NU) Cikakak adalah struktur kepengurusan Nahdlatul Ulama
                di tingkat kecamatan, yang menjalankan khidmah jam'iyah untuk warga NU di seluruh desa/kelurahan
                di wilayah Kecamatan Cikakak.
            </p>
            <p class="text-sm italic text-[#232620]/50 border-l-4 border-[#1F3A22]/30 pl-4">
                Catatan: paragraf sejarah, jumlah ranting, dan capaian di bawah ini masih berupa draf. Mohon
                dilengkapi dan diverifikasi oleh pengurus MWC NU Cikakak melalui panel admin sebelum dipublikasikan
                sebagai data resmi.
            </p>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-5 md:px-8 py-12 border-t border-[#232620]/10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 reveal-group">
            <div class="bg-white border border-[#232620]/10 p-6">
                <h2 class="font-heading text-xl text-[#1F3A22] mb-3">Visi</h2>
                <p class="text-[#232620]/75 leading-relaxed text-sm">
                    Terwujudnya jam'iyah Nahdlatul Ulama Cikakak yang mandiri, guyub, dan memberi kemanfaatan
                    nyata bagi masyarakat, dijiwai oleh nilai-nilai Ahlussunnah wal Jama'ah An-Nahdliyah.
                </p>
            </div>
            <div class="bg-white border border-[#232620]/10 p-6">
                <h2 class="font-heading text-xl text-[#1F3A22] mb-3">Misi</h2>
                <ul class="text-[#232620]/75 leading-relaxed text-sm space-y-2 list-disc pl-4">
                    <li>Menguatkan dakwah Islam ramah dan moderat di tingkat ranting dan dusun.</li>
                    <li>Mengembangkan lembaga pendidikan, sosial, dan ekonomi umat.</li>
                    <li>Meningkatkan kemandirian jam'iyah melalui program seperti Infak dan Koin NU.</li>
                    <li>Mempererat koordinasi antar lembaga, badan otonom (banom), dan ranting.</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-5 md:px-8 py-12 border-t border-[#232620]/10">
        <h2 class="text-xs uppercase tracking-widest text-[#232620]/50 mb-8 reveal">Khidmah Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 reveal-group">
            <div>
                <p class="font-heading text-2xl text-[#1F3A22] mb-2">Jam'iyah</p>
                <p class="text-sm text-[#232620]/70 leading-relaxed">Menghimpun dan mengorganisasi warga NU di seluruh desa se-Kecamatan Cikakak.</p>
            </div>
            <div>
                <p class="font-heading text-2xl text-[#1F3A22] mb-2">Khidmah</p>
                <p class="text-sm text-[#232620]/70 leading-relaxed">Melayani kebutuhan keagamaan, sosial, dan pendidikan warga tanpa henti.</p>
            </div>
            <div>
                <p class="font-heading text-2xl text-[#1F3A22] mb-2">Kemanfaatan</p>
                <p class="text-sm text-[#232620]/70 leading-relaxed">Menghadirkan manfaat nyata lewat kegiatan sosial, dakwah, dan program kemandirian umat.</p>
            </div>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-5 md:px-8 py-16 border-t border-[#232620]/10 text-center reveal">
        <p class="text-[#232620]/70 mb-4">Ingin mengenal struktur pengurus dan lembaga/banom kami?</p>
        <div class="flex flex-wrap items-center justify-center gap-4">
            <a href="{{ route('struktur') }}" class="bg-[#1F3A22] text-white text-xs uppercase tracking-widest px-5 py-3 hover:bg-[#17301A] transition-transform hover:-translate-y-0.5">
                Lihat Struktur Pengurus
            </a>
            <a href="{{ route('organisasi') }}" class="border border-[#232620]/25 text-xs uppercase tracking-widest px-5 py-3 hover:border-[#1F3A22] hover:text-[#1F3A22] transition-colors">
                Lembaga &amp; Banom
            </a>
        </div>
    </section>
@endsection
