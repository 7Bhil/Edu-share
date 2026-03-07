<x-app-layout>
    <x-slot name="header">{{-- masqué --}}</x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Mono:wght@400;500&family=Syne:wght@400;600;700&display=swap');

        :root {
            --ink:          #f1f5f9;       /* slate-100  — texte principal */
            --paper:        #020617;       /* slate-950  — fond global */
            --cream:        #0f172a;       /* slate-900  — surfaces */
            --accent:       #6366f1;       /* indigo-500 — couleur principale */
            --accent-light: #1e1b4b;       /* indigo-950 — fond accent léger */
            --muted:        #64748b;       /* slate-500  — texte secondaire */
            --border:       #1e293b;       /* slate-800  — bordures */
            --white:        #0f172a;       /* slate-900  — fond carte */
        }

        .edit-wrapper {
            font-family: 'Syne', sans-serif;
            background-color: var(--paper);
            min-height: 100vh;
            padding: 0;
        }

        /* ── TOP BAR ── */
        .edit-topbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(2, 6, 23, 0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .edit-topbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .back-btn {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--muted);
            text-decoration: none;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            transition: color 0.2s;
        }

        .back-btn:hover { color: var(--accent); }

        .topbar-divider {
            width: 1px;
            height: 18px;
            background: var(--border);
        }

        .edit-badge {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--accent);
            background: var(--accent-light);
            padding: 3px 10px;
            border-radius: 2px;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* ── HERO TITLE AREA ── */
        .edit-hero {
            padding: 3.5rem 2rem 2rem;
            max-width: 860px;
            margin: 0 auto;
            border-bottom: 1px solid var(--border);
        }

        .edit-hero-label {
            font-family: 'DM Mono', monospace;
            font-size: 0.72rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 0.75rem;
        }

        .edit-title-display {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 3.5vw, 2.8rem);
            line-height: 1.2;
            color: var(--ink);
            font-weight: 700;
            max-width: 680px;
        }

        /* ── MAIN FORM LAYOUT ── */
        .edit-body {
            max-width: 860px;
            margin: 0 auto;
            padding: 2.5rem 2rem 6rem;
            display: grid;
            grid-template-columns: 1fr 260px;
            gap: 2.5rem;
            align-items: start;
        }

        .edit-main { min-width: 0; }
        .edit-sidebar { position: sticky; top: 76px; }

        /* ── FIELD GROUPS ── */
        .field-group {
            margin-bottom: 2rem;
        }

        .field-label {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 0.6rem;
            display: block;
        }

        .field-input {
            width: 100%;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 0.85rem 1rem;
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            color: var(--ink);
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
            box-sizing: border-box;
        }

        .field-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-light);
        }

        .field-textarea {
            width: 100%;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 1rem;
            font-family: 'DM Mono', monospace;
            font-size: 0.82rem;
            line-height: 1.7;
            color: var(--ink);
            resize: vertical;
            min-height: 360px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-sizing: border-box;
        }

        .field-textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-light);
        }

        .field-hint {
            font-size: 0.72rem;
            color: var(--muted);
            margin-top: 0.4rem;
            font-family: 'DM Mono', monospace;
        }

        /* ── CATEGORY PILLS ── */
        .category-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
        }

        .category-label {
            cursor: pointer;
        }

        .category-label input[type="radio"] {
            display: none;
        }

        .category-pill {
            display: block;
            padding: 0.35rem 0.85rem;
            border: 1px solid var(--border);
            border-radius: 2px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--muted);
            background: var(--white);
            transition: all 0.15s;
        }

        .category-label input:checked + .category-pill {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }

        .category-label:hover .category-pill {
            border-color: var(--accent);
            color: var(--accent);
        }

        /* ── SIDEBAR CARD ── */
        .sidebar-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 4px;
            overflow: hidden;
        }

        .sidebar-card-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border);
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .sidebar-card-body {
            padding: 1.25rem;
        }

        /* ── ACTION BUTTONS ── */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 0.7rem 1.4rem;
            font-family: 'Syne', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            width: 100%;
            justify-content: center;
        }

        .btn-primary:hover {
            background: #4f46e5;
            transform: translateY(-1px);
        }

        .btn-primary:active { transform: translateY(0); }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            background: transparent;
            color: var(--muted);
            border: 1px solid var(--border);
            border-radius: 3px;
            padding: 0.65rem 1.4rem;
            font-family: 'Syne', sans-serif;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.2s;
            width: 100%;
            text-decoration: none;
            margin-top: 0.5rem;
        }

        .btn-secondary:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .btn-danger {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: transparent;
            color: #f87171;
            border: 1px solid #7f1d1d;
            border-radius: 3px;
            padding: 0.65rem 1.4rem;
            font-family: 'Syne', sans-serif;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.2s;
            width: 100%;
            justify-content: center;
            margin-top: 0.75rem;
        }

        .btn-danger:hover {
            background: rgba(185,28,28,0.12);
            border-color: #ef4444;
        }

        /* ── META SEPARATOR ── */
        .sidebar-sep {
            height: 1px;
            background: var(--border);
            margin: 1rem 0;
        }

        .meta-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.72rem;
            color: var(--muted);
            font-family: 'DM Mono', monospace;
        }

        .meta-row strong {
            color: var(--ink);
            font-weight: 500;
        }

        /* ── CHAR COUNTER ── */
        .char-counter {
            font-family: 'DM Mono', monospace;
            font-size: 0.68rem;
            color: var(--muted);
            text-align: right;
            margin-top: 0.35rem;
        }

        /* ── MARKDOWN TOOLBAR ── */
        .md-toolbar {
            display: flex;
            gap: 0.25rem;
            padding: 0.5rem 0.6rem;
            background: var(--cream);
            border: 1px solid var(--border);
            border-bottom: none;
            border-radius: 4px 4px 0 0;
            flex-wrap: wrap;
        }

        .md-btn {
            background: transparent;
            border: none;
            border-radius: 3px;
            padding: 0.3rem 0.5rem;
            font-family: 'DM Mono', monospace;
            font-size: 0.78rem;
            color: var(--muted);
            cursor: pointer;
            transition: all 0.15s;
            font-weight: 500;
        }

        .md-btn:hover {
            background: var(--border);
            color: var(--ink);
        }

        .md-toolbar-sep {
            width: 1px;
            background: var(--border);
            margin: 0.2rem 0.1rem;
        }

        .field-textarea.with-toolbar {
            border-radius: 0 0 4px 4px;
        }

        /* Responsive */
        @media (max-width: 700px) {
            .edit-body { grid-template-columns: 1fr; }
            .edit-sidebar { position: static; order: -1; }
            .edit-hero { padding: 2rem 1.25rem 1.5rem; }
            .edit-body { padding: 1.5rem 1.25rem 4rem; }
            .edit-topbar { padding: 0 1.25rem; }
        }
    </style>

    <div class="edit-wrapper">

        {{-- TOP BAR --}}
        <div class="edit-topbar">
            <div class="edit-topbar-left">
                <a href="{{ route('posts.show', $post->slug) }}" class="back-btn">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Retour
                </a>
                <div class="topbar-divider"></div>
                <span class="edit-badge">Édition</span>
            </div>
            <div class="topbar-actions">
                <button type="button" onclick="window.history.back()" class="back-btn">Annuler</button>
            </div>
        </div>

        {{-- HERO --}}
        <div class="edit-hero">
            <p class="edit-hero-label">Article · Modification en cours</p>
            <h1 class="edit-title-display" id="hero-title-display">{{ $post->title }}</h1>
        </div>

        {{-- BODY --}}
        <div class="edit-body">

            {{-- LEFT: MAIN FORM --}}
            <div class="edit-main">
                <form method="POST" action="{{ route('posts.update', $post) }}" id="update-post-form">
                    @csrf
                    @method('PATCH')

                    {{-- TITRE --}}
                    <div class="field-group">
                        <label class="field-label" for="title">Titre de l'article</label>
                        <input
                            id="title"
                            class="field-input"
                            type="text"
                            name="title"
                            value="{{ old('title', $post->title) }}"
                            required
                            autofocus
                            oninput="document.getElementById('hero-title-display').textContent = this.value || '—'"
                        />
                        @error('title')
                            <p class="field-hint" style="color: #f87171;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- CATÉGORIE --}}
                    <div class="field-group">
                        <label class="field-label">Catégorie</label>
                        <div class="category-grid">
                            @foreach($categories as $category)
                                <label class="category-label">
                                    <input
                                        type="radio"
                                        name="category_id"
                                        value="{{ $category->id }}"
                                        {{ $post->category_id == $category->id ? 'checked' : '' }}
                                        required
                                    />
                                    <span class="category-pill">{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('category_id')
                            <p class="field-hint" style="color: #f87171;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- CONTENU --}}
                    <div class="field-group">
                        <label class="field-label" for="content">Contenu</label>

                        {{-- Toolbar Markdown --}}
                        <div class="md-toolbar">
                            <button type="button" class="md-btn" onclick="insertMd('**', '**')" title="Gras"><strong>B</strong></button>
                            <button type="button" class="md-btn" onclick="insertMd('*', '*')" title="Italique"><em>I</em></button>
                            <button type="button" class="md-btn" onclick="insertMd('`', '`')" title="Code">{ ` }</button>
                            <div class="md-toolbar-sep"></div>
                            <button type="button" class="md-btn" onclick="insertMd('## ', '')" title="Titre H2">H2</button>
                            <button type="button" class="md-btn" onclick="insertMd('### ', '')" title="Titre H3">H3</button>
                            <div class="md-toolbar-sep"></div>
                            <button type="button" class="md-btn" onclick="insertMd('- ', '')" title="Liste">— Liste</button>
                            <button type="button" class="md-btn" onclick="insertMd('[texte](', ')')" title="Lien">↗ Lien</button>
                            <button type="button" class="md-btn" onclick="insertMd('> ', '')" title="Citation">❝</button>
                        </div>

                        <textarea
                            id="content"
                            name="content"
                            class="field-textarea with-toolbar"
                            rows="16"
                            required
                            oninput="updateCounter()"
                        >{{ old('content', $post->content) }}</textarea>

                        <div class="char-counter" id="char-counter">— mots</div>

                        @error('content')
                            <p class="field-hint" style="color: #f87171;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- TAGS --}}
                    <div class="field-group">
                        <label class="field-label" for="tags">Tags</label>
                        <input
                            id="tags"
                            name="tags"
                            class="field-input"
                            type="text"
                            value="{{ implode(', ', $post->tags->pluck('name')->toArray()) }}"
                            placeholder="examen, révision, tps…"
                        />
                        <p class="field-hint">Séparez les tags par des virgules</p>
                    </div>

                </form>
            </div>

            {{-- RIGHT: SIDEBAR --}}
            <div class="edit-sidebar">

                {{-- PUBLISH CARD --}}
                <div class="sidebar-card">
                    <div class="sidebar-card-header">Publication</div>
                    <div class="sidebar-card-body">

                        <button type="submit" form="update-post-form" class="btn-primary">
                            <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            Enregistrer
                        </button>

                        <button type="button" onclick="window.history.back()" class="btn-secondary">
                            Annuler
                        </button>

                        <div class="sidebar-sep"></div>

                        <div class="meta-row">
                            <span>Créé le</span>
                            <strong>{{ $post->created_at->format('d M Y') }}</strong>
                        </div>
                        <div class="meta-row" style="margin-top: 0.4rem;">
                            <span>Mis à jour</span>
                            <strong>{{ $post->updated_at->format('d M Y') }}</strong>
                        </div>

                        <div class="sidebar-sep"></div>

                        {{-- DELETE --}}
                        <form
                            method="POST"
                            action="{{ route('posts.destroy', $post) }}"
                            onsubmit="return confirm('Supprimer cet article définitivement ?')"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger">
                                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Supprimer l'article
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Live title preview
        const titleInput = document.getElementById('title');
        const heroDisplay = document.getElementById('hero-title-display');
        titleInput.addEventListener('input', () => {
            heroDisplay.textContent = titleInput.value || '—';
        });

        // Word counter
        function updateCounter() {
            const text = document.getElementById('content').value.trim();
            const words = text ? text.split(/\s+/).length : 0;
            const chars = text.length;
            document.getElementById('char-counter').textContent =
                `${words} mot${words !== 1 ? 's' : ''} · ${chars} caractère${chars !== 1 ? 's' : ''}`;
        }
        updateCounter();

        // Markdown helper
        function insertMd(before, after) {
            const ta = document.getElementById('content');
            const start = ta.selectionStart;
            const end = ta.selectionEnd;
            const selected = ta.value.substring(start, end);
            const replacement = before + selected + after;
            ta.setRangeText(replacement, start, end, 'select');
            ta.focus();
            updateCounter();
        }
    </script>

</x-app-layout>
