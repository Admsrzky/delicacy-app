<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - Delicacy Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
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
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-stone-800">Pemulihan Akun</h2>
                <p class="mt-4 text-sm text-stone-500 leading-relaxed">
                    {{ __('Lupa kata sandi? Tidak masalah. Beritahu kami alamat email Anda dan kami akan mengirimkan tautan pemulihan kata sandi yang memungkinkan Anda memilih yang baru.') }}
                </p>
            </div>

            <x-validation-errors class="mb-4" />

            @session('status')
                <div class="mb-4 font-bold text-sm text-green-600 bg-green-50 p-4 rounded-2xl border border-green-100 text-center">
                    {{ $value }}
                </div>
            @endsession

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label for="email" class="block text-xs font-black uppercase tracking-widest text-stone-400 mb-2">Alamat Email Terdaftar</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                            class="w-full px-5 py-4 bg-stone-50 border border-stone-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition shadow-sm"
                            placeholder="nama@email.com">
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit" class="w-full py-4 bg-stone-900 text-white rounded-3xl font-bold hover:bg-orange-600 hover:shadow-xl active:scale-[0.98] transition-all duration-300">
                        {{ __('Kirim Tautan Pemulihan') }}
                    </button>
                </div>

                <div class="mt-8 text-center border-t border-stone-50 pt-6">
                    <a href="{{ route('login') }}" class="text-sm font-bold text-stone-400 hover:text-orange-600 transition">
                        ← Kembali ke Halaman Masuk
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
