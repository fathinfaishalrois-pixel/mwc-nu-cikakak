@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('content')
    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl space-y-5">
        @csrf

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Judul</label>
            <input type="text" name="judul" value="{{ old('judul') }}" required
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Kategori</label>
            <select name="kategori_id" class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
                <option value="">— Tanpa Kategori —</option>
                @foreach ($kategori as $item)
                    <option value="{{ $item->id }}" @selected(old('kategori_id') == $item->id)>{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Isi Berita</label>
            <textarea name="isi" rows="10" required
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">{{ old('isi') }}</textarea>
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Penulis</label>
            <input type="text" name="penulis" value="{{ old('penulis') }}"
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Gambar</label>
            <input type="file" name="gambar" accept="image/*" class="w-full text-sm">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs uppercase tracking-widest mb-1.5">Status</label>
                <select name="status" class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
                    <option value="draft" @selected(old('status') === 'draft')>Draft</option>
                    <option value="published" @selected(old('status') === 'published')>Published</option>
                </select>
            </div>
            <div>
                <label class="block text-xs uppercase tracking-widest mb-1.5">Tanggal Publikasi</label>
                <input type="datetime-local" name="published_at" value="{{ old('published_at') }}"
                    class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
            </div>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-[#1F3A22] text-white text-xs uppercase tracking-widest px-5 py-2.5 hover:bg-[#17301A]">Simpan</button>
            <a href="{{ route('admin.berita.index') }}" class="text-xs uppercase tracking-widest px-5 py-2.5 border border-[#232620]/20 hover:bg-[#232620]/5">Batal</a>
        </div>
    </form>
@endsection
