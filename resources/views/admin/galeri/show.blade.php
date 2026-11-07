@extends('layouts.admin')

@section('title', 'Kelola Foto — ' . $galeri->judul)

@section('content')
    <div class="mb-8 max-w-xl">
        <form action="{{ route('admin.galeri.foto.store', $galeri) }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white border border-[#232620]/10 p-5">
            @csrf
            <div>
                <label class="block text-xs uppercase tracking-widest mb-1.5">Unggah Foto</label>
                <input type="file" name="file" accept="image/*" required class="w-full text-sm">
            </div>
            <div>
                <label class="block text-xs uppercase tracking-widest mb-1.5">Caption</label>
                <input type="text" name="caption" value="{{ old('caption') }}"
                    class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
            </div>
            <button type="submit" class="bg-[#1F3A22] text-white text-xs uppercase tracking-widest px-5 py-2.5 hover:bg-[#17301A]">Unggah</button>
        </form>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @forelse ($galeri->foto as $foto)
            <div class="bg-white border border-[#232620]/10">
                <img src="{{ Storage::url($foto->file) }}" alt="{{ $foto->caption }}" class="w-full h-40 object-cover">
                <div class="p-3">
                    <p class="text-xs text-[#232620]/70 truncate">{{ $foto->caption ?? '—' }}</p>
                    <form action="{{ route('admin.galeri.foto.destroy', [$galeri, $foto]) }}" method="POST" class="mt-2" onsubmit="return confirm('Hapus foto ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs uppercase tracking-widest text-red-700 hover:text-red-900">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-sm text-[#232620]/50 col-span-4">Belum ada foto pada album ini.</p>
        @endforelse
    </div>

    <div class="mt-8">
        <a href="{{ route('admin.galeri.index') }}" class="text-xs uppercase tracking-widest px-5 py-2.5 border border-[#232620]/20 hover:bg-[#232620]/5">&larr; Kembali</a>
    </div>
@endsection
