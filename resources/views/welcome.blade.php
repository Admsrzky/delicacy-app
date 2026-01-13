<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delicacy - Portal Resep Premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; scroll-behavior: smooth; }
        .glass { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#FBFBF9] text-stone-800" x-data="{ activeTab: 'Semua' }">

    <nav class="sticky top-0 z-50 border-b glass border-stone-200">
        <div class="flex items-center justify-between px-6 py-4 mx-auto max-w-7xl">
            <h1 class="text-2xl font-bold tracking-tighter text-orange-600 cursor-pointer" onclick="window.location.href='/'">DELI<span class="text-stone-800">CACY.</span></h1>

            <div class="hidden gap-8 text-sm font-medium md:flex">
                <a href="/" class="transition hover:text-orange-600">Beranda</a>
                <a href="#koleksi-lengkap" class="transition hover:text-orange-600">Resep</a>
                <a href="#tips-masak" class="transition hover:text-orange-600">Tips</a>
            </div>

            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <div class="relative" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open" class="flex items-center gap-3 focus:outline-none group">
                                <div class="hidden text-right sm:block">
                                    <p class="text-xs font-bold leading-none text-stone-800">{{ auth()->user()->name }}</p>
                                    <p class="text-[10px] text-stone-500 uppercase tracking-widest mt-1">Akun Saya</p>
                                </div>
                                <div class="relative">
                                    <img src="{{ auth()->user()->profile_photo_url }}"
                                         alt="{{ auth()->user()->name }}"
                                         class="object-cover w-10 h-10 transition-all border-2 border-orange-100 rounded-full group-hover:border-orange-500">
                                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                                </div>
                            </button>

                            <div x-show="open"
                                 x-cloak
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                                 class="absolute right-0 z-50 w-56 py-3 mt-3 overflow-hidden bg-white border shadow-xl border-stone-100 rounded-3xl">

                                <div class="px-5 py-2 mb-2 border-b border-stone-50">
                                    <p class="text-[10px] font-black text-stone-400 uppercase tracking-widest">Akses Cepat</p>
                                </div>

                                <a href="{{ route('user.profile') }}" class="flex items-center gap-3 px-5 py-3 text-sm transition text-stone-600 hover:bg-stone-50 hover:text-orange-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Profil Saya
                                </a>

                                <div class="pt-2 mt-2 border-t border-stone-50">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex items-center w-full gap-3 px-5 py-3 text-sm text-left text-red-600 transition hover:bg-red-50">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                            Keluar Sesi
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold transition hover:text-orange-600">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-stone-900 text-white px-6 py-2.5 rounded-full text-sm font-semibold hover:bg-orange-600 hover:shadow-lg transition-all">Daftar</a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <header class="grid items-center gap-12 px-6 pt-16 pb-12 mx-auto max-w-7xl md:grid-cols-2">
        <div x-data x-intersect="$el.classList.add('opacity-100')">
            <span class="text-xs italic font-bold tracking-widest text-orange-600 uppercase">Resep Minggu Ini</span>
            <h2 class="mt-4 text-5xl md:text-7xl font-bold leading-[1.1]">Rasa Mewah di <span class="text-orange-600">Meja Makan</span> Anda.</h2>
            <p class="max-w-md mt-6 text-lg leading-relaxed text-stone-500">Kumpulan resep pilihan dari chef profesional yang dikurasi khusus untuk dapur rumah tangga.</p>
        </div>
        <div class="relative">
            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&q=80&w=1000" class="rounded-[2rem] shadow-2xl rotate-2 hover:rotate-0 transition-transform duration-500 object-cover h-[450px] w-full" alt="Hero Food">
        </div>
    </header>

    @if($featured)
    <main class="px-6 py-12 mx-auto max-w-7xl" id="unggulan">
        <div class="bg-white rounded-[3rem] shadow-sm border border-stone-100 overflow-hidden lg:flex">
            <div class="lg:w-1/2 h-[400px] lg:h-auto overflow-hidden relative">
                <img src="{{ asset('storage/' . $featured->image) }}" class="object-cover w-full h-full">
                <div class="absolute top-8 left-8">
                    <span class="px-4 py-2 text-xs font-black tracking-widest uppercase shadow-sm bg-white/90 backdrop-blur rounded-xl">{{ $featured->category->name }}</span>
                </div>
            </div>

            <div class="p-8 lg:w-1/2 md:p-16">
                <div class="flex items-center gap-6 mb-8 text-sm font-bold tracking-widest uppercase text-stone-400">
                    <span class="flex items-center gap-2">⏱ {{ $featured->cooking_time }} Menit</span>
                    <span class="flex items-center gap-2 text-orange-600">🔥 {{ $featured->difficulty }}</span>
                    <span class="flex items-center gap-2 text-orange-400">★ {{ number_format($featured->averageRating(), 1) }}</span>
                </div>

                <h3 class="mb-6 text-4xl font-bold leading-tight">{{ $featured->title }}</h3>

                <div class="mb-10">
                    <h4 class="pb-2 mb-4 text-lg font-bold border-b">Bahan-Bahan:</h4>
                    <ul class="grid grid-cols-2 gap-3 text-stone-500">
                        @foreach($featured->ingredients as $item)
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-orange-400 rounded-full"></span>
                                <span>{{ $item['item'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="space-y-4">
                    @foreach($featured->steps as $index => $step)
                        <div class="overflow-hidden border border-stone-100 rounded-2xl" x-data="{ isOpen: {{ $index === 0 ? 'true' : 'false' }} }">
                            <button @click="isOpen = !isOpen" class="flex items-center justify-between w-full p-5 text-left transition bg-stone-50/50 hover:bg-stone-50">
                                <span class="flex gap-4 font-bold">
                                    <span class="text-orange-600">Step {{ $index + 1 }}</span>
                                    <span>{{ $step['title'] }}</span>
                                </span>
                                <span :class="isOpen ? 'rotate-180' : ''" class="text-xs transition-transform">▼</span>
                            </button>
                            <div x-show="isOpen" x-collapse class="p-5 leading-relaxed border-t text-stone-500 border-stone-100">
                                {{ $step['desc'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    @endif

    <section id="koleksi-lengkap" class="max-w-7xl mx-auto px-6 py-20 bg-stone-50/50 rounded-[3rem] my-10">
        <div class="mb-16 text-center">
            <h3 class="mb-4 text-4xl font-bold">Resep Terbaru</h3>
            <p class="text-stone-500">Eksplorasi hidangan lezat berdasarkan preferensi Anda.</p>
        </div>

        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <button @click="activeTab = 'Semua'"
                    :class="activeTab === 'Semua' ? 'bg-orange-600 text-white shadow-lg' : 'bg-white text-stone-600 border border-stone-200'"
                    class="px-8 py-3 text-sm font-bold transition-all rounded-2xl">Semua</button>
            @foreach($categories as $cat)
                <button @click="activeTab = '{{ $cat->name }}'"
                        :class="activeTab === '{{ $cat->name }}' ? 'bg-orange-600 text-white shadow-lg' : 'bg-white text-stone-600 border border-stone-200'"
                        class="px-8 py-3 text-sm font-bold transition-all rounded-2xl">{{ $cat->name }}</button>
            @endforeach
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($recipes as $recipe)
                <div x-show="activeTab === 'Semua' || activeTab === '{{ $recipe->category->name }}'"
                     class="group bg-white rounded-[2rem] overflow-hidden border border-stone-100 hover:shadow-2xl transition-all duration-500">
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ asset('storage/' . $recipe->image) }}" class="object-cover w-full h-full transition duration-700 group-hover:scale-110">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-bold uppercase">{{ $recipe->difficulty }}</div>
                    </div>
                    <div class="p-6">
                        <span class="text-orange-600 text-[10px] font-black uppercase tracking-widest">{{ $recipe->category->name }}</span>
                        <h4 class="mt-1 text-lg font-bold transition group-hover:text-orange-600">{{ $recipe->title }}</h4>
                        <div class="flex items-center justify-between mt-4">
                            <div class="flex text-orange-400 text-[10px] font-bold italic">★ {{ number_format($recipe->averageRating(), 1) }}</div>
                            <a href="{{ route('recipe.show', $recipe->id) }}" class="text-xs font-bold underline transition text-stone-900 underline-offset-4 hover:text-orange-600">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section id="tips-masak" class="px-6 py-20 mx-auto max-w-7xl">
        <div class="flex items-center gap-4 mb-12">
            <div class="flex-grow h-px bg-stone-200"></div>
            <h3 class="px-4 text-3xl font-bold">Tips & Trik Dapur</h3>
            <div class="flex-grow h-px bg-stone-200"></div>
        </div>

        <div class="grid gap-10 md:grid-cols-2">
            @foreach($tips as $tip)
            <div class="flex flex-col md:flex-row gap-6 items-center group bg-white p-4 rounded-[2.5rem] border border-transparent hover:border-stone-100 transition-all hover:shadow-xl">
                <div class="w-full md:w-48 h-48 flex-shrink-0 overflow-hidden rounded-[2rem]">
                    <img src="{{ asset('storage/' . $tip->image) }}" class="object-cover w-full h-full transition duration-500 group-hover:scale-110">
                </div>
                <div>
                    <span class="text-xs font-bold text-orange-600 uppercase">{{ $tip->category->name }}</span>

                    <h4 class="mt-2 mb-3 text-xl font-bold leading-tight">{{ $tip->title }}</h4>

                    <div class="text-sm leading-relaxed text-stone-500 line-clamp-2">
                        {!! Str::limit(strip_tags($tip->content), 120) !!}
                    </div>
                    <a href="{{ route('tips.show', $tip->id) }}" class="inline-block mt-4 text-sm font-bold transition border-b-2 border-orange-200 text-stone-900 hover:border-orange-600">Baca Selengkapnya</a>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section class="py-24 mt-20 text-white bg-stone-900">
        <div class="max-w-3xl px-6 mx-auto">
            <div class="mb-12 text-center">
                <h3 class="mb-4 text-4xl font-bold">Ulasan Komunitas</h3>
                <p class="italic text-stone-400">Apa kata mereka tentang {{ $featured->title ?? 'Resep Kami' }}?</p>
            </div>

            <div class="mb-12 space-y-6">
                @if($featured)
                    @forelse($featured->comments()->where('is_visible', true)->latest()->get() as $comment)
                    <div class="bg-stone-800/50 p-8 rounded-[2.5rem] border border-white/10 hover:border-orange-500/30 transition-all">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex gap-4">
                                <img src="{{ $comment->user->profile_photo_url }}" class="object-cover w-12 h-12 border-2 rounded-full shadow-sm border-white/10">
                                <div>
                                    <h5 class="font-bold leading-tight text-white">{{ $comment->user->name }}</h5>
                                    <div class="mt-1 text-xs text-orange-400">
                                        @for($i=0; $i<$comment->rating; $i++) ★ @endfor
                                    </div>
                                </div>
                            </div>
                            <span class="text-stone-500 text-[10px] font-bold uppercase tracking-widest">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="italic leading-relaxed text-stone-300">"{{ $comment->comment }}"</p>
                    </div>
                    @empty
                    <div class="text-center py-10 border border-white/5 rounded-[2rem]">
                        <p class="italic text-stone-500">Belum ada ulasan untuk resep ini. Jadilah yang pertama!</p>
                    </div>
                    @endforelse
                @else
                    <div class="text-center py-10 bg-stone-800/30 rounded-[2rem]">
                        <p class="italic text-stone-500">Pilih resep unggulan di admin panel untuk melihat komentar.</p>
                    </div>
                @endif
            </div>

            @if($featured)
                @auth
                <form action="{{ route('comment.store', $featured->id) }}" method="POST" class="bg-white rounded-[2.5rem] p-3 flex shadow-2xl">
                    @csrf
                    <div class="flex items-center flex-grow px-4">
                        <select name="rating" class="mr-2 font-bold text-orange-600 bg-transparent outline-none">
                            <option value="5">5 ★</option>
                            <option value="4">4 ★</option>
                            <option value="3">3 ★</option>
                            <option value="2">2 ★</option>
                            <option value="1">1 ★</option>
                        </select>
                        <input type="text" name="comment" placeholder="Bagikan pengalaman masak Anda..." class="w-full py-3 bg-transparent border-none text-stone-800 focus:outline-none placeholder-stone-400" required>
                    </div>
                    <button type="submit" class="px-10 py-4 font-bold text-white transition bg-orange-600 rounded-3xl hover:bg-orange-700 active:scale-95">Kirim</button>
                </form>
                @else
                <div class="text-center p-12 border-2 border-dashed border-stone-800 rounded-[3rem]">
                    <p class="mb-6 text-stone-400">Punya pendapat tentang resep ini? Berikan rating dan komentar.</p>
                    <a href="{{ route('login') }}" class="inline-block px-10 py-4 font-bold text-white transition bg-orange-600 rounded-3xl hover:bg-orange-700">Masuk Sekarang</a>
                </div>
                @endauth
            @endif
        </div>
    </section>

    <footer class="py-12 text-center text-stone-400 text-xs uppercase tracking-[0.2em] font-bold border-t border-stone-100">
        Designed for Culinary Perfection &copy; 2026 Delicacy Hub
    </footer>

</body>
</html>
