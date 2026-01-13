<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Delicacy Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-[#FBFBF9] text-stone-800 antialiased">

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="mb-8">
            <h1 class="text-4xl font-bold tracking-tighter text-orange-600 cursor-pointer" onclick="window.location.href='/'">
                DELI<span class="text-stone-800">CACY.</span>
            </h1>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-10 py-12 bg-white border border-stone-100 shadow-sm rounded-[3rem] overflow-hidden">
            <div class="mb-8 text-center">
                <h2 class="text-2xl font-bold text-stone-800">Selamat Datang Kembali</h2>
                <p class="text-stone-500 text-sm mt-2">Masuk untuk mengakses resep premium Anda.</p>
            </div>

            <x-validation-errors class="mb-4" />

            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-2xl border border-green-100">
                    {{ $value }}
                </div>
            @endsession

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label for="email" class="block text-xs font-black uppercase tracking-widest text-stone-400 mb-2">Alamat Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                            class="w-full px-5 py-4 bg-stone-50 border border-stone-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition shadow-sm"
                            placeholder="nama@email.com">
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-xs font-black uppercase tracking-widest text-stone-400">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a class="text-[10px] font-bold uppercase tracking-tighter text-orange-600 hover:underline" href="{{ route('password.request') }}">
                                    Lupa Sandi?
                                </a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full px-5 py-4 bg-stone-50 border border-stone-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition shadow-sm"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="block mt-6">
                    <label for="remember_me" class="flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox" name="remember" class="w-5 h-5 rounded-lg border-stone-200 text-orange-600 shadow-sm focus:ring-orange-500 transition cursor-pointer">
                        <span class="ms-3 text-sm text-stone-500 group-hover:text-stone-800 transition">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <div class="mt-10">
                    <button type="submit" class="w-full py-4 bg-stone-900 text-white rounded-3xl font-bold hover:bg-orange-600 hover:shadow-xl active:scale-[0.98] transition-all duration-300">
                        Masuk Sekarang
                    </button>
                </div>

                <div class="mt-8 text-center">
                    <p class="text-sm text-stone-500">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-orange-600 font-bold hover:underline">Daftar Akun Baru</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
