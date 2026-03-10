<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Mono:wght@400;500&family=Syne:wght@400;500;600;700;800&display=swap');

        .profile-page { font-family: 'Syne', sans-serif; }

        /* ─── HERO ─── */
        .profile-hero {
            position: relative;
            overflow: hidden;
        }

        .hero-noise {
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(ellipse 60% 50% at 85% 50%, rgba(99,102,241,.12) 0%, transparent 70%),
                radial-gradient(ellipse 40% 60% at 10% 80%, rgba(20,184,166,.07) 0%, transparent 65%);
            pointer-events: none;
        }

        .dark .hero-noise {
            background-image:
                radial-gradient(ellipse 60% 50% at 85% 50%, rgba(99,102,241,.2) 0%, transparent 70%),
                radial-gradient(ellipse 40% 60% at 10% 80%, rgba(20,184,166,.1) 0%, transparent 65%);
        }

        /* Avatar ring animation */
        .avatar-ring {
            position: relative;
            display: inline-block;
        }

        .avatar-ring::before {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 26px;
            background: linear-gradient(135deg, #6366f1, #14b8a6);
            z-index: 0;
            opacity: .9;
        }

        .avatar-inner {
            position: relative;
            z-index: 1;
            width: 128px;
            height: 128px;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', serif;
            font-size: 2.6rem;
            font-weight: 900;
        }

        /* Stats row */
        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
        }

        .stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 900;
            line-height: 1;
        }

        .stat-label {
            font-family: 'DM Mono', monospace;
            font-size: .62rem;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        /* ─── SECTION TITLE ─── */
        .section-eyebrow {
            font-family: 'DM Mono', monospace;
            font-size: .68rem;
            letter-spacing: .15em;
            text-transform: uppercase;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            font-weight: 900;
            line-height: 1.15;
        }

        /* ─── CARDS ─── */
        .post-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
        }

        .post-card:hover {
            transform: translateY(-6px);
        }

        .card-category {
            font-family: 'DM Mono', monospace;
            font-size: .62rem;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            line-height: 1.3;
        }

        .card-excerpt {
            font-size: .82rem;
            line-height: 1.7;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Read more arrow */
        .read-more svg {
            transition: transform .2s;
        }
        .post-card:hover .read-more svg {
            transform: translateX(4px);
        }

        /* ─── EMPTY STATE ─── */
        .empty-state-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
        }

        /* ─── ANIMATIONS ─── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .anim-1 { animation: fadeUp .5s ease both; }
        .anim-2 { animation: fadeUp .5s .1s ease both; }
        .anim-3 { animation: fadeUp .5s .18s ease both; }

        .post-card { opacity: 0; animation: fadeUp .45s ease forwards; }
        .post-card:nth-child(1) { animation-delay: 0s; }
        .post-card:nth-child(2) { animation-delay: .07s; }
        .post-card:nth-child(3) { animation-delay: .14s; }
        .post-card:nth-child(4) { animation-delay: .21s; }
        .post-card:nth-child(5) { animation-delay: .28s; }
        .post-card:nth-child(6) { animation-delay: .35s; }
        .post-card:nth-child(7) { animation-delay: .42s; }
        .post-card:nth-child(8) { animation-delay: .49s; }
        .post-card:nth-child(9) { animation-delay: .56s; }
    </style>

    <div class="profile-page py-12 bg-slate-50 dark:bg-slate-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ── PROFILE HERO ── --}}
            <div class="profile-hero bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 sm:rounded-3xl shadow-xl mb-10 anim-1">
                <div class="hero-noise"></div>

                <div class="relative z-10 p-8 sm:p-12">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-8 md:gap-12">

                        {{-- Avatar --}}
                        <div class="avatar-ring flex-shrink-0">
                            <div class="avatar-inner bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 text-center md:text-left">
                            <div class="section-eyebrow text-indigo-500 dark:text-indigo-400 mb-2">
                                Profil membre
                            </div>
                            <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-4" style="font-family:'Playfair Display',serif;">
                                {{ $user->name }}
                            </h1>

                            <div class="flex flex-wrap justify-center md:justify-start items-center gap-3 mb-8">
                                <span class="card-category px-3 py-1.5 rounded-full bg-indigo-600/10 dark:bg-indigo-600/20 text-indigo-600 dark:text-indigo-400 border border-indigo-500/20 dark:border-indigo-500/30">
                                    {{ $user->role == 'teacher' ? 'Enseignant' : 'Étudiant' }}
                                </span>
                                <span class="flex items-center gap-1.5 text-xs text-slate-400 dark:text-slate-500" style="font-family:'DM Mono',monospace;">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Depuis {{ $user->created_at->translatedFormat('F Y') }}
                                </span>
                            </div>

                            {{-- Stats --}}
                            @php
                            $totalLikes    = $posts->sum(function($p) { return $p->likes->count(); });
                            $totalComments = $posts->sum(function($p) { return $p->comments->count(); });
                        @endphp
                        <div class="inline-flex items-stretch gap-0 bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden">
                                <div class="stat-item px-6 py-4">
                                    <span class="stat-value text-slate-900 dark:text-white">{{ $posts->count() }}</span>
                                    <span class="stat-label text-slate-400 dark:text-slate-500">Articles</span>
                                </div>
                                <div class="w-px bg-slate-200 dark:bg-slate-700"></div>
                                <div class="stat-item px-6 py-4">
                                    <span class="stat-value text-slate-900 dark:text-white">{{ $totalLikes }}</span>
                                    <span class="stat-label text-slate-400 dark:text-slate-500">Likes</span>
                                </div>
                                <div class="w-px bg-slate-200 dark:bg-slate-700"></div>
                                <div class="stat-item px-6 py-4">
                                    <span class="stat-value text-slate-900 dark:text-white">{{ $totalComments }}</span>
                                    <span class="stat-label text-slate-400 dark:text-slate-500">Réponses</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── PUBLICATIONS ── --}}
            <div class="anim-2">
                <div class="flex items-end justify-between mb-8">
                    <div>
                        <p class="section-eyebrow text-indigo-500 dark:text-indigo-400 mb-1">Contributions</p>
                        <h2 class="section-title text-slate-900 dark:text-white">
                            Publications de {{ explode(' ', $user->name)[0] }}
                        </h2>
                    </div>
                    <span class="hidden sm:flex items-center gap-1.5 text-xs text-slate-400 dark:text-slate-500" style="font-family:'DM Mono',monospace; letter-spacing:.08em;">
                        {{ $posts->count() }} article{{ $posts->count() !== 1 ? 's' : '' }}
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 anim-3">
                    @forelse($posts as $post)
                        <article class="post-card bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 hover:border-indigo-500/50 dark:hover:border-indigo-500/40 hover:shadow-2xl hover:shadow-indigo-500/10 dark:hover:shadow-indigo-500/10">

                            <div>
                                {{-- Top meta --}}
                                <div class="flex items-center justify-between mb-5">
                                    <span class="card-category px-2.5 py-1 rounded-lg bg-indigo-600/10 dark:bg-indigo-600/15 text-indigo-600 dark:text-indigo-400 border border-indigo-500/15">
                                        {{ $post->category->name }}
                                    </span>
                                    <time class="text-slate-400 dark:text-slate-500" style="font-family:'DM Mono',monospace; font-size:.62rem; letter-spacing:.08em;">
                                        {{ $post->created_at->translatedFormat('d M Y') }}
                                    </time>
                                </div>

                                {{-- Title --}}
                                <h3 class="card-title text-slate-900 dark:text-white mb-3 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>

                                {{-- Excerpt --}}
                                <p class="card-excerpt text-slate-400 dark:text-slate-500 mb-6">
                                    {{ Str::limit(strip_tags($post->content), 120) }}
                                </p>
                            </div>

                            {{-- Footer --}}
                            <div class="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-slate-800">
                                <div class="flex items-center gap-3">
                                    {{-- Comments --}}
                                    <span class="flex items-center gap-1.5 text-slate-400 dark:text-slate-600" style="font-size:.72rem; font-family:'DM Mono',monospace;">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                        {{ $post->comments_count ?? $post->comments->count() }}
                                    </span>
                                    {{-- Likes --}}
                                    <span class="flex items-center gap-1.5 text-slate-400 dark:text-slate-600" style="font-size:.72rem; font-family:'DM Mono',monospace;">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                        {{ $post->likes->count() }}
                                    </span>
                                </div>

                                <a href="{{ route('posts.show', $post->slug) }}" class="read-more flex items-center gap-1.5 text-indigo-600 dark:text-indigo-400 font-bold" style="font-size:.72rem; letter-spacing:.06em; text-transform:uppercase; text-decoration:none;">
                                    Lire
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            </div>
                        </article>

                    @empty
                        <div class="col-span-full py-20 text-center">
                            <div class="empty-state-icon bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700">
                                <svg class="w-9 h-9 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v12a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <p class="text-slate-400 dark:text-slate-600 font-medium" style="font-family:'Playfair Display',serif; font-style:italic;">
                                Aucune publication pour le moment.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>