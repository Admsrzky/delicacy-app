<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Profil - Delicacy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FBFBF9; }
        /* Menghilangkan bayangan default Jetstream agar lebih clean */
        .shadow-md { shadow: none !important; border: 1px solid #f5f5f4; }
    </style>
</head>
<body class="text-stone-800">

    <nav class="sticky top-0 z-50 border-b bg-white/80 backdrop-blur-md border-stone-200">
        <div class="flex items-center justify-between px-6 py-4 mx-auto max-w-7xl">
            <h1 class="text-2xl font-bold tracking-tighter text-orange-600 cursor-pointer" onclick="window.location.href='/'">
                DELI<span class="text-stone-800">CACY.</span>
            </h1>
            <a href="/" class="text-sm font-bold transition text-stone-500 hover:text-orange-600">← Kembali ke Beranda</a>
        </div>
    </nav>

    <div class="py-12">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">

            <div class="mb-12">
                <span class="text-xs italic font-bold tracking-widest text-orange-600 uppercase">Pengaturan Akun</span>
                <h2 class="mt-2 text-4xl font-bold text-stone-800">Manajemen <span class="text-orange-600">Profil.</span></h2>
                <p class="mt-2 text-stone-500">Perbarui informasi dasar, keamanan, dan sesi aktif Anda secara aman.</p>
            </div>

            <div class="space-y-10">

                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    <div class="bg-white p-2 rounded-[3rem] shadow-sm border border-stone-100">
                        <div class="p-6">
                            @livewire('profile.update-profile-information-form')
                        </div>
                    </div>
                @endif

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <div class="bg-white p-2 rounded-[3rem] shadow-sm border border-stone-100">
                        <div class="p-6">
                            @livewire('profile.update-password-form')
                        </div>
                    </div>
                @endif

                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <div class="bg-red-50/30 p-2 rounded-[3rem] border border-red-100">
                        <div class="p-6">
                            @livewire('profile.delete-user-form')
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <footer class="py-12 text-center text-stone-400 text-xs uppercase tracking-[0.2em] font-bold">
        &copy; 2026 Delicacy Hub - Secure Profile Management
    </footer>

    @stack('modals')
    @livewireScripts
</body>
</html>
