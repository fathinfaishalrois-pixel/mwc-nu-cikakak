<!doctype html>
<html lang="id" data-sound="on">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'MWC NU Cikakak | Desa Cikakak, Wangon, Banyumas')</title>
    <meta name="description" content="Profil dan informasi kegiatan MWC NU Cikakak, Desa Cikakak, Kecamatan Wangon, Kabupaten Banyumas.">
    <meta name="theme-color" content="#087443">
    <meta property="og:title" content="@yield('title', 'MWC NU Cikakak')">
    <meta property="og:description" content="Ruang informasi organisasi, kepengurusan, kegiatan, berita, dan dokumentasi MWC NU Cikakak.">
    <meta property="og:type" content="website">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/site.css') }}?v={{ filemtime(public_path('assets/site.css')) }}">
    @stack('head')
</head>
<body>
    <a class="skip-link" href="#main-content">Lewati ke konten</a>
    <div class="site-noise" aria-hidden="true"></div>
    <header class="site-header" data-header>
        <div class="container nav-wrap" data-nav-shell>
            <a href="{{ route('home') }}" class="brand" aria-label="MWC NU Cikakak, beranda">
                <span class="brand-mark">NU</span><span><strong>MWC NU</strong><small>Cikakak · Wangon</small></span>
            </a>
            <button class="icon-btn menu-toggle" type="button" data-menu-toggle aria-expanded="false" aria-controls="site-nav" aria-label="Buka menu">☰</button>
            <nav id="site-nav" class="site-nav" data-mobile-menu aria-label="Navigasi utama">
                <a href="{{ route('home') }}">Beranda</a>
                <a href="{{ route('tentang') }}">Tentang</a>
                <a href="{{ route('pengurus.index') }}">Kepengurusan</a>
                <a href="{{ route('berita.index') }}">Berita</a>
                <a href="{{ route('kegiatan.index') }}">Kegiatan</a>
                <a href="{{ route('galeri.index') }}">Galeri</a>
                <a href="{{ route('warga-nu.index') }}" class="nav-member-link"><span aria-hidden="true">✦</span> Warga NU</a>
                <a href="{{ route('kontak') }}">Kontak</a>
                <button class="sound-toggle" type="button" data-sound-toggle aria-pressed="true"><span>◉</span> Suara On</button>
            </nav>
        </div>
    </header>
    <main id="main-content">@yield('content')</main>
    <footer class="site-footer">
        <div class="container footer-grid">
            <div><a href="{{ route('home') }}" class="brand brand-light"><span class="brand-mark">NU</span><span><strong>MWC NU</strong><small>Cikakak · Wangon</small></span></a><p class="footer-copy">Ruang informasi dan dokumentasi organisasi yang tumbuh bersama warga, menjaga tradisi, dan merawat kemaslahatan.</p></div>
            <div><h3>Navigasi</h3><a href="{{ route('tentang') }}">Tentang</a><a href="{{ route('pengurus.index') }}">Kepengurusan</a><a href="{{ route('berita.index') }}">Berita</a><a href="{{ route('kegiatan.index') }}">Kegiatan</a><a href="{{ route('warga-nu.index') }}">Warga NU</a></div>
            <div><h3>Kontak</h3><p>Desa Cikakak, Kecamatan Wangon<br>Kabupaten Banyumas, Jawa Tengah</p><a href="mailto:halo@mwc-nu-cikakak.test">halo@mwc-nu-cikakak.test</a><a href="tel:+622511234567">+62 251 123 4567</a></div>
        </div>
        <div class="container footer-bottom"><span>© {{ date('Y') }} MWC NU Cikakak. Prototype organisasi.</span><a href="{{ route('admin.login') }}">Admin</a></div>
    </footer>
    <div class="toast-stack" data-toast-stack aria-live="polite" aria-atomic="true"></div>
    @if(session('success'))<div data-flash-success="{{ session('success') }}"></div>@endif
    @if(session('error'))<div data-flash-error="{{ session('error') }}"></div>@endif
    <script src="{{ asset('assets/site.js') }}?v={{ filemtime(public_path('assets/site.js')) }}" defer></script>
    <script src="{{ asset('assets/premium.js') }}?v={{ filemtime(public_path('assets/premium.js')) }}" defer></script>
    @stack('scripts')
</body>
</html>
