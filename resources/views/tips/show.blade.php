<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tip->title }} - Tips Dapur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#FBFBF9] text-stone-800">
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-stone-200">
        <div class="flex items-center justify-between px-6 py-4 mx-auto max-w-7xl">
            <h1 class="text-2xl font-bold text-orange-600" onclick="window.location.href='/'">DELI<span class="text-stone-800">CACY.</span></h1>
            <a href="/" class="text-sm font-bold text-stone-500 hover:text-orange-600">← Kembali</a>
        </div>
    </nav>

    <article class="max-w-4xl mx-auto px-6 py-20">
        <div class="text-center mb-12">
            <span class="text-orange-600 font-bold text-xs uppercase tracking-widest">{{ $tip->category->name }}</span>
            <h1 class="text-5xl font-bold mt-4 mb-6 leading-tight">{{ $tip->title }}</h1>
            <div class="flex justify-center items-center gap-4 text-stone-400 text-sm">
                <span>Oleh Delicacy Hub</span>
                <span>•</span>
                <span>{{ $tip->created_at->format('d M Y') }}</span>
            </div>
        </div>

        <img src="{{ asset('storage/' . $tip->image) }}" class="w-full h-[500px] object-cover rounded-[3rem] shadow-xl mb-16">

        <div class="prose prose-stone lg:prose-xl max-w-none text-stone-600 leading-[1.8]">
            {!! $tip->content !!}
        </div>

        <div class="mt-20 p-10 bg-orange-600 rounded-[3rem] text-white text-center">
            <h3 class="text-2xl font-bold mb-4">Ingin tips menarik lainnya?</h3>
            <p class="mb-8 opacity-90">Daftarkan email Anda untuk berlangganan resep dan tips eksklusif mingguan.</p>
            <a href="{{ route('register') }}" class="inline-block bg-white text-orange-600 px-10 py-4 rounded-3xl font-bold hover:bg-stone-100 transition shadow-lg">Gabung Komunitas</a>
        </div>
    </article>
</body>
</html>
