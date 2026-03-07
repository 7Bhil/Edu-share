<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Administration - Utilisateurs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-2xl border border-slate-100 dark:border-slate-800">
                <div class="p-6 text-slate-900 dark:text-slate-100">
                    
                    <div class="mb-6 flex justify-between items-center">
                        <h3 class="text-lg font-bold">Liste des utilisateurs ({{ $users->total() }})</h3>
                    </div>

                    <div class="overflow-x-auto rounded-xl border border-slate-200 dark:border-slate-700">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-slate-50 dark:bg-slate-800/50">
                                <tr>
                                    <th class="py-4 px-6 font-bold text-xs uppercase tracking-wider text-slate-500">Nom & Email</th>
                                    <th class="py-4 px-6 font-bold text-xs uppercase tracking-wider text-slate-500">Rôle</th>
                                    <th class="py-4 px-6 font-bold text-xs uppercase tracking-wider text-slate-500">Inscription</th>
                                    <th class="py-4 px-6 font-bold text-xs uppercase tracking-wider text-slate-500 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                @foreach($users as $user)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                    <td class="py-4 px-6">
                                        <div class="font-bold text-slate-900 dark:text-white">{{ $user->name }}</div>
                                        <div class="text-xs text-slate-500 mt-1">{{ $user->email }}</div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider 
                                            {{ $user->role === 'admin' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' : 
                                              ($user->role === 'teacher' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 
                                              'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300') }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-slate-500 text-sm font-medium">{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td class="py-4 px-6 text-right">
                                        <form action="{{ route('admin.users.role', $user) }}" method="POST" class="inline-block">
                                            @csrf
                                            <select name="role" onchange="this.form.submit()" class="text-xs font-bold uppercase tracking-widest text-slate-500 bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary-500 focus:border-primary-500 py-1 pl-2 pr-8 cursor-pointer shadow-sm">
                                                <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Étudiant</option>
                                                <option value="teacher" {{ $user->role === 'teacher' ? 'selected' : '' }}>Enseignant</option>
                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
