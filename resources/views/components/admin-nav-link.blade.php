@props(['active'])

@php
$classes = ($active ?? false)
            ? 'group flex items-center px-4 py-3 text-sm font-semibold rounded-xl bg-primary/10 text-white transition-all shadow-sm border border-[#4CAF50]/20 gap-3'
            : 'group flex items-center px-4 py-3 text-sm font-semibold rounded-xl text-slate-400 hover:bg-white/5 hover:text-white transition-all gap-3';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <span class="opacity-80 group-hover:opacity-100 transition-opacity flex items-center justify-center">
        {{ $slot }}
    </span>
</a>
