<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Delicacy Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#FBFBF9] text-stone-800 antialiased">

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 pb-12">
        <div class="mb-8">
            <h1 class="text-4xl font-bold tracking-tighter text-orange-600 cursor-pointer" onclick="window.location.href='/'">
                DELI<span class="text-stone-800">CACY.</span>
            </h1>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-10 py-12 bg-white border border-stone-100 shadow-sm rounded-[3rem] overflow-hidden">
            <div class="mb-8 text-center">
                <h2 class="text-2xl font-bold text-stone-800">Bergabung Bersama Kami</h2>
                <p class="text-stone-500 text-sm mt-2">Buat akun untuk mulai menjelajahi dan menyimpan resep favorit Anda.</p>
            </div>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-xs font-black uppercase tracking-widest text-stone-400 mb-2">Nama Lengkap</label>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                            class="w-full px-5 py-4 bg-stone-50 border border-stone-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition shadow-sm"
                            placeholder="Contoh: Elzan">
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-black uppercase tracking-widest text-stone-400 mb-2">Alamat Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                            class="w-full px-5 py-4 bg-stone-50 border border-stone-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition shadow-sm"
                            placeholder="nama@email.com">
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-black uppercase tracking-widest text-stone-400 mb-2">Kata Sandi</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="w-full px-5 py-4 bg-stone-50 border border-stone-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition shadow-sm"
                            placeholder="Minimal 8 karakter">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-black uppercase tracking-widest text-stone-400 mb-2">Konfirmasi Kata Sandi</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                            class="w-full px-5 py-4 bg-stone-50 border border-stone-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition shadow-sm"
                            placeholder="Ulangi kata sandi">
                    </div>
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-6">
                        <label for="terms" class="flex items-center group cursor-pointer">
                            <input id="terms" type="checkbox" name="terms" required class="w-5 h-5 rounded-lg border-stone-200 text-orange-600 shadow-sm focus:ring-orange-500 transition cursor-pointer">
                            <div class="ms-3 text-sm text-stone-500 group-hover:text-stone-800 transition">
                                {!! __('Saya setuju dengan :terms_of_service dan :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline font-bold text-orange-600 hover:text-orange-700">'.__('Ketentuan Layanan').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline font-bold text-orange-600 hover:text-orange-700">'.__('Kebijakan Privasi').'</a>',
                                ]) !!}
                            </div>
                        </label>
                    </div>
                @endif

                <div class="mt-10">
                    <button type="submit" class="w-full py-4 bg-stone-900 text-white rounded-3xl font-bold hover:bg-orange-600 hover:shadow-xl active:scale-[0.98] transition-all duration-300">
                        Daftar Akun Baru
                    </button>
                </div>

                <div class="mt-8 text-center border-t border-stone-50 pt-6">
                    <p class="text-sm text-stone-500">
                        Sudah memiliki akun?
                        <a href="{{ route('login') }}" class="text-orange-600 font-bold hover:underline">Masuk di sini</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
