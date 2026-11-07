@extends('layouts.admin')

@section('title', 'Lembaga & Banom')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-[#232620]/60">Kelola data lembaga dan badan otonom (banom).</p>
        <a href="{{ route('admin.organisasi.create') }}" class="bg-[#1F3A22] text-white text-xs uppercase tracking-widest px-4 py-2.5 hover:bg-[#17301A]">
            + Tambah Data
        </a>
    </div>

    <div class="bg-white border border-[#232620]/10 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-[#232620]/10 text-left text-xs uppercase tracking-widest text-[#232620]/50">
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Jenis</th>
                    <th class="px-4 py-3">Ketua</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($organisasi as $item)
                    <tr class="border-b border-[#232620]/5 last:border-0">
                        <td class="px-4 py-3">{{ $item->nama }}</td>
                        <td class="px-4 py-3">{{ $item->jenis ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $item->ketua ?? '—' }}</td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('admin.organisasi.edit', $item) }}" class="text-xs uppercase tracking-widest hover:text-[#1F3A22]">Edit</a>
                            <form action="{{ route('admin.organisasi.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs uppercase tracking-widest text-red-700 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-[#232620]/50">Belum ada data lembaga/banom.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $organisasi->links() }}
    </div>
@endsection
