<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-slate-500 hover:text-primary-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
                {{ $post->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <article class="bg-white dark:bg-slate-900 shadow-sm sm:rounded-3xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                <!-- Header of the article -->
                <div class="p-8 lg:p-12 border-b border-slate-50 dark:border-slate-800/50">
                    <div class="flex flex-wrap items-center gap-3 mb-6">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400">
                            {{ $post->category->name }}
                        </span>
                        <span class="text-slate-400">•</span>
                        <span class="text-sm text-slate-500 dark:text-slate-400">{{ $post->created_at->translatedFormat('d F Y') }}</span>
                        
                        @if(auth()->id() === $post->user_id)
                            <span class="text-slate-400 ml-auto hidden sm:block">•</span>
                            <div class="flex items-center gap-2 ml-auto sm:ml-0">
                                <a href="{{ route('posts.edit', $post) }}" class="text-xs font-bold uppercase tracking-widest text-primary-600 dark:text-primary-400 hover:text-primary-500 transition-colors">
                                    Modifier
                                </a>
                                <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-bold uppercase tracking-widest text-red-600 hover:text-red-500 transition-colors">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white leading-tight mb-8">
                        {{ $post->title }}
                    </h1>

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center text-white font-bold text-lg">
                            {{ substr($post->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="font-bold text-slate-900 dark:text-slate-100">{{ $post->user->name }}</div>
                            <div class="text-xs text-slate-500 uppercase tracking-widest font-semibold">{{ $post->user->role == 'teacher' ? 'Enseignant' : 'Étudiant' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Action Bar: Likes & Tags -->
                <div class="px-8 lg:px-12 py-4 border-y border-slate-50 dark:border-slate-800 flex items-center justify-between bg-white dark:bg-slate-900 shadow-sm sticky top-0 z-40">
                    <div class="flex items-center gap-6">
                        @auth
                            <form action="{{ route('posts.like', $post) }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 group transition-all">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center transition-colors {{ $post->isLikedBy(auth()->user()) ? 'bg-red-50 dark:bg-red-900/30 text-red-600' : 'bg-slate-100 dark:bg-slate-800 text-slate-500 group-hover:bg-red-50 dark:group-hover:bg-red-900/20 group-hover:text-red-500' }}">
                                        <svg class="w-5 h-5 {{ $post->isLikedBy(auth()->user()) ? 'fill-current' : 'fill-none stroke-current' }}" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                    </div>
                                    <span class="text-sm font-bold {{ $post->isLikedBy(auth()->user()) ? 'text-red-600' : 'text-slate-500 group-hover:text-red-500' }}">
                                        {{ $post->likes->count() }} {{ Str::plural('Like', $post->likes->count()) }}
                                    </span>
                                </button>
                            </form>
                        @else
                            <div class="flex items-center gap-2 text-slate-400">
                                <svg class="w-5 h-5 fill-none stroke-current" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                <span class="text-sm font-bold">{{ $post->likes->count() }}</span>
                            </div>
                        @endauth

                        <div class="h-4 w-px bg-slate-200 dark:bg-slate-800 hidden sm:block"></div>

                        <div class="flex flex-wrap gap-2">
                            @forelse($post->tags as $tag)
                                <span class="text-xs font-medium text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded shadow-sm">#{{ $tag->name }}</span>
                            @empty
                                <span class="text-xs text-slate-400 italic">Aucun tag</span>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-8 lg:p-12">
                    <x-markdown :content="$post->content" />
                </div>

                <!-- Comments Section -->
                <div class="p-8 lg:p-12 border-t border-slate-50 dark:border-slate-800/50 bg-slate-50/50 dark:bg-black/10">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-8 flex items-center gap-3">
                        Discussion
                        <span class="text-sm font-medium px-2 py-0.5 rounded-full bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-400">
                            {{ $post->comments->count() }}
                        </span>
                    </h2>

                    @auth
                        <form action="{{ route('comments.store') }}" method="POST" class="mb-12">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="mb-4">
                                <textarea name="content" rows="3" class="w-full border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 placeholder-slate-400 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 rounded-2xl shadow-sm transition-all duration-200 p-4" placeholder="Qu'en pensez-vous ?" required></textarea>
                            </div>
                            <div class="flex justify-end">
                                <x-primary-button>
                                    Poster le commentaire
                                </x-primary-button>
                            </div>
                        </form>
                    @else
                        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 p-6 rounded-2xl text-center mb-12">
                            <p class="text-slate-600 dark:text-slate-400 mb-4">Vous devez être connecté pour participer à la discussion.</p>
                            <a href="{{ route('login') }}" class="text-primary-600 font-bold hover:underline">Se connecter</a>
                        </div>
                    @endauth

                    <div class="space-y-6">
                        @foreach($post->comments->sortByDesc('created_at') as $comment)
                            <div class="flex gap-4">
                                <div class="shrink-0 w-10 h-10 rounded-full bg-slate-200 dark:bg-slate-800 flex items-center justify-center text-slate-500 font-bold text-sm">
                                    {{ substr($comment->user->name, 0, 1) }}
                                </div>
                                <div class="flex-1 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 p-4 rounded-2xl rounded-tl-none shadow-sm">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-bold text-slate-900 dark:text-white text-sm">{{ $comment->user->name }}</span>
                                        <span class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-slate-700 dark:text-slate-300 text-sm leading-relaxed">
                                        {{ $comment->content }}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                        @if($post->comments->isEmpty())
                            <div class="text-center py-8 text-slate-400 italic">
                                Aucun commentaire pour le moment. Soyez le premier à réagir !
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Footer / Actions (Placeholder for now) -->
                <div class="px-8 lg:px-12 py-6 bg-slate-50 dark:bg-black/20 flex items-center justify-between">
                    <div class="flex items-center gap-4 text-xs text-slate-400">
                        Merci de respecter la charte de la communauté universitaire.
                    </div>
                </div>
            </article>

            <!-- Navigation between articles (Optional for future) -->
            <div class="mt-8 flex justify-between items-center text-sm font-medium">
                <a href="{{ route('dashboard') }}" class="text-slate-500 hover:text-primary-600 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Retour au flux
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
