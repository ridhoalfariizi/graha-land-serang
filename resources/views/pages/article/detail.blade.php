<x-layout>
    <x-slot name="title">{{ $article->title }} | Graha Land Serang</x-slot>
    <x-slot name="meta_description">{{ Str::limit(strip_tags($article->content), 155) }}</x-slot>

    <div class="pt-24 pb-16 bg-white dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('article.list') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-primary mb-8 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg> Kembali ke Artikel
            </a>

            <h1 class="text-4xl md:text-5xl font-black text-dark dark:text-white mb-6" data-aos="fade-up">{{ $article->title }}</h1>
            <p class="text-gray-500 mb-8" data-aos="fade-up">Dipublikasikan pada {{ $article->created_at->format('d M Y') }}</p>

            @if($article->thumbnail)
                <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" class="w-full rounded-2xl shadow-xl mb-12" data-aos="fade-up">
            @endif

            <div class="prose prose-lg dark:prose-invert max-w-none prose-a:text-primary" data-aos="fade-up">
                {!! $article->content !!}
            </div>
        </div>
    </div>
</x-layout>
