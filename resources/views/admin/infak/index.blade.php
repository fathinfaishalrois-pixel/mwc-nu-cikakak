@extends('layouts.admin')

@section('title', 'Infak & Koin NU')

@section('content')
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white border border-[#232620]/10 p-5">
            <p class="text-xs uppercase tracking-widest text-[#232620]/50">Total Terverifikasi</p>
            <p class="font-heading text-2xl text-[#1F3A22] mt-2">Rp {{ number_format($totalTerkumpul, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white border border-[#232620]/10 p-5">
            <p class="text-xs uppercase tracking-widest text-[#232620]/50">Menunggu Verifikasi</p>
            <p class="font-heading text-2xl text-[#1F3A22] mt-2">{{ $totalPending }}</p>
        </div>
    </div>

    <form method="GET" class="flex gap-2 mb-6">
        <select name="status" class="border border-[#232620]/25 bg-white px-3 py-2 text-sm focus:outline-none focus:border-[#1F3A22]" onchange="this.form.submit()">
            <option value="">Semua Status</option>
            <option value="pending" @selected(request('status') === 'pending')>Pending</option>
            <option value="terverifikasi" @selected(request('status') === 'terverifikasi')>Terverifikasi</option>
        </select>
    </form>

    <div class="bg-white border border-[#232620]/10 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-[#232620]/10 text-left text-xs uppercase tracking-widest text-[#232620]/50">
                    <th class="px-4 py-3">Donatur</th>
                    <th class="px-4 py-3">Program</th>
                    <th class="px-4 py-3">Jumlah</th>
                    <th class="px-4 py-3">Metode</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($infak as $item)
                    <tr class="border-b border-[#232620]/5 last:border-0">
                        <td class="px-4 py-3">
                            {{ $item->nama_donatur }}
                            <span class="block text-xs text-[#232620]/40">{{ $item->desa }}</span>
                        </td>
                        <td class="px-4 py-3">{{ $item->program === 'koin_nu' ? 'Koin NU' : 'Infak Umum' }}</td>
                        <td class="px-4 py-3">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 uppercase text-xs">{{ $item->metode }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs uppercase tracking-widest {{ $item->status === 'terverifikasi' ? 'text-[#1F3A22]' : 'text-amber-600' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right space-x-3">
                            @if ($item->status === 'pending')
                                <form action="{{ route('admin.infak.verify', $item) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-xs uppercase tracking-widest hover:text-[#1F3A22]">Verifikasi</button>
                                </form>
                            @endif
                            <form action="{{ route('admin.infak.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs uppercase tracking-widest text-red-700 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-[#232620]/50">Belum ada laporan infak/koin NU.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $infak->links() }}
    </div>
@endsection
