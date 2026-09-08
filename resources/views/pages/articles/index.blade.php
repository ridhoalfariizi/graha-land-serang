@extends('components.layout')
@section('title', 'Portal Berita Terkini - Graha Land Serang')

@section('content')
<div class="bg-secondary pt-32 pb-16 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=2070')] opacity-10 bg-cover bg-center"></div>
<div class="max-w-7xl mx-auto px-4 xl:px-8 text-left text-white">
        <div class="flex flex-wrap items-center text-sm font-bold text-white/70 mb-10 space-x-2">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <span class="text-white font-black drop-shadow-sm">Artikel</span>
        </div>
        
        <div class="mb-5">
            <span class="bg-white/20 border border-white/40 text-white shadow-sm font-bold text-xs md:text-sm px-4 py-1.5 rounded-full uppercase tracking-wider">Artikel Properti</span>
        </div>
        <h1 class="text-4xl md:text-5xl lg:text-7xl font-black mb-4 tracking-tight drop-shadow-md">Portal Informasi Properti</h1>
        <p class="text-white/90 text-base md:text-lg max-w-2xl drop-shadow-sm">Update progres pembangunan, tips mendesain interior, pemahaman seputar KPR, serta warta penawaran menarik hunian idaman di Graha Land Serang.</p>
    </div>
</div>

<div class="py-24 bg-light">
    <div class="max-w-7xl mx-auto px-4 xl:px-8">
        
        <!-- Search & Filter -->
        <div class="mb-12 bg-white p-4 md:p-6 rounded-3xl shadow-sm border border-slate-100">
            <form action="{{ route('articles') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-grow relative">
                    <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari seputar properti, KPR, dll..." class="w-full pl-12 pr-5 py-4 rounded-xl border border-slate-200 outline-none focus:border-primary focus:ring-4 focus:ring-green-500/10 transition-all font-semibold text-slate-700 placeholder-slate-400">
                </div>
                
                <select name="category" class="px-5 py-4 rounded-xl border border-slate-200 outline-none focus:border-primary transition-all md:w-64 bg-slate-50 font-semibold text-slate-700">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        @if($cat) <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option> @endif
                    @endforeach
                </select>

                <button type="submit" class="bg-primary hover:bg-primary-hover text-white px-8 py-4 rounded-xl font-bold transition shadow-lg shadow-green-500/30 whitespace-nowrap">
                    Cari Artikel
                </button>
            </form>
        </div>

        @if($articles->count() > 0)

        <!-- Grid Articles -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articles as $article)
            <a href="{{ route('article.detail', $article->slug) }}" class="group bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-xl shadow-slate-200/50 flex flex-col hover:-translate-y-2 transition duration-500">
                <div class="h-64 overflow-hidden relative">
                    <img src="{{ $article->thumbnail ? Storage::url($article->thumbnail) : asset('images/desain rumah/gambar 2.jpeg') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur-sm text-secondary font-bold text-xs uppercase tracking-widest px-3 py-1.5 rounded-lg shadow-sm">{{ $article->category ?? 'Informasi' }}</span>
                    </div>
                </div>
                <div class="p-8 flex-1 flex flex-col">
                    <span class="text-slate-400 font-bold text-sm flex items-center gap-2 mb-4">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $article->published_at->format('d M Y') }}
                    </span>
                    <h3 class="text-2xl font-black text-secondary mb-4 leading-tight group-hover:text-white transition duration-300">{{ $article->title }}</h3>
                    <p class="text-slate-500 line-clamp-3 mb-6 flex-1">{{ strip_tags($article->content) }}</p>
                    <div class="border-t border-slate-100 pt-6 flex justify-end items-center text-sm font-bold text-slate-400">
                        <span class="text-primary group-hover:underline inline-flex items-center gap-1 group-hover:pl-2 transition-all">Baca Selanjutnya &rarr;</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-16">
            {{ $articles->links() }}
        </div>
        
        @else
        <div class="text-center py-20 bg-white rounded-3xl border border-slate-100 shadow-xl">
            <svg class="w-20 h-20 text-slate-300 mx-auto mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            <h3 class="text-2xl font-black text-secondary mb-2">Belum Ada Berita</h3>
            <p class="text-slate-500">Artikel akan diupdate oleh admin secara berkala.</p>
        </div>
        @endif
        
    </div>
</div>
@endsection
