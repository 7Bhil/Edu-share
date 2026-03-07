<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Administration - Vue d\'ensemble') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Stats Cards -->
                <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-2xl border border-slate-100 dark:border-slate-800 p-6 transition-all hover:shadow-md">
                    <div class="flex items-center">
                        <div class="p-4 rounded-2xl bg-primary-50 dark:bg-primary-900/40 text-primary-600 dark:text-primary-400 mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div>
                            <p class="mb-1 text-sm font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Utilisateurs</p>
                            <p class="text-3xl font-extrabold text-slate-900 dark:text-white">{{ $stats['users'] }}</p>
                        </div>
                    </div>
                    <div class="mt-6 border-t border-slate-100 dark:border-slate-800 pt-4">
                        <a href="{{ route('admin.users') }}" class="text-sm text-primary-600 dark:text-primary-400 hover:text-primary-500 font-bold uppercase tracking-wider flex items-center group">Gérer les utilisateurs <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-2xl border border-slate-100 dark:border-slate-800 p-6 transition-all hover:shadow-md">
                    <div class="flex items-center">
                        <div class="p-4 rounded-2xl bg-sky-50 dark:bg-sky-900/40 text-sky-600 dark:text-sky-400 mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                        <div>
                            <p class="mb-1 text-sm font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Articles</p>
                            <p class="text-3xl font-extrabold text-slate-900 dark:text-white">{{ $stats['posts'] }}</p>
                        </div>
                    </div>
                    <div class="mt-6 border-t border-slate-100 dark:border-slate-800 pt-4">
                        <a href="{{ route('admin.posts') }}" class="text-sm text-sky-600 dark:text-sky-400 hover:text-sky-500 font-bold uppercase tracking-wider flex items-center group">Gérer les articles <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-2xl border border-slate-100 dark:border-slate-800 p-6 transition-all hover:shadow-md">
                    <div class="flex items-center">
                        <div class="p-4 rounded-2xl bg-amber-50 dark:bg-amber-900/40 text-amber-600 dark:text-amber-400 mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                        </div>
                        <div>
                            <p class="mb-1 text-sm font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Commentaires</p>
                            <p class="text-3xl font-extrabold text-slate-900 dark:text-white">{{ $stats['comments'] }}</p>
                        </div>
                    </div>
                    <div class="mt-6 border-t border-slate-100 dark:border-slate-800 pt-4">
                        <span class="text-sm text-amber-600 dark:text-amber-400 font-bold uppercase tracking-wider flex items-center">Activité en temps réel</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-2xl border border-slate-100 dark:border-slate-800 p-8 text-center mt-6">
                <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="text-2xl font-extrabold text-slate-900 dark:text-white mb-2">Centre de contrôle Edu-share</h3>
                <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">Vous avez le contrôle total sur la plateforme. Modérez les articles, gérez les rôles utilisateurs et assurez-vous de la qualité des échanges universitaires.</p>
            </div>
        </div>
    </div>
</x-app-layout>
