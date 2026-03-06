@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-slate-100 placeholder-slate-400 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 rounded-lg shadow-sm transition-all duration-200 py-2.5 px-3']) }}>
