<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#087f4d">
    <title>Login Admin — MWC NU Cikakak</title>
    <link rel="stylesheet" href="{{ asset('assets/site.css') }}">
</head>
<body class="login-page">
    <main class="login-card" aria-labelledby="login-title">
        <a class="brand" href="{{ route('home') }}" aria-label="Kembali ke Beranda">
            <span class="brand-mark">NU</span>
            <span><strong>MWC NU</strong><small>Cikakak · Wangon</small></span>
        </a>
        <span class="eyebrow">Administrator</span>
        <h1 id="login-title">Selamat datang kembali.</h1>
        <p>Masuk untuk mengelola kepengurusan, berita, kegiatan, agenda, galeri, lembaga, warga NU, serta data lainnya.</p>
        <div class="admin-alert error" role="alert" {{ session('error') ? '' : 'hidden' }}>{{ session('error') }}</div>
        <div class="admin-alert error" role="alert" {{ $errors->any() ? '' : 'hidden' }}>{{ $errors->first() }}</div>
        <form method="POST" action="{{ route('admin.login.attempt') }}" novalidate>
            @csrf
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            <label class="check" for="remember">
                <input id="remember" type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                <span>Ingat saya</span>
            </label>
            <button class="btn btn-primary btn-block" type="submit">Masuk ke panel <span aria-hidden="true">→</span></button>
        </form>
    </main>
</body>
</html>
