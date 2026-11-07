@extends('layouts.admin')

@section('title', 'Edit Pengurus')

@section('content')
    <form action="{{ route('admin.pengurus.update', $pengurus) }}" method="POST" enctype="multipart/form-data" class="max-w-2xl space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $pengurus->nama) }}" required
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Jabatan</label>
            <input type="text" name="jabatan" value="{{ old('jabatan', $pengurus->jabatan) }}" required
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs uppercase tracking-widest mb-1.5">Periode</label>
                <input type="text" name="periode" value="{{ old('periode', $pengurus->periode) }}"
                    class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
            </div>
            <div>
                <label class="block text-xs uppercase tracking-widest mb-1.5">Urutan Tampilan</label>
                <input type="number" name="urutan" value="{{ old('urutan', $pengurus->urutan) }}" min="0"
                    class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
            </div>
        </div>

        @if ($pengurus->foto)
            <div>
                <label class="block text-xs uppercase tracking-widest mb-1.5">Foto Saat Ini</label>
                <img src="{{ Storage::url($pengurus->foto) }}" alt="{{ $pengurus->nama }}" class="w-32 h-32 object-cover border border-[#232620]/10">
            </div>
        @endif

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Ganti Foto</label>
            <input type="file" name="foto" accept="image/*" class="w-full text-sm">
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-[#1F3A22] text-white text-xs uppercase tracking-widest px-5 py-2.5 hover:bg-[#17301A]">Simpan Perubahan</button>
            <a href="{{ route('admin.pengurus.index') }}" class="text-xs uppercase tracking-widest px-5 py-2.5 border border-[#232620]/20 hover:bg-[#232620]/5">Batal</a>
        </div>
    </form>
@endsection
