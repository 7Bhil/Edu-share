<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EduShare - Connect & Share</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-slate-950 text-white min-h-screen flex flex-col overflow-x-hidden" style="font-family: 'Inter', sans-serif;">

        {{-- Background glow --}}
        <div class="fixed inset-0 -z-10 pointer-events-none">
            <div class="absolute top-[-20%] left-1/2 -translate-x-1/2 w-[800px] h-[600px] rounded-full bg-indigo-600/10 blur-[120px]"></div>
            <div class="absolute bottom-0 right-0 w-[500px] h-[400px] rounded-full bg-teal-500/5 blur-[100px]"></div>
        </div>

        {{-- ── NAVBAR ── --}}
        <header class="fixed inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between px-8 py-5 max-w-screen-xl mx-auto">
                {{-- Logo --}}
                <a href="/" class="flex items-center gap-2">
                    <x-application-logo class="w-7 h-7 text-indigo-500" />
                    <span class="font-bold text-lg text-white">EduShare</span>
                </a>

                {{-- Right side --}}
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-slate-300 hover:text-white transition-colors">
                            Dashboard <span aria-hidden="true">→</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-300 hover:text-white transition-colors">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="rounded-full bg-indigo-600 hover:bg-indigo-500 px-5 py-2 text-sm font-semibold text-white transition-all hover:scale-105 shadow-lg shadow-indigo-600/20">
                                Sign up
                            </a>
                        @endif
                    @endauth
                </div>
            </nav>
        </header>

        <main class="flex-grow">

            {{-- ── HERO ── --}}
            <section class="flex flex-col items-center justify-center text-center px-6 min-h-screen pt-20 pb-10">
                <h1 class="text-5xl sm:text-6xl font-bold tracking-tight leading-tight mb-6 max-w-2xl">
                    Welcome to <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-teal-400">EduShare</span>
                </h1>
                <p class="text-slate-400 text-lg leading-relaxed max-w-xl mb-10">
                    The modern platform connecting students and professors. Share resources, publish ideas, and collaborate in an elegant academic environment.
                </p>
                <div class="flex flex-col items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="rounded-full bg-indigo-600 hover:bg-indigo-500 px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/25 transition-all hover:scale-105">
                            Accéder au tableau de bord
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="rounded-full bg-indigo-600 hover:bg-indigo-500 px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/25 transition-all hover:scale-105">
                            Get started for free
                        </a>
                    @endauth
                    <a href="#articles" class="text-sm font-semibold text-slate-300 hover:text-white transition-colors">
                        Learn more →
                    </a>
                </div>
            </section>

            {{-- ── ARTICLES ── --}}
            <section id="articles" class="py-20 border-t border-slate-800/60">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">

                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-white mb-2">Dernières Publications</h2>
                        <p class="text-slate-400">Découvrez les réflexions et travaux récents de notre communauté.</p>
                    </div>

                    {{-- Search --}}
                    <form action="{{ route('welcome') }}" method="GET" class="flex justify-center mb-8">
                        <div class="relative w-full max-w-md">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Rechercher un article..."
                                class="w-full bg-slate-900 border border-slate-700 text-white placeholder-slate-500 rounded-full py-2.5 pl-11 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                            >
                            <svg class="w-4 h-4 absolute left-4 top-3 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                    </form>

                    {{-- Category Tabs --}}
                    <div class="flex justify-center flex-wrap gap-2 mb-10">
                        <a href="{{ route('welcome', array_merge(request()->except('category'), ['category' => null])) }}"
                           class="px-4 py-1.5 rounded-full text-sm font-medium transition-all {{ !request('category') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'bg-slate-800 text-slate-400 hover:bg-slate-700 hover:text-white' }}">
                            Tout voir
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ route('welcome', array_merge(request()->query(), ['category' => $category->id])) }}"
                               class="px-4 py-1.5 rounded-full text-sm font-medium transition-all {{ request('category') == $category->id ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'bg-slate-800 text-slate-400 hover:bg-slate-700 hover:text-white' }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>

                    {{-- Grid --}}
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($posts as $post)
                            <article class="group bg-slate-900 border border-slate-800 rounded-2xl p-6 flex flex-col justify-between hover:border-indigo-500/50 hover:-translate-y-1 transition-all duration-200 hover:shadow-xl hover:shadow-indigo-500/5">
                                <div>
                                    <div class="flex items-center gap-3 mb-4">
                                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-indigo-600/15 text-indigo-400 border border-indigo-500/20">
                                            {{ $post->category->name }}
                                        </span>
                                        <time class="text-xs text-slate-500">{{ $post->created_at->translatedFormat('d M Y') }}</time>
                                    </div>
                                    <h3 class="font-bold text-white text-base mb-3 group-hover:text-indigo-400 transition-colors leading-snug">
                                        <a href="{{ route('posts.show', $post->slug) }}" class="stretched-link">
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                    <p class="text-slate-400 text-sm leading-relaxed line-clamp-3">
                                        {{ Str::limit(strip_tags($post->content), 120) }}
                                    </p>
                                </div>
                                <div class="flex items-center justify-between mt-6 pt-4 border-t border-slate-800">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-full bg-indigo-600/20 border border-indigo-500/30 flex items-center justify-center text-xs font-bold text-indigo-400">
                                            {{ substr($post->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-white">{{ $post->user->name }}</p>
                                            <p class="text-xs text-slate-500">{{ $post->user->role == 'teacher' ? 'Enseignant' : 'Étudiant' }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('posts.show', $post->slug) }}" class="text-xs font-semibold text-indigo-400 hover:text-indigo-300 transition-colors">
                                        Lire →
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    @if($posts->isEmpty())
                        <div class="text-center py-20 text-slate-500 italic">
                            Aucun article n'a encore été publié.
                        </div>
                    @endif

                </div>
            </section>

        </main>

        {{-- ── FOOTER ── --}}
        <footer class="border-t border-slate-800/60 py-8 text-center">
            <p class="text-slate-500 text-sm">© {{ date('Y') }} EduShare. Plateforme académique universitaire.</p>
        </footer>

    </body>
</html>
