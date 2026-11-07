@extends('layouts.admin')

@section('title', 'Tambah Album Galeri')

@section('content')
    <form action="{{ route('admin.galeri.store') }}" method="POST" class="max-w-2xl space-y-5">
        @csrf

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Judul Album</label>
            <input type="text" name="judul" value="{{ old('judul') }}" required
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">{{ old('deskripsi') }}</textarea>
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal') }}"
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-[#1F3A22] text-white text-xs uppercase tracking-widest px-5 py-2.5 hover:bg-[#17301A]">Simpan & Lanjut Unggah Foto</button>
            <a href="{{ route('admin.galeri.index') }}" class="text-xs uppercase tracking-widest px-5 py-2.5 border border-[#232620]/20 hover:bg-[#232620]/5">Batal</a>
        </div>
    </form>
@endsection
