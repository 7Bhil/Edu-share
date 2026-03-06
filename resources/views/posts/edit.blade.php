<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('posts.show', $post->slug) }}" class="text-slate-500 hover:text-primary-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
                {{ __('Modifier l\'article') }} : {{ $post->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-900 shadow-sm sm:rounded-3xl p-8 border border-slate-100 dark:border-slate-800">
                <form method="POST" action="{{ route('posts.update', $post) }}" id="update-post-form">
                    @csrf
                    @method('PATCH')

                    <div class="mb-6">
                        <x-input-label for="title" :value="__('Titre')" class="mb-2" />
                        <x-text-input id="title" class="block w-full" type="text" name="title" :value="old('title', $post->title)" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="category_id" :value="__('Catégorie')" class="mb-2" />
                        <div class="flex flex-wrap gap-2">
                            @foreach($categories as $category)
                                <label class="cursor-pointer">
                                    <input type="radio" name="category_id" value="{{ $category->id }}" class="peer hidden" {{ $post->category_id == $category->id ? 'checked' : '' }} required>
                                    <span class="px-4 py-2 rounded-full border border-slate-200 dark:border-slate-800 text-sm font-medium text-slate-600 dark:text-slate-400 peer-checked:bg-primary-600 peer-checked:text-white peer-checked:border-primary-600 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all block">
                                        {{ $category->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="content" :value="__('Contenu (Markdown)')" class="mb-2" />
                        <textarea id="content" name="content" class="w-full border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-slate-100 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 rounded-xl shadow-sm transition-all duration-200 p-4 font-mono text-sm" rows="12" required>{{ old('content', $post->content) }}</textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="tags" :value="__('Tags (séparés par des virgules)')" class="mb-2" />
                        <x-text-input id="tags" name="tags" class="block w-full" type="text" :value="implode(', ', $post->tags->pluck('name')->toArray())" placeholder="ex: examen, revision, tps" />
                    </div>
                </form>

                <div class="flex items-center justify-between mt-8 pt-6 border-t border-slate-100 dark:border-slate-800">
                    <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm font-bold uppercase tracking-widest text-red-600 hover:text-red-500 transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Supprimer l'article
                        </button>
                    </form>

                    <div class="flex items-center gap-4">
                        <x-secondary-button type="button" onclick="window.history.back()">
                            Annuler
                        </x-secondary-button>
                        <x-primary-button form="update-post-form">
                            Enregistrer les modifications
                        </x-primary-button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
