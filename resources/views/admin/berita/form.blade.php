@extends('layouts.admin')

@section('title', ($item->exists ? 'Edit' : 'Tambah') . ' Berita — Admin')
@section('heading', $item->exists ? 'Edit Berita' : 'Tambah Berita')

@section('content')
@php
    $today = now('Asia/Jakarta')->toDateString();
    $selectedDate = old(
        'tanggal',
        $item->tanggal
            ? \Illuminate\Support\Carbon::parse($item->tanggal)->toDateString()
            : $today
    );
@endphp

<form class="admin-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="form-grid">
        <div class="admin-panel">
            <h2>Konten</h2>

            <label>
                Judul*
                <input
                    type="text"
                    name="judul"
                    value="{{ old('judul', $item->judul) }}"
                    maxlength="220"
                    required
                >
            </label>

            <div class="field-grid">
                <label>
                    Kategori*
                    <input
                        type="text"
                        name="kategori"
                        value="{{ old('kategori', $item->kategori) }}"
                        maxlength="100"
                        required
                    >
                </label>

                <label>
                    Tanggal berita*
                    <input
                        type="date"
                        name="tanggal"
                        value="{{ $selectedDate }}"
                        max="{{ $today }}"
                        required
                    >
                    <small>
                        Otomatis menggunakan tanggal hari ini. Tanggal sebelumnya boleh dipilih,
                        tetapi tanggal setelah hari ini tidak diperbolehkan.
                    </small>
                </label>

                <label>
                    Penulis
                    <input
                        type="text"
                        name="penulis"
                        value="{{ old('penulis', $item->penulis ?: 'Tim Media MWC NU Cikakak') }}"
                        maxlength="120"
                    >
                </label>

                <label>
                    Status
                    <select name="status" required>
                        <option value="draft" @selected(old('status', $item->status) === 'draft')>
                            Draft
                        </option>
                        <option value="published" @selected(old('status', $item->status) === 'published')>
                            Published
                        </option>
                    </select>
                </label>
            </div>

            <label>
                Ringkasan
                <textarea name="ringkasan" rows="4" maxlength="600">{{ old('ringkasan', $item->ringkasan) }}</textarea>
            </label>

            <label>
                Isi*
                <textarea name="isi" rows="14" maxlength="30000" required>{{ old('isi', $item->isi) }}</textarea>
            </label>
        </div>

        <div class="admin-panel">
            <h2>Thumbnail</h2>

            @if ($item->thumbnail)
                <div class="form-preview">
                    <x-media :path="$item->thumbnail" :alt="$item->judul" loading="eager" />
                </div>
            @endif

            <label>
                Upload thumbnail
                <input
                    type="file"
                    name="thumbnail"
                    accept="image/jpeg,image/png,image/webp"
                >
            </label>

            <small>Maksimal 3 MB. Format JPG, PNG, atau WEBP.</small>
        </div>
    </div>

    <div class="form-actions">
        <a class="btn btn-ghost" href="{{ route('admin.berita.index') }}">Batal</a>
        <button class="btn btn-primary" type="submit">Simpan berita</button>
    </div>
</form>
@endsection
