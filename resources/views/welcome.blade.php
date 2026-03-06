<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EduShare - Connect & Share</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 flex flex-col min-h-screen selection:bg-primary-500 selection:text-white relative overflow-hidden">
        
        <!-- Decorative Background Elements -->
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-primary-600 to-secondary-400 opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>

        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="/" class="-m-1.5 p-1.5 flex items-center gap-2">
                        <x-application-logo class="w-8 h-8 text-primary-600 dark:text-primary-500" />
                        <span class="font-bold text-xl tracking-tight text-slate-900 dark:text-white">EduShare</span>
                    </a>
                </div>
                </div>
                <div class="hidden lg:flex lg:gap-x-12">
                    <form action="{{ route('welcome') }}" method="GET" class="relative group">
                        <input type="text" name="search" placeholder="Rechercher un article..." value="{{ request('search') }}" class="bg-slate-100 dark:bg-slate-900/50 border-none rounded-full py-1.5 pl-10 pr-4 text-xs w-64 focus:ring-1 focus:ring-primary-500 transition-all focus:w-80 outline-none">
                        <svg class="w-4 h-4 absolute left-3 top-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </form>
                </div>
                <div class="flex flex-1 justify-end items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold leading-6 text-slate-900 dark:text-white hover:text-primary-500 transition-colors">Dashboard <span aria-hidden="true">&rarr;</span></a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-slate-900 dark:text-white hover:text-primary-500 transition-colors">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="rounded-full bg-primary-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 transition-all hover:scale-105">Sign up</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </nav>
        </header>

        <main class="flex-grow isolate">
            <!-- Hero Section -->
            <div class="px-6 pt-14 lg:px-8">
                <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56 text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-6xl mb-6">
                        L'excellence académique par le <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary-600 to-secondary-500">Partage</span>
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-slate-600 dark:text-slate-400">
                        La plateforme moderne connectant étudiants et professeurs. Partagez vos ressources, publiez vos idées et collaborez dans un environnement académique de prestige.
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="rounded-full bg-primary-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 transition-all hover:scale-105">
                                Accéder au tableau de bord
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="rounded-full bg-primary-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 transition-all hover:scale-105">
                                Créer un compte gratuitement
                            </a>
                        @endauth
                        <a href="#articles" class="text-sm font-semibold leading-6 text-slate-900 dark:text-white hover:text-primary-500 transition-colors">
                            Voir les derniers articles <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Latest Articles Section -->
            <div id="articles" class="py-24 sm:py-32 bg-white/50 dark:bg-black/20 backdrop-blur-sm border-y border-slate-100 dark:border-slate-800">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center">
                        <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">Dernières Publications</h2>
                        <p class="mt-2 text-lg leading-8 text-slate-600 dark:text-slate-400">Découvrez les réflexions et travaux récents de notre communauté.</p>
                    </div>

                    <!-- Category Tabs -->
                    <div class="mt-12 flex justify-center flex-wrap gap-2">
                        <a href="{{ route('welcome', array_merge(request()->except('category'), ['category' => null])) }}" 
                           class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ !request('category') ? 'bg-primary-600 text-white shadow-lg shadow-primary-500/30' : 'bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800' }}">
                            Tout voir
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ route('welcome', array_merge(request()->query(), ['category' => $category->id])) }}" 
                               class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request('category') == $category->id ? 'bg-primary-600 text-white shadow-lg shadow-primary-500/30' : 'bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800' }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                    
                    <div class="mx-auto mt-8 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-12 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                        @foreach($posts as $post)
                            <article class="flex flex-col items-start justify-between bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm transition-all hover:shadow-xl hover:-translate-y-1 group">
                                <div class="flex items-center gap-x-4 text-xs">
                                    <time datetime="{{ $post->created_at->toDateString() }}" class="text-slate-500">{{ $post->created_at->translatedFormat('d M Y') }}</time>
                                    <span class="relative z-10 rounded-full bg-primary-50 dark:bg-primary-900/30 px-3 py-1.5 font-medium text-primary-600 dark:text-primary-400">
                                        {{ $post->category->name }}
                                    </span>
                                </div>
                                <div class="group relative">
                                    <h3 class="mt-3 text-lg font-bold leading-6 text-slate-900 dark:text-white group-hover:text-primary-600 transition-colors">
                                        <a href="{{ route('posts.show', $post->slug) }}">
                                            <span class="absolute inset-0"></span>
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                    <p class="mt-5 line-clamp-3 text-sm leading-6 text-slate-600 dark:text-slate-400">
                                        {{ Str::limit(strip_tags($post->content), 120) }}
                                    </p>
                                </div>
                                <div class="relative mt-8 flex items-center gap-x-4">
                                    <div class="h-10 w-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center font-bold text-primary-600">
                                        {{ substr($post->user->name, 0, 1) }}
                                    </div>
                                    <div class="text-sm leading-6">
                                        <p class="font-bold text-slate-900 dark:text-white">
                                            <span class="absolute inset-0"></span>
                                            {{ $post->user->name }}
                                        </p>
                                        <p class="text-xs text-slate-500">{{ $post->user->role == 'teacher' ? 'Enseignant' : 'Étudiant' }}</p>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    @if($posts->isEmpty())
                        <div class="text-center py-20">
                            <p class="text-slate-500 italic">Aucun article n'a encore été publié.</p>
                        </div>
                    @endif
                </div>
            </div>
        </main>
        
        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
            <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-secondary-400 to-primary-600 opacity-20 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
    </body>
</html>
