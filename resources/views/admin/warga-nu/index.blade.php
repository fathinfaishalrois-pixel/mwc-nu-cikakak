@extends('layouts.admin')

@section('title', 'Warga NU')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <form method="GET" class="flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / NIK / desa"
                class="border border-[#232620]/25 bg-white px-3 py-2 text-sm focus:outline-none focus:border-[#1F3A22]">
            <select name="status" class="border border-[#232620]/25 bg-white px-3 py-2 text-sm focus:outline-none focus:border-[#1F3A22]">
                <option value="">Semua Status</option>
                <option value="pending" @selected(request('status') === 'pending')>Menunggu verifikasi</option>
                <option value="approved" @selected(request('status') === 'approved')>Terverifikasi</option>
                <option value="rejected" @selected(request('status') === 'rejected')>Ditolak</option>
            </select>
            <button type="submit" class="text-xs uppercase tracking-widest px-4 py-2 border border-[#232620]/20 hover:bg-[#232620]/5">Cari</button>
        </form>

        <a href="{{ route('admin.warga-nu.create') }}" class="bg-[#1F3A22] text-white text-xs uppercase tracking-widest px-4 py-2.5 hover:bg-[#17301A] text-center">
            + Tambah Warga
        </a>
    </div>

    <div class="bg-white border border-[#232620]/10 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-[#232620]/10 text-left text-xs uppercase tracking-widest text-[#232620]/50">
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">NIK</th>
                    <th class="px-4 py-3">Dusun / Desa</th>
                    <th class="px-4 py-3">No. HP</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($warga as $item)
                    <tr class="border-b border-[#232620]/5 last:border-0">
                        <td class="px-4 py-3">{{ $item->nama }}</td>
                        <td class="px-4 py-3">{{ $item->nik ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $item->dusun }} / {{ $item->desa }}</td>
                        <td class="px-4 py-3">{{ $item->no_hp ?? '—' }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs uppercase tracking-widest {{ $item->status === 'aktif' ? 'text-[#1F3A22]' : 'text-[#232620]/50' }}">
                                {{ ['pending' => 'Menunggu verifikasi', 'approved' => 'Terverifikasi', 'rejected' => 'Ditolak'][$item->verification_status ?? 'approved'] ?? 'Belum diketahui' }}<br><small>{{ $item->status === 'aktif' ? 'Kartu aktif' : 'Kartu nonaktif' }}</small>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right space-x-3">
                            @if(($item->verification_status ?? 'approved') === 'pending')
                                <form action="{{ route('admin.warga-nu.approve', $item) }}" method="POST" class="inline">@csrf @method('PATCH')<button class="text-xs font-bold text-green-800">Setujui</button></form>
                                <form action="{{ route('admin.warga-nu.reject', $item) }}" method="POST" class="inline" onsubmit="const reason=prompt('Alasan penolakan:');if(!reason||!reason.trim())return false;this.querySelector('[name=rejection_reason]').value=reason;return true">@csrf @method('PATCH')<input type="hidden" name="rejection_reason"><button class="text-xs font-bold text-red-700">Tolak</button></form>
                            @elseif($item->status === 'aktif')
                                <form action="{{ route('admin.warga-nu.deactivate', $item) }}" method="POST" class="inline" onsubmit="return confirm('Nonaktifkan keanggotaan ini?')">@csrf @method('PATCH')<button class="text-xs text-amber-800">Nonaktifkan</button></form>
                            @endif
                            <a href="{{ route('admin.warga-nu.edit', $item) }}" class="text-xs uppercase tracking-widest hover:text-[#1F3A22]">Edit</a>
                            <form action="{{ route('admin.warga-nu.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data warga ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs uppercase tracking-widest text-red-700 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-[#232620]/50">Belum ada data warga.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $warga->links() }}
    </div>
@endsection
