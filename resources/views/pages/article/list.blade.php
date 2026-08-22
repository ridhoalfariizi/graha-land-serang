<x-layout>
    <x-slot name="title">Artikel | Graha Land Serang</x-slot>

    <div class="pt-24 pb-16 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-black text-center text-primary mb-12" data-aos="fade-up">Artikel Terbaru</h1>
            
            @if($articles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($articles as $idx => $article)
                    <div data-aos="fade-up" data-aos-delay="{{ $idx * 100 }}" class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col">
                        @if($article->thumbnail)
                            <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-bold dark:text-white mb-3 line-clamp-2">{{ $article->title }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-6 flex-1">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                            <a href="{{ route('article.detail', $article->slug) }}" class="text-primary font-bold hover:underline inline-flex items-center gap-2 mt-auto">
                                Baca Selengkapnya <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 text-gray-500">Belum ada artikel yang dipublikasikan.</div>
            @endif
        </div>
    </div>
</x-layout>
