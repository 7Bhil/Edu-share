<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,400&family=DM+Mono:wght@400;500&family=Syne:wght@400;500;600;700;800&display=swap');

        .settings-page { font-family: 'Syne', sans-serif; }

        /* ─── STICKY NAV ─── */
        .settings-nav {
            position: sticky;
            top: 0;
            z-index: 40;
            height: 56px;
            background: rgba(248, 250, 252, .92);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            padding: 0 2rem;
            gap: 1rem;
        }
        .dark .settings-nav {
            background: rgba(2, 6, 23, .92);
            border-color: #1e293b;
        }

        .nav-back {
            display: flex;
            align-items: center;
            gap: .4rem;
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            text-decoration: none;
        }

        .nav-pipe { width: 1px; height: 16px; background: #e2e8f0; }
        .dark .nav-pipe { background: #1e293b; }

        .nav-crumb {
            font-family: 'DM Mono', monospace;
            font-size: .65rem;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        /* ─── SECTION TABS ─── */
        .settings-tabs {
            display: flex;
            gap: 0;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 2.5rem;
            overflow-x: auto;
            scrollbar-width: none;
        }
        .dark .settings-tabs { border-color: #1e293b; }
        .settings-tabs::-webkit-scrollbar { display: none; }

        .tab-btn {
            display: flex;
            align-items: center;
            gap: .5rem;
            padding: .9rem 1.4rem;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            border: none;
            background: none;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            margin-bottom: -1px;
            transition: all .2s;
            white-space: nowrap;
            font-family: 'Syne', sans-serif;
        }

        .tab-btn.active {
            border-bottom-color: #6366f1;
            color: #6366f1;
        }
        .dark .tab-btn.active { color: #818cf8; border-bottom-color: #818cf8; }

        .tab-btn:not(.active) { color: #94a3b8; }
        .tab-btn:not(.active):hover { color: #475569; }
        .dark .tab-btn:not(.active) { color: #475569; }
        .dark .tab-btn:not(.active):hover { color: #94a3b8; }

        .tab-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: currentColor;
            opacity: .5;
        }
        .tab-btn.active .tab-dot { opacity: 1; }

        /* ─── PANELS ─── */
        .settings-panel { display: none; }
        .settings-panel.active { display: block; }

        /* ─── SECTION CARDS ─── */
        .section-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 1.5rem;
            transition: border-color .25s, box-shadow .25s;
            position: relative;
            overflow: hidden;
        }
        .dark .section-card {
            background: #0f172a;
            border-color: #1e293b;
        }
        .section-card:hover {
            border-color: rgba(99, 102, 241, .35);
            box-shadow: 0 12px 40px -12px rgba(99, 102, 241, .08);
        }

        /* Danger card */
        .section-card.danger {
            border-color: #fee2e2;
        }
        .dark .section-card.danger {
            border-color: rgba(127, 29, 29, .35);
        }
        .section-card.danger:hover {
            border-color: #fca5a5;
            box-shadow: 0 12px 40px -12px rgba(239, 68, 68, .08);
        }

        /* Decorative glow blobs */
        .card-glow {
            position: absolute;
            border-radius: 50%;
            filter: blur(50px);
            pointer-events: none;
            z-index: 0;
        }
        .glow-indigo {
            width: 180px; height: 180px;
            top: -40px; right: -40px;
            background: rgba(99, 102, 241, .07);
        }
        .dark .glow-indigo { background: rgba(99, 102, 241, .12); }
        .glow-red {
            width: 160px; height: 160px;
            top: -30px; right: -30px;
            background: rgba(239, 68, 68, .05);
        }
        .dark .glow-red { background: rgba(239, 68, 68, .09); }

        .card-inner { position: relative; z-index: 1; }

        /* ─── CARD HEADER STRIP ─── */
        .card-header {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: 1.5rem 2rem 0;
            margin-bottom: 1.75rem;
        }

        .card-icon {
            width: 38px; height: 38px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .icon-indigo {
            background: rgba(99, 102, 241, .1);
            color: #6366f1;
        }
        .dark .icon-indigo {
            background: rgba(99, 102, 241, .2);
            color: #818cf8;
        }
        .icon-shield {
            background: rgba(20, 184, 166, .1);
            color: #0d9488;
        }
        .dark .icon-shield {
            background: rgba(20, 184, 166, .15);
            color: #2dd4bf;
        }
        .icon-danger {
            background: rgba(239, 68, 68, .1);
            color: #dc2626;
        }
        .dark .icon-danger {
            background: rgba(239, 68, 68, .15);
            color: #f87171;
        }

        .card-label {
            font-family: 'DM Mono', monospace;
            font-size: .62rem;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 800;
            line-height: 1.2;
        }

        .card-body { padding: 0 2rem 2rem; }

        /* ─── ANIMATIONS ─── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .anim-1 { animation: fadeUp .45s ease both; }
        .anim-2 { animation: fadeUp .45s .08s ease both; }
        .anim-3 { animation: fadeUp .45s .16s ease both; }
        .anim-hero { animation: fadeUp .4s ease both; }

        @media (max-width: 640px) {
            .settings-nav { padding: 0 1.25rem; }
            .card-header { padding: 1.25rem 1.25rem 0; }
            .card-body { padding: 0 1.25rem 1.25rem; }
        }
    </style>

    {{-- ── STICKY NAV ── --}}
    <nav class="settings-nav">
        <a href="{{ route('dashboard') }}" class="nav-back text-slate-400 hover:text-indigo-500 dark:text-slate-600 dark:hover:text-indigo-400 transition-colors">
            <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour
        </a>
        <div class="nav-pipe"></div>
        <span class="nav-crumb text-slate-400 dark:text-slate-600">Paramètres du compte</span>
    </nav>

    <div class="settings-page py-10 bg-slate-50 dark:bg-slate-950 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- ── HERO ── --}}
            <div class="mb-8 px-4 sm:px-0 anim-hero">
                <p class="font-mono text-[10px] uppercase tracking-[.2em] text-indigo-500 dark:text-indigo-400 mb-2">Espace personnel</p>
                <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight" style="font-family:'Playfair Display',serif;">
                    Paramètres du
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 to-teal-400"> Compte</span>
                </h1>
            </div>

            {{-- ── TABS ── --}}
            <div class="px-0 sm:px-0">
                <div class="settings-tabs px-4 sm:px-0">
                    <button class="tab-btn active" onclick="switchTab('profil', this)">
                        <span class="tab-dot"></span>
                        Profil
                    </button>
                    <button class="tab-btn" onclick="switchTab('securite', this)">
                        <span class="tab-dot"></span>
                        Sécurité
                    </button>
                    <button class="tab-btn" onclick="switchTab('danger', this)">
                        <span class="tab-dot"></span>
                        Zone de danger
                    </button>
                </div>

                {{-- ── PANEL: PROFIL ── --}}
                <div id="panel-profil" class="settings-panel active anim-1">
                    <div class="section-card">
                        <div class="card-glow glow-indigo"></div>
                        <div class="card-inner">
                            <div class="card-header">
                                <div class="card-icon icon-indigo">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="card-label text-slate-400 dark:text-slate-600">Identité</p>
                                    <h2 class="card-title text-slate-900 dark:text-white">Informations du profil</h2>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ── PANEL: SÉCURITÉ ── --}}
                <div id="panel-securite" class="settings-panel anim-2">
                    <div class="section-card">
                        <div class="card-glow" style="width:180px;height:180px;top:-40px;right:-40px;background:rgba(20,184,166,.06);filter:blur(50px);"></div>
                        <div class="card-inner">
                            <div class="card-header">
                                <div class="card-icon icon-shield">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="card-label text-slate-400 dark:text-slate-600">Accès</p>
                                    <h2 class="card-title text-slate-900 dark:text-white">Mot de passe</h2>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ── PANEL: DANGER ── --}}
                <div id="panel-danger" class="settings-panel anim-3">
                    <div class="section-card danger">
                        <div class="card-glow glow-red"></div>
                        <div class="card-inner">
                            <div class="card-header">
                                <div class="card-icon icon-danger">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="card-label text-red-400">Irréversible</p>
                                    <h2 class="card-title text-slate-900 dark:text-white">Zone de danger</h2>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function switchTab(name, btn) {
            // Hide all panels
            document.querySelectorAll('.settings-panel').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));

            // Show selected
            document.getElementById('panel-' + name).classList.add('active');
            btn.classList.add('active');
        }

        // Auto-activate tab if there's a URL hash
        const hash = window.location.hash.replace('#', '');
        if (['profil', 'securite', 'danger'].includes(hash)) {
            const btn = document.querySelector(`[onclick="switchTab('${hash}', this)"]`);
            if (btn) switchTab(hash, btn);
        }
    </script>
</x-app-layout>