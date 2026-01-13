<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recipe->title }} - Delicacy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#FBFBF9] text-stone-800">
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-stone-200">
        <div class="flex items-center justify-between px-6 py-4 mx-auto max-w-7xl">
            <h1 class="text-2xl font-bold text-orange-600 cursor-pointer" onclick="window.location.href='/'">DELI<span class="text-stone-800">CACY.</span></h1>
            <a href="/" class="text-sm font-bold text-stone-500 hover:text-orange-600">← Kembali ke Beranda</a>
        </div>
    </nav>

    <main class="px-6 py-12 mx-auto max-w-7xl">
        <div class="grid gap-12 lg:grid-cols-2">
            <div class="relative group">
                <img src="{{ asset('storage/' . $recipe->image) }}" class="w-full h-[500px] object-cover rounded-[3rem] shadow-2xl transition duration-500 group-hover:scale-[1.01]">
                <div class="absolute top-8 left-8">
                    <span class="px-5 py-2 text-xs font-black tracking-widest uppercase bg-white/90 backdrop-blur rounded-2xl shadow-sm">{{ $recipe->category->name }}</span>
                </div>
            </div>

            <div>
                <div class="flex items-center gap-6 mb-6 text-sm font-bold tracking-widest uppercase text-stone-400">
                    <span>⏱ {{ $recipe->cooking_time }} Menit</span>
                    <span class="text-orange-600">🔥 {{ $recipe->difficulty }}</span>
                    <span class="text-orange-400">★ {{ number_format($recipe->averageRating(), 1) }}</span>
                </div>
                <h2 class="text-5xl font-bold leading-tight mb-8">{{ $recipe->title }}</h2>

                <div class="mb-10">
                    <h4 class="pb-3 mb-6 text-xl font-bold border-b border-stone-200">Bahan-Bahan Utama</h4>
                    <ul class="grid grid-cols-1 gap-4 sm:grid-cols-2 text-stone-600">
                        @foreach($recipe->ingredients as $item)
                            <li class="flex items-center gap-3 p-3 bg-white rounded-2xl border border-stone-100 shadow-sm">
                                <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                                <span>{{ $item['item'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="space-y-6">
                    <h4 class="pb-3 mb-2 text-xl font-bold border-b border-stone-200">Langkah Pembuatan</h4>
                    @foreach($recipe->steps as $index => $step)
                        <div class="p-6 bg-white border border-stone-100 rounded-3xl shadow-sm">
                            <span class="text-orange-600 font-black text-xs uppercase tracking-tighter">Step {{ $index + 1 }}</span>
                            <h5 class="mt-1 mb-2 font-bold text-lg text-stone-800">{{ $step['title'] }}</h5>
                            <p class="text-stone-500 leading-relaxed">{{ $step['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <section class="mt-24 border-t border-stone-200 pt-16">
            <h3 class="text-3xl font-bold text-center mb-12">Ulasan Pembaca</h3>

            <div class="max-w-3xl mx-auto space-y-6">
                @forelse($recipe->comments()->where('is_visible', true)->latest()->get() as $comment)
                <div class="bg-white p-8 rounded-[2.5rem] border border-stone-100 shadow-sm hover:border-orange-200 transition">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex gap-4">
                            <img src="{{ $comment->user->profile_photo_url }}" class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h5 class="font-bold text-stone-800">{{ $comment->user->name }}</h5>
                                <div class="text-orange-400 text-xs">
                                    @for($i=0; $i<$comment->rating; $i++) ★ @endfor
                                </div>
                            </div>
                        </div>
                        <span class="text-stone-400 text-[10px] font-bold uppercase tracking-widest">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-stone-600 italic leading-relaxed">"{{ $comment->comment }}"</p>
                </div>
                @empty
                <p class="text-center text-stone-400 italic">Belum ada ulasan untuk resep ini. Berikan ulasan pertama Anda!</p>
                @endforelse

                @auth
                <form action="{{ route('comment.store', $recipe->id) }}" method="POST" class="mt-12 bg-white rounded-[2.5rem] p-3 flex shadow-xl border border-stone-100">
                    @csrf
                    <div class="flex items-center flex-grow px-4">
                        <select name="rating" class="mr-2 font-bold text-orange-600 bg-transparent outline-none">
                            <option value="5">5 ★</option>
                            <option value="4">4 ★</option>
                        </select>
                        <input type="text" name="comment" placeholder="Tulis ulasan Anda..." class="w-full py-3 bg-transparent border-none text-stone-800 focus:outline-none" required>
                    </div>
                    <button type="submit" class="px-8 py-4 font-bold text-white transition bg-orange-600 rounded-3xl hover:bg-orange-700">Kirim</button>
                </form>
                @endauth
            </div>
        </section>
    </main>
</body>
</html>z
