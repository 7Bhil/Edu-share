<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('EduShare Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Post creation component -->
            <div x-data="{ open: false }" class="bg-white dark:bg-slate-900 shadow-sm sm:rounded-2xl p-6 lg:p-8 border border-slate-100 dark:border-slate-800">
                
                <!-- Initial closed state -->
                <div x-show="!open" class="flex items-center gap-4 cursor-pointer group" @click="open = true">
                    <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800/50 flex items-center justify-center text-primary-500 group-hover:bg-primary-50 dark:group-hover:bg-primary-900/30 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <span class="text-slate-500 dark:text-slate-400 font-medium text-lg group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">Commencer une publication...</span>
                </div>

                <!-- Expanded form state -->
                <form x-show="open" method="POST" action="{{ route('posts.store') }}" style="display: none;" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="mt-2">
                    @csrf
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200">Nouvelle Publication</h3>
                        <button type="button" @click="open = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <div class="mb-5">
                        <x-input-label for="title" :value="__('Title')" class="mb-1 hidden" />
                        <x-text-input id="title" class="block w-full text-lg font-semibold placeholder:font-normal" type="text" name="title" placeholder="Titre de votre publication" required autocomplete="off" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mb-5">
                        <x-input-label for="category_id" :value="__('Catégorie')" class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300" />
                        <div class="flex flex-wrap gap-2">
                            @foreach($categories as $category)
                                <label class="cursor-pointer">
                                    <input type="radio" name="category_id" value="{{ $category->id }}" class="peer hidden" required>
                                    <span class="px-4 py-2 rounded-full border border-slate-200 dark:border-slate-800 text-sm font-medium text-slate-600 dark:text-slate-400 peer-checked:bg-primary-600 peer-checked:text-white peer-checked:border-primary-600 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all block">
                                        {{ $category->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <div class="mb-5">
                        <x-input-label for="content" :value="__('Content')" class="mb-1 hidden" />
                        <textarea id="content" name="content" class="border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-slate-100 placeholder-slate-400 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 rounded-lg shadow-sm transition-all duration-200 block w-full resize-y font-mono text-sm" rows="6" placeholder="Contenu en Markdown (utilisez # pour les titres, * pour listes...)" required></textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <div class="mb-5">
                        <x-input-label for="tags" :value="__('Tags (séparés par des virgules)')" class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300" />
                        <x-text-input id="tags" name="tags" class="block w-full" type="text" placeholder="ex: examen, revision, tps" />
                    </div>
                    <div class="flex justify-end gap-3 mt-6">
                        <x-secondary-button type="button" @click="open = false">
                            Annuler
                        </x-secondary-button>
                        <x-primary-button>
                            {{ __('Publish Article') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <div class="space-y-4">
                @foreach ($posts as $post)
                    <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-2xl border border-slate-100 dark:border-slate-800 transition-all hover:shadow-md">
                        <div class="p-6 text-slate-900 dark:text-slate-100 flex flex-col gap-3">
                            <div class="flex items-center justify-between gap-3">
                                <div class="flex items-center gap-3">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400">
                                        {{ $post->category->name }}
                                    </span>
                                    <h3 class="font-bold text-xl text-slate-900 dark:text-white">{{ $post->title }}</h3>
                                </div>
                                <span class="text-[10px] uppercase font-bold px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400">
                                    {{ $post->user->name }} • {{ $post->user->role == 'teacher' ? 'Enseignant' : 'Étudiant' }}
                                </span>
                            </div>
                            <div class="text-slate-700 dark:text-slate-300 max-w-none">
                                <x-markdown :content="Str::limit($post->content, 200)" />
                            </div>
                            <div class="flex items-center justify-between mt-4 border-t border-slate-50 dark:border-slate-800/50 pt-4">
                                <span class="text-xs text-slate-500">{{ $post->created_at->translatedFormat('d M Y') }} ({{ $post->created_at->diffForHumans() }})</span>
                                <div class="flex items-center gap-4">
                                    @if(auth()->id() === $post->user_id)
                                        <a href="{{ route('posts.edit', $post) }}" class="text-xs font-bold uppercase tracking-widest text-slate-400 hover:text-primary-500 transition-colors">
                                            Modifier
                                        </a>
                                    @endif
                                    <a href="{{ route('posts.show', $post->slug) }}" class="text-sm font-semibold text-primary-600 dark:text-primary-400 hover:text-primary-500 inline-flex items-center gap-1 group">
                                        Lire l'article
                                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                @if($posts->isEmpty())
                    <div class="text-center py-10 text-slate-500">
                        No publications yet. Be the first to share something!
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
