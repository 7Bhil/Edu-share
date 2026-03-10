<x-app-layout>
    <x-slot name="header">{{-- masqué --}}</x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Mono:wght@400;500&family=Syne:wght@400;500;600;700&display=swap');

        :root {
            --ink:       #0f172a;       /* slate-900 */
            --paper:     #f8fafc;       /* slate-50 */
            --cream:     #ffffff;       /* white */
            --border:    #e2e8f0;       /* slate-200 */
            --muted:     #64748b;       /* slate-500 */
            --accent:    #6366f1;       /* indigo-500 */
            --accent-lt: #eef2ff;       /* indigo-50 */
            --white:     #ffffff;
            --nav-bg:    248, 250, 252; /* slate-50 */
        }

        .dark {
            --ink:       #f1f5f9;       /* slate-100 */
            --paper:     #020617;       /* slate-950 */
            --cream:     #0f172a;       /* slate-900 */
            --border:    #1e293b;       /* slate-800 */
            --muted:     #94a3b8;       /* slate-400 */
            --accent:    #818cf8;       /* indigo-400 */
            --accent-lt: #1e1b4b;       /* indigo-950 */
            --white:     #0f172a;       /* slate-900 */
            --nav-bg:    2, 6, 23;      /* slate-950 */
        }

        /* ─── RESET & BASE ─── */
        .show-page * { box-sizing: border-box; }
        .show-page {
            font-family: 'Syne', sans-serif;
            background: var(--paper);
            min-height: 100vh;
            color: var(--ink);
        }

        /* ─── STICKY NAV ─── */
        .show-nav {
            position: sticky;
            top: 0;
            z-index: 40;
            height: 56px;
            background: rgba(var(--nav-bg), 0.92);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;posts/3/edit
        }

        .nav-left { display: flex; align-items: center; gap: 1rem; }

        .nav-back {
            display: flex;
            align-items: center;
            gap: .45rem;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--muted);
            text-decoration: none;
            transition: color .2s;
        }
        .nav-back:hover { color: var(--accent); }

        .nav-pipe { width: 1px; height: 16px; background: var(--border); }

        .nav-cat {
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: var(--accent);
            background: var(--accent-lt);
            padding: 3px 10px;
            border-radius: 2px;
        }

        .nav-right { display: flex; align-items: center; gap: .75rem; }
        .nav-edit-btn {
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--muted);
            text-decoration: none;
            border: 1px solid var(--border);
            border-radius: 3px;
            padding: .3rem .8rem;
            transition: all .2s;
        }
        .nav-edit-btn:hover { color: var(--ink); border-color: var(--ink); }

        /* ─── HERO ─── */
        .show-hero {
            max-width: 820px;
            margin: 0 auto;
            padding: 4rem 2rem 3rem;
            border-bottom: 1px solid var(--border);
        }

        .hero-meta {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1.5rem;
        }

        .hero-date {
            font-family: 'DM Mono', monospace;
            font-size: .7rem;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .hero-dot { color: var(--border); }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 5vw, 3.6rem);
            font-weight: 900;
            line-height: 1.1;
            letter-spacing: -.01em;
            color: var(--ink);
            margin-bottom: 2.5rem;
        }

        .hero-title em {
            font-style: italic;
            color: var(--accent);
        }

        /* Author */
        .hero-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .author-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent) 0%, #7c3a20 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .author-name {
            font-weight: 700;
            font-size: .9rem;
            color: var(--ink);
        }

        .author-role {
            font-family: 'DM Mono', monospace;
            font-size: .65rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--muted);
            margin-top: 1px;
        }

        /* ─── ACTION BAR ─── */
        .show-actions {
            max-width: 820px;
            margin: 0 auto;
            padding: 1.25rem 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border-bottom: 1px solid var(--border);
        }

        /* Like */
        .like-form { display: contents; }

        .like-btn {
            display: inline-flex;
            align-items: center;
            gap: .6rem;
            background: none;
            border: 1px solid var(--border);
            border-radius: 3px;
            padding: .45rem 1rem .45rem .7rem;
            cursor: pointer;
            transition: all .2s;
            font-family: 'Syne', sans-serif;
        }

        .like-btn:hover { border-color: #f87171; background: rgba(248, 113, 113, 0.05); }

        .like-btn.liked {
            border-color: var(--accent);
            background: var(--accent-lt);
        }

        .like-heart {
            width: 17px;
            height: 17px;
            transition: transform .2s;
        }
        .like-btn:hover .like-heart { transform: scale(1.2); }

        .like-count {
            font-size: .82rem;
            font-weight: 800;
            color: var(--ink);
        }

        .like-label {
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--muted);
        }
        .like-btn.liked .like-label { color: var(--accent); }

        .actions-sep { width: 1px; height: 20px; background: var(--border); flex-shrink: 0; }

        /* Tags */
        .tags-row { display: flex; align-items: center; gap: .4rem; flex-wrap: wrap; }

        .tag-pill {
            font-family: 'DM Mono', monospace;
            font-size: .68rem;
            font-weight: 500;
            color: var(--muted);
            background: var(--cream);
            border: 1px solid var(--border);
            border-radius: 2px;
            padding: .25rem .65rem;
            transition: all .15s;
        }

        .tag-pill:hover { color: var(--accent); border-color: var(--accent); }

        .tag-empty {
            font-family: 'DM Mono', monospace;
            font-size: .68rem;
            color: var(--muted);
            font-style: italic;
        }

        /* ─── MAIN LAYOUT ─── */
        .show-body {
            max-width: 820px;
            margin: 0 auto;
            padding: 3.5rem 2rem 6rem;
            display: grid;
            grid-template-columns: 1fr 200px;
            gap: 4rem;
            align-items: start;
        }

        /* ─── ARTICLE CONTENT ─── */
        .article-content {
            font-family: 'Playfair Display', serif;
            font-size: 1.08rem;
            line-height: 1.85;
            color: var(--ink);
            opacity: 0.9;
        }

        .article-content h1,
        .article-content h2,
        .article-content h3 {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            color: var(--ink);
            margin: 2rem 0 .75rem;
            line-height: 1.25;
        }
        .article-content h2 { font-size: 1.3rem; border-bottom: 1px solid var(--border); padding-bottom: .5rem; }
        .article-content h3 { font-size: 1.05rem; }

        .article-content p { margin-bottom: 1.4rem; }

        .article-content a {
            color: var(--accent);
            text-decoration: underline;
            text-decoration-thickness: 1px;
            text-underline-offset: 3px;
        }

        .article-content blockquote {
            border-left: 3px solid var(--accent);
            margin: 1.5rem 0;
            padding: .75rem 1.25rem;
            background: var(--accent-lt);
            border-radius: 0 4px 4px 0;
            font-style: italic;
            color: var(--accent);
        }

        .article-content code {
            font-family: 'DM Mono', monospace;
            font-size: .82em;
            background: var(--cream);
            border: 1px solid var(--border);
            padding: .1em .4em;
            border-radius: 3px;
            color: var(--ink);
        }

        .article-content pre {
            background: var(--ink);
            color: var(--paper);
            padding: 1.25rem;
            border-radius: 4px;
            overflow-x: auto;
            margin: 1.5rem 0;
        }

        .article-content pre code {
            background: none;
            border: none;
            color: inherit;
            font-size: .82rem;
            padding: 0;
        }

        .article-content ul, .article-content ol {
            padding-left: 1.5rem;
            margin-bottom: 1.4rem;
        }

        .article-content li { margin-bottom: .4rem; }

        /* ─── SIDEBAR ─── */
        .show-sidebar { position: sticky; top: 72px; }

        .sidebar-section {
            margin-bottom: 2rem;
        }

        .sidebar-label {
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .15em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: .75rem;
            display: block;
        }

        .sidebar-line { height: 1px; background: var(--border); margin: 1.25rem 0; }

        .toc-list { list-style: none; padding: 0; margin: 0; }
        .toc-list li {
            padding: .3rem 0;
            border-bottom: 1px solid var(--border);
        }
        .toc-list li a {
            font-size: .75rem;
            color: var(--muted);
            text-decoration: none;
            transition: color .15s;
        }
        .toc-list li a:hover { color: var(--accent); }

        /* ─── COMMENTS ─── */
        .show-comments {
            max-width: 820px;
            margin: 0 auto;
            padding: 3rem 2rem 5rem;
            border-top: 1px solid var(--border);
        }

        .comments-header {
            display: flex;
            align-items: baseline;
            gap: .75rem;
            margin-bottom: 2.5rem;
        }

        .comments-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--ink);
        }

        .comments-count {
            font-family: 'DM Mono', monospace;
            font-size: .72rem;
            color: var(--muted);
            letter-spacing: .08em;
        }

        /* Comment form */
        .comment-form { margin-bottom: 3rem; }

        .comment-textarea {
            width: 100%;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 1rem;
            font-family: 'Syne', sans-serif;
            font-size: .88rem;
            color: var(--ink);
            resize: vertical;
            min-height: 100px;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            margin-bottom: .75rem;
        }

        .comment-textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-lt);
        }

        .comment-textarea::placeholder { color: var(--muted); }

        .comment-submit {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            background: var(--ink);
            color: var(--white);
            border: none;
            border-radius: 3px;
            padding: .6rem 1.2rem;
            font-family: 'Syne', sans-serif;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            cursor: pointer;
            transition: background .2s, transform .1s;
            float: right;
        }
        .comment-submit:hover { background: var(--accent); transform: translateY(-1px); }

        .login-notice {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .login-notice p { font-size: .875rem; color: var(--muted); margin-bottom: .75rem; }
        .login-notice a { color: var(--accent); font-weight: 700; text-decoration: none; }
        .login-notice a:hover { text-decoration: underline; }

        /* Comment items */
        .comment-list { display: flex; flex-direction: column; gap: 1.5rem; }

        .comment-item { display: flex; gap: 1rem; }

        .comment-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--cream);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            font-weight: 800;
            color: var(--muted);
            flex-shrink: 0;
        }

        .comment-bubble {
            flex: 1;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 0 6px 6px 6px;
            padding: .9rem 1.1rem;
        }

        .comment-meta {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            margin-bottom: .5rem;
        }

        .comment-author {
            font-size: .8rem;
            font-weight: 700;
            color: var(--ink);
        }

        .comment-time {
            font-family: 'DM Mono', monospace;
            font-size: .62rem;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .comment-text {
            font-size: .875rem;
            line-height: 1.65;
            color: var(--ink);
            opacity: 0.85;
        }

        .comment-empty {
            text-align: center;
            padding: 2.5rem 0;
            color: var(--muted);
            font-style: italic;
            font-family: 'Playfair Display', serif;
            font-size: .95rem;
        }

        /* ─── FOOTER STRIP ─── */
        .show-footer-strip {
            max-width: 820px;
            margin: 0 auto;
            padding: 1.25rem 2rem;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer-charter {
            font-family: 'DM Mono', monospace;
            font-size: .65rem;
            color: var(--muted);
            letter-spacing: .05em;
        }

        .footer-back {
            display: flex;
            align-items: center;
            gap: .4rem;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--muted);
            text-decoration: none;
            transition: color .2s;
        }
        .footer-back:hover { color: var(--accent); }

        /* ─── ANIMATIONS ─── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .show-hero   { animation: fadeUp .5s ease both; }
        .show-actions { animation: fadeUp .5s .08s ease both; }
        .show-body   { animation: fadeUp .5s .14s ease both; }
        .show-comments { animation: fadeUp .5s .18s ease both; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 700px) {
            .show-body { grid-template-columns: 1fr; gap: 2rem; }
            .show-sidebar { position: static; }
            .show-hero, .show-actions, .show-body, .show-footer-strip, .show-comments {
                padding-left: 1.25rem; padding-right: 1.25rem;
            }
            .show-nav { padding: 0 1.25rem; }
            .hero-title { font-size: 1.9rem; }
        }
    </style>

    <div class="show-page">

        {{-- ── NAV ── --}}
        <nav class="show-nav">
            <div class="nav-left">
                <a href="{{ route('dashboard') }}" class="nav-back">
                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Flux
                </a>
                <div class="nav-pipe"></div>
                <span class="nav-cat">{{ $post->category->name }}</span>
            </div>

            @if(auth()->id() === $post->user_id)
                <div class="nav-right">
                    <a href="{{ route('posts.edit', $post) }}" class="nav-edit-btn">Modifier</a>
                </div>
            @endif
        </nav>

        {{-- ── HERO ── --}}
        <header class="show-hero">
            <div class="hero-meta">
                <span class="hero-date">{{ $post->created_at->translatedFormat('d F Y') }}</span>
            </div>

            <h1 class="hero-title">{{ $post->title }}</h1>

            <a href="{{ route('users.show', $post->user->id) }}" class="hero-author group/author">
                <div class="author-avatar group-hover/author:bg-indigo-600 transition-colors">{{ substr($post->user->name, 0, 1) }}</div>
                <div>
                    <div class="author-name group-hover/author:text-indigo-400 transition-colors">{{ $post->user->name }}</div>
                    <div class="author-role">{{ $post->user->role == 'teacher' ? 'Enseignant' : 'Étudiant' }}</div>
                </div>
            </a>
        </header>

        {{-- ── ACTION BAR ── --}}
        <div class="show-actions">
            @auth
                @php $liked = $post->isLikedBy(auth()->user()); @endphp
                <form action="{{ route('posts.like', $post) }}" method="POST" class="like-form">
                    @csrf
                    <button type="submit" class="like-btn {{ $liked ? 'liked' : '' }}">
                        @if($liked)
                            <svg class="like-heart" viewBox="0 0 24 24" fill="var(--accent)">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        @else
                            <svg class="like-heart" viewBox="0 0 24 24" fill="none" stroke="var(--muted)" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        @endif
                        <span class="like-count">{{ $post->likes->count() }}</span>
                        <span class="like-label">{{ $liked ? 'Aimé' : 'Aimer' }}</span>
                    </button>
                </form>
            @else
                <div class="like-btn" style="cursor:default;">
                    <svg class="like-heart" viewBox="0 0 24 24" fill="none" stroke="var(--muted)" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    <span class="like-count">{{ $post->likes->count() }}</span>
                    <span class="like-label">Likes</span>
                </div>
            @endauth

            <div class="actions-sep"></div>

            <div class="tags-row">
                @forelse($post->tags as $tag)
                    <span class="tag-pill">#{{ $tag->name }}</span>
                @empty
                    <span class="tag-empty">Aucun tag</span>
                @endforelse
            </div>
        </div>

        {{-- ── BODY ── --}}
        <div class="show-body">
            <div class="article-content">
                <x-markdown :content="$post->content" />
            </div>

            {{-- SIDEBAR --}}
            <aside class="show-sidebar">
                <div class="sidebar-section">
                    <span class="sidebar-label">Auteur</span>
                    <a href="{{ route('users.show', $post->user->id) }}" class="group/sidebar-author">
                        <div style="font-size:.82rem; font-weight:700; color:var(--ink);" class="group-hover/sidebar-author:text-indigo-400 transition-colors">{{ $post->user->name }}</div>
                        <div style="font-family:'DM Mono',monospace; font-size:.65rem; color:var(--muted); margin-top:2px;">{{ $post->user->role == 'teacher' ? 'Enseignant' : 'Étudiant' }}</div>
                    </a>
                </div>

                <div class="sidebar-line"></div>

                <div class="sidebar-section">
                    <span class="sidebar-label">Catégorie</span>
                    <span style="font-size:.78rem; font-weight:600; color:var(--accent);">{{ $post->category->name }}</span>
                </div>

                <div class="sidebar-line"></div>

                <div class="sidebar-section">
                    <span class="sidebar-label">Publication</span>
                    <div style="font-family:'DM Mono',monospace; font-size:.68rem; color:var(--muted);">
                        {{ $post->created_at->translatedFormat('d F Y') }}
                    </div>
                </div>

                @if($post->tags->count())
                    <div class="sidebar-line"></div>
                    <div class="sidebar-section">
                        <span class="sidebar-label">Tags</span>
                        <div style="display:flex;flex-wrap:wrap;gap:.35rem;">
                            @foreach($post->tags as $tag)
                                <span class="tag-pill">#{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="sidebar-line"></div>

                <div class="sidebar-section">
                    <span class="sidebar-label">Discussion</span>
                    <div style="font-family:'DM Mono',monospace; font-size:.72rem; color:var(--ink); font-weight:600;">
                        {{ $post->comments->count() }} commentaire{{ $post->comments->count() !== 1 ? 's' : '' }}
                    </div>
                </div>
            </aside>
        </div>

        {{-- ── COMMENTS ── --}}
        <section class="show-comments">
            <div class="comments-header">
                <h2 class="comments-title">Discussion</h2>
                <span class="comments-count">{{ $post->comments->count() }} réponse{{ $post->comments->count() !== 1 ? 's' : '' }}</span>
            </div>

            @auth
                <div class="comment-form">
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <textarea
                            name="content"
                            class="comment-textarea"
                            rows="3"
                            placeholder="Qu'en pensez-vous ?"
                            required
                        ></textarea>
                        <div style="overflow:hidden;">
                            <button type="submit" class="comment-submit">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                Poster
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="login-notice">
                    <p>Vous devez être connecté pour participer à la discussion.</p>
                    <a href="{{ route('login') }}">Se connecter →</a>
                </div>
            @endauth

            <div class="comment-list">
                @forelse($post->comments->sortByDesc('created_at') as $comment)
                    <div class="comment-item">
                        <div class="comment-avatar">{{ substr($comment->user->name, 0, 1) }}</div>
                        <div class="comment-bubble">
                            <div class="comment-meta">
                                <span class="comment-author">{{ $comment->user->name }}</span>
                                <div class="flex items-center gap-3">
                                    <span class="comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                                    @if(auth()->id() === $comment->user_id)
                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Supprimer ce commentaire ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-[10px] font-bold text-red-400/60 hover:text-red-400 uppercase tracking-widest transition-colors">Supprimer</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <p class="comment-text">{{ $comment->content }}</p>
                        </div>
                    </div>
                @empty
                    <div class="comment-empty">Aucun commentaire pour le moment. Soyez le premier à réagir&nbsp;!</div>
                @endforelse
            </div>
        </section>

        {{-- ── FOOTER STRIP ── --}}
        <div class="show-footer-strip">
            <span class="footer-charter">Merci de respecter la charte de la communauté universitaire.</span>
            <a href="{{ route('dashboard') }}" class="footer-back">
                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Retour au flux
            </a>
        </div>

    </div>

</x-app-layout>