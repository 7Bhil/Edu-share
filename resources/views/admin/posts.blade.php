<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Administration - Articles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-2xl border border-slate-100 dark:border-slate-800">
                <div class="p-6 text-slate-900 dark:text-slate-100">
                    
                    <div class="mb-6 flex justify-between items-center">
                        <h3 class="text-lg font-bold">Modération des articles ({{ $posts->total() }})</h3>
                    </div>

                    <div class="overflow-x-auto rounded-xl border border-slate-200 dark:border-slate-700">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-slate-50 dark:bg-slate-800/50">
                                <tr>
                                    <th class="py-4 px-6 font-bold text-xs uppercase tracking-wider text-slate-500">Titre & Catégorie</th>
                                    <th class="py-4 px-6 font-bold text-xs uppercase tracking-wider text-slate-500">Auteur</th>
                                    <th class="py-4 px-6 font-bold text-xs uppercase tracking-wider text-slate-500">Statut</th>
                                    <th class="py-4 px-6 font-bold text-xs uppercase tracking-wider text-slate-500 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                @foreach($posts as $post)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                    <td class="py-4 px-6">
                                        <div class="font-bold text-slate-900 dark:text-white max-w-sm truncate" title="{{ $post->title }}">{{ $post->title }}</div>
                                        <div class="text-xs text-slate-500 mt-1 uppercase tracking-widest font-semibold">{{ $post->category?->name ?? 'Sans catégorie' }}</div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="font-medium text-slate-700 dark:text-slate-300">{{ $post->user->name }}</div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider 
                                            {{ $post->status === 'published' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' }}">
                                            {{ $post->status === 'published' ? 'Publié' : 'Brouillon/En attente' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <div class="flex items-center justify-end gap-3">
                                            <form action="{{ route('admin.posts.toggle-status', $post) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-xs font-bold uppercase tracking-widest {{ $post->status === 'published' ? 'text-amber-500 hover:text-amber-600' : 'text-green-500 hover:text-green-600' }} transition-colors">
                                                    {{ $post->status === 'published' ? 'Masquer' : 'Publier' }}
                                                </button>
                                            </form>
                                            <span class="text-slate-300 dark:text-slate-700">|</span>
                                            <a href="{{ route('posts.show', $post->slug) }}" class="text-xs font-bold uppercase tracking-widest text-primary-600 hover:text-primary-500 transition-colors" target="_blank">Voir</a>
                                            <span class="text-slate-300 dark:text-slate-700">|</span>
                                            <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Attention: Mettre cet article à la corbeille ?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs font-bold uppercase tracking-widest text-red-600 hover:text-red-500 transition-colors">Censurer</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
