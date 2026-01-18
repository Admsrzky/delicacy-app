<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Resep Lengkap - Delicacy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#FBFBF9] text-stone-800">
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-stone-200">
        <div class="flex items-center justify-between px-6 py-4 mx-auto max-w-7xl">
            <h1 class="text-2xl font-bold text-orange-600 cursor-pointer" onclick="window.location.href='/'">DELI<span class="text-stone-800">CACY.</span></h1>
            <a href="/" class="text-sm font-bold text-stone-500 hover:text-orange-600 transition">← Kembali ke Beranda</a>
        </div>
    </nav>

    <header class="max-w-7xl mx-auto px-6 pt-16 pb-12 text-center">
        <span class="text-orange-600 text-xs font-black uppercase tracking-[0.3em] mb-4 block">Eksplorasi Rasa</span>
        <h2 class="text-5xl font-bold leading-tight mb-4 text-stone-900">Semua Koleksi Resep</h2>
        <p class="text-stone-500 max-w-2xl mx-auto">Temukan berbagai hidangan lezat mulai dari camilan ringan hingga hidangan utama yang menggugah selera.</p>
    </header>

    <main class="px-6 pb-24 mx-auto max-w-7xl">
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse($recipes as $recipe)
                <div class="group bg-white rounded-[2.5rem] overflow-hidden border border-stone-100 hover:shadow-2xl hover:shadow-orange-100 transition-all duration-500 flex flex-col h-full">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('storage/' . $recipe->image) }}"
                             alt="{{ $recipe->title }}"
                             class="object-cover w-full h-full transition duration-700 group-hover:scale-110">
                        <div class="absolute top-5 right-5 bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-2xl text-[10px] font-bold uppercase tracking-tighter shadow-sm">
                            {{ $recipe->difficulty }}
                        </div>
                    </div>

                    <div class="p-8 flex flex-col flex-grow">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-orange-600 text-[10px] font-black uppercase tracking-widest">{{ $recipe->category->name }}</span>
                            <span class="text-stone-300 text-[10px]">•</span>
                            <span class="text-stone-400 text-[10px] font-bold">{{ $recipe->cooking_time }} Menit</span>
                        </div>

                        <h4 class="text-xl font-bold text-stone-900 group-hover:text-orange-600 transition-colors mb-4 flex-grow">
                            {{ $recipe->title }}
                        </h4>

                        <div class="flex items-center justify-between pt-6 border-t border-stone-50">
                            <div class="flex items-center gap-1.5 text-orange-400 font-bold">
                                <span class="text-sm">★</span>
                                <span class="text-xs text-stone-600 italic">{{ number_format($recipe->averageRating(), 1) }}</span>
                            </div>
                            <a href="{{ route('recipe.show', $recipe->id) }}"
                               class="text-xs font-bold px-5 py-2.5 bg-stone-900 text-white rounded-xl hover:bg-orange-600 transition shadow-lg shadow-stone-200">
                                Detail Resep
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-stone-400 italic text-lg">Maaf, belum ada resep yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-20 flex justify-center">
            <div class="bg-white px-4 py-3 rounded-3xl border border-stone-100 shadow-sm">
                {{ $recipes->links() }}
            </div>
        </div>
    </main>

    <footer class="py-12 border-t border-stone-100 text-center">
        <p class="text-sm text-stone-400 font-medium">&copy; 2024 DELICACY. Dibuat dengan penuh rasa.</p>
    </footer>
</body>
</html>
