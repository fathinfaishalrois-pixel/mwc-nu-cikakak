@extends('layouts.admin')

@section('title', 'Tambah Pengurus')

@section('content')
    <form action="{{ route('admin.pengurus.store') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl space-y-5">
        @csrf

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Nama</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Jabatan</label>
            <input type="text" name="jabatan" value="{{ old('jabatan') }}" required
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs uppercase tracking-widest mb-1.5">Periode</label>
                <input type="text" name="periode" value="{{ old('periode') }}" placeholder="cth. 2022–2027"
                    class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
            </div>
            <div>
                <label class="block text-xs uppercase tracking-widest mb-1.5">Urutan Tampilan</label>
                <input type="number" name="urutan" value="{{ old('urutan', 0) }}" min="0"
                    class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
            </div>
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Foto</label>
            <input type="file" name="foto" accept="image/*" class="w-full text-sm">
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-[#1F3A22] text-white text-xs uppercase tracking-widest px-5 py-2.5 hover:bg-[#17301A]">Simpan</button>
            <a href="{{ route('admin.pengurus.index') }}" class="text-xs uppercase tracking-widest px-5 py-2.5 border border-[#232620]/20 hover:bg-[#232620]/5">Batal</a>
        </div>
    </form>
@endsection
