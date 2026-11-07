<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — MWC NU Cikakak</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F7F4EC] text-[#232620] font-body antialiased min-h-screen flex items-center justify-center px-5">

    <div class="w-full max-w-sm">
        <div class="text-center mb-8">
            <p class="font-heading text-2xl text-[#1F3A22]">MWC NU Cikakak</p>
            <p class="text-xs uppercase tracking-widest text-[#232620]/50 mt-1">Login Admin</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 border-l-4 border-red-700 bg-red-50 px-4 py-3 text-sm">
                <ul class="list-disc pl-4 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}" class="space-y-5 border-t border-[#232620]/15 pt-6">
            @csrf

            <div>
                <label for="email" class="block text-xs uppercase tracking-widest mb-1.5">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
            </div>

            <div>
                <label for="password" class="block text-xs uppercase tracking-widest mb-1.5">Kata Sandi</label>
                <input id="password" type="password" name="password" required
                    class="w-full border border-[#232620]/25 bg-white px-3 py-2.5 text-sm focus:outline-none focus:border-[#1F3A22]">
            </div>

            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="remember">
                Ingat saya
            </label>

            <button type="submit" class="w-full bg-[#1F3A22] text-white py-2.5 text-sm uppercase tracking-widest hover:bg-[#17301A]">
                Masuk
            </button>
        </form>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-xs text-[#232620]/60 hover:text-[#1F3A22]">&larr; Kembali ke Situs</a>
        </div>
    </div>

</body>
</html>
