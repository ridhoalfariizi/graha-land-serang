@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-center items-center gap-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="w-12 h-12 flex items-center justify-center rounded-2xl bg-gray-100 text-gray-400 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white border border-gray-200 text-gray-600 hover:bg-primary hover:text-white hover:border-primary transition duration-300 shadow-sm">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="hidden md:flex gap-2">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="w-12 h-12 flex items-center justify-center text-gray-500 font-bold">...</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-12 h-12 flex items-center justify-center rounded-2xl bg-primary text-white font-bold shadow-lg shadow-green-500/30">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white border border-gray-200 text-gray-600 font-bold hover:bg-primary hover:text-white hover:border-primary transition duration-300 shadow-sm">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white border border-gray-200 text-gray-600 hover:bg-primary hover:text-white hover:border-primary transition duration-300 shadow-sm">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </a>
        @else
            <span class="w-12 h-12 flex items-center justify-center rounded-2xl bg-gray-100 text-gray-400 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </span>
        @endif
    </nav>
@endif
