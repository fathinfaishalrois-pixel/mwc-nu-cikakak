@extends('layouts.admin')

@section('title', 'Tambah Warga NU')

@section('content')
    <form action="{{ route('admin.warga-nu.store') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl space-y-5">
        @csrf

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Nama</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs uppercase tracking-widest mb-1.5">NIK</label>
                <input type="text" name="nik" value="{{ old('nik') }}"
                    class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
            </div>
            <div>
                <label class="block text-xs uppercase tracking-widest mb-1.5">Jenis Kelamin</label>
                <select name="jenis_kelamin" required class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
                    <option value="">— Pilih —</option>
                    <option value="L" @selected(old('jenis_kelamin') === 'L')>Laki-laki</option>
                    <option value="P" @selected(old('jenis_kelamin') === 'P')>Perempuan</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Alamat</label>
            <textarea name="alamat" rows="3"
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">{{ old('alamat') }}</textarea>
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
                <label class="block text-xs uppercase tracking-widest mb-1.5">No. HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                    class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
            </div>
            <div>
                <label class="block text-xs uppercase tracking-widest mb-1.5">Pekerjaan</label>
                <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}"
                    class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
            </div>
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Foto</label>
            <input type="file" name="foto" accept="image/*" class="w-full text-sm">
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Status</label>
            <select name="status" required class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
                <option value="aktif" @selected(old('status', 'aktif') === 'aktif')>Aktif</option>
                <option value="tidak_aktif" @selected(old('status') === 'tidak_aktif')>Tidak Aktif</option>
            </select>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-[#1F3A22] text-white text-xs uppercase tracking-widest px-5 py-2.5 hover:bg-[#17301A]">Simpan</button>
            <a href="{{ route('admin.warga-nu.index') }}" class="text-xs uppercase tracking-widest px-5 py-2.5 border border-[#232620]/20 hover:bg-[#232620]/5">Batal</a>
        </div>
    </form>
@endsection
