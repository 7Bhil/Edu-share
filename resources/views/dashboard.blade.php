<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('EduShare Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white dark:bg-slate-900 shadow-sm sm:rounded-2xl p-6 lg:p-8 border border-slate-100 dark:border-slate-800">
                <form method="POST" action="{{ route('posts.store') }}">
                    @csrf
                    <div class="mb-5">
                        <x-input-label for="title" :value="__('Title')" class="mb-1" />
                        <x-text-input id="title" class="block w-full" type="text" name="title" placeholder="What do you want to share today?" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div class="mb-5">
                        <x-input-label for="content" :value="__('Content')" class="mb-1" />
                        <textarea id="content" name="content" class="border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-slate-100 placeholder-slate-400 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 rounded-lg shadow-sm transition-all duration-200 block w-full" rows="4" placeholder="Describe your topic..." required></textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>
                    <div class="flex justify-end">
                        <x-primary-button>
                            {{ __('Publish') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <div class="space-y-4">
                @foreach ($posts as $post)
                    <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg border border-slate-100 dark:border-slate-800">
                        <div class="p-6 text-slate-900 dark:text-slate-100 flex flex-col gap-2">
                            <div class="flex items-center gap-3">
                                <span class="font-bold text-lg text-primary-600 dark:text-primary-400">{{ $post->title }}</span>
                                <span class="text-[10px] uppercase font-bold px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400">
                                    {{ $post->user->name }} ({{ ucfirst($post->user->role) }})
                                </span>
                            </div>
                            <p class="text-slate-700 dark:text-slate-300 whitespace-pre-wrap mt-2">{{ $post->content }}</p>
                            <span class="text-xs text-slate-500 mt-4">{{ $post->created_at->diffForHumans() }}</span>
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
