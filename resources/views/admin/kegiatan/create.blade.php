@extends('layouts.admin')

@section('title', 'Tambah Kegiatan')

@section('content')
    <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl space-y-5">
        @csrf

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Judul</label>
            <input type="text" name="judul" value="{{ old('judul') }}" required
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Deskripsi</label>
            <textarea name="deskripsi" rows="6" required
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs uppercase tracking-widest mb-1.5">Tanggal</label>
                <input type="date" name="tanggal" value="{{ old('tanggal') }}" required
                    class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
            </div>
            <div>
                <label class="block text-xs uppercase tracking-widest mb-1.5">Waktu</label>
                <input type="time" name="waktu" value="{{ old('waktu') }}"
                    class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
            </div>
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Lokasi</label>
            <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Gambar</label>
            <input type="file" name="gambar" accept="image/*" class="w-full text-sm">
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-[#1F3A22] text-white text-xs uppercase tracking-widest px-5 py-2.5 hover:bg-[#17301A]">Simpan</button>
            <a href="{{ route('admin.kegiatan.index') }}" class="text-xs uppercase tracking-widest px-5 py-2.5 border border-[#232620]/20 hover:bg-[#232620]/5">Batal</a>
        </div>
    </form>
@endsection
