@extends('layouts.admin')

@section('title', 'Edit Lembaga & Banom')

@section('content')
    <form action="{{ route('admin.organisasi.update', $organisasi) }}" method="POST" enctype="multipart/form-data" class="max-w-2xl space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $organisasi->nama) }}" required
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Jenis (Lembaga / Banom)</label>
            <input type="text" name="jenis" value="{{ old('jenis', $organisasi->jenis) }}"
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Deskripsi</label>
            <textarea name="deskripsi" rows="5"
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">{{ old('deskripsi', $organisasi->deskripsi) }}</textarea>
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Ketua</label>
            <input type="text" name="ketua" value="{{ old('ketua', $organisasi->ketua) }}"
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Tautan</label>
            <input type="url" name="link" value="{{ old('link', $organisasi->link) }}"
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
        </div>

        @if ($organisasi->logo)
            <div>
                <label class="block text-xs uppercase tracking-widest mb-1.5">Logo Saat Ini</label>
                <img src="{{ Storage::url($organisasi->logo) }}" alt="{{ $organisasi->nama }}" class="w-32 h-32 object-cover border border-[#232620]/10">
            </div>
        @endif

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Ganti Logo</label>
            <input type="file" name="logo" accept="image/*" class="w-full text-sm">
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-[#1F3A22] text-white text-xs uppercase tracking-widest px-5 py-2.5 hover:bg-[#17301A]">Simpan Perubahan</button>
            <a href="{{ route('admin.organisasi.index') }}" class="text-xs uppercase tracking-widest px-5 py-2.5 border border-[#232620]/20 hover:bg-[#232620]/5">Batal</a>
        </div>
    </form>
@endsection
