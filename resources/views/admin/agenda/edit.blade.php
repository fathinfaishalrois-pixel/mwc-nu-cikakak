@extends('layouts.admin')

@section('title', 'Edit Agenda')

@section('content')
    <form action="{{ route('admin.agenda.update', $agenda) }}" method="POST" class="max-w-2xl space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Nama Agenda</label>
            <input type="text" name="nama" value="{{ old('nama', $agenda->nama) }}" required
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs uppercase tracking-widest mb-1.5">Tanggal</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', optional($agenda->tanggal)->format('Y-m-d')) }}" required
                    class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
            </div>
            <div>
                <label class="block text-xs uppercase tracking-widest mb-1.5">Waktu</label>
                <input type="time" name="waktu" value="{{ old('waktu', $agenda->waktu) }}"
                    class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
            </div>
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Lokasi</label>
            <input type="text" name="lokasi" value="{{ old('lokasi', $agenda->lokasi) }}"
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest mb-1.5">Deskripsi</label>
            <textarea name="deskripsi" rows="5"
                class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-[#1F3A22] text-white text-xs uppercase tracking-widest px-5 py-2.5 hover:bg-[#17301A]">Simpan Perubahan</button>
            <a href="{{ route('admin.agenda.index') }}" class="text-xs uppercase tracking-widest px-5 py-2.5 border border-[#232620]/20 hover:bg-[#232620]/5">Batal</a>
        </div>
    </form>
@endsection
