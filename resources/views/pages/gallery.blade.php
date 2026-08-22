@extends('components.layout')
@section('title', 'Galeri Proyek - Graha Land Serang')

@section('content')
<div class="bg-secondary pt-32 pb-16 relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=2070')] opacity-10 bg-cover bg-center"></div>
    <div class="max-w-7xl mx-auto px-4 xl:px-8 relative z-10 text-left text-white">
        <div class="flex flex-wrap items-center text-sm font-bold text-slate-400 mb-10 space-x-2">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <span class="text-primary">Galeri</span>
        </div>
        
        <div class="mb-5">
            <span class="bg-primary/20 border border-primary text-primary font-bold text-xs md:text-sm px-4 py-1.5 rounded-full uppercase tracking-wider">Momen Kawasan</span>
        </div>
        <h1 class="text-4xl md:text-5xl lg:text-7xl font-black mb-4 tracking-tight drop-shadow-md">Galeri & Pembangunan</h1>
        <p class="text-slate-400 text-base md:text-lg max-w-2xl">Visualisasi potret nyata kehidupan dan progres masif pembangunan kawasan Graha Land Serang yang terus bertumbuh pesat dan konsisten setiap harinya.</p>
    </div>
</div>

<div class="py-24 bg-light" x-data="{ mediaFilter: 'all', categoryFilter: 'all', lightboxOpen: false, lightboxType: 'image', lightboxSrc: '', lightboxCaption: '' }">
    <div class="max-w-7xl mx-auto px-4 xl:px-8">
        
        <!-- Media Type & Category Filters -->
        <div class="flex flex-col items-center gap-6 mb-16">
            <!-- Media Type -->
            <div class="flex flex-wrap gap-3 justify-center p-2 bg-white rounded-full shadow-sm border border-slate-100">
                <button @click="mediaFilter = 'all'" :class="{'bg-primary text-white shadow-md': mediaFilter === 'all', 'text-slate-500 hover:text-slate-800': mediaFilter !== 'all'}" class="px-6 py-2 rounded-full font-bold text-sm transition">🌐 Semua Media</button>
                <button @click="mediaFilter = 'image'" :class="{'bg-primary text-white shadow-md': mediaFilter === 'image', 'text-slate-500 hover:text-slate-800': mediaFilter !== 'image'}" class="px-6 py-2 rounded-full font-bold text-sm transition">📸 Foto</button>
                <button @click="mediaFilter = 'video'" :class="{'bg-primary text-white shadow-md': mediaFilter === 'video', 'text-slate-500 hover:text-slate-800': mediaFilter !== 'video'}" class="px-6 py-2 rounded-full font-bold text-sm transition">🎥 Video</button>
            </div>
            
            <!-- Category Tabs -->
            @if($groupedGalleries->count() > 0)
            <div class="flex flex-wrap gap-2 justify-center">
                <button @click="categoryFilter = 'all'" :class="{'bg-slate-800 text-white': categoryFilter === 'all', 'bg-white text-slate-500 hover:bg-slate-100 border border-slate-200': categoryFilter !== 'all'}" class="px-5 py-2 rounded-lg font-bold text-xs uppercase tracking-wider transition">Semua Kategori</button>
                @foreach($groupedGalleries->keys() as $category)
                <button @click="categoryFilter = '{{ Str::slug($category) }}'" :class="{'bg-slate-800 text-white': categoryFilter === '{{ Str::slug($category) }}', 'bg-white text-slate-500 hover:bg-slate-100 border border-slate-200': categoryFilter !== '{{ Str::slug($category) }}'}" class="px-5 py-2 rounded-lg font-bold text-xs uppercase tracking-wider transition">{{ $category }}</button>
                @endforeach
            </div>
            @endif
        </div>

        <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">
            @forelse($groupedGalleries as $category => $galleries)
                @foreach($galleries as $gallery)
                @php
                    $isVid = $gallery->type === 'video';
                    $vidId = '';
                    $embedUrl = '';
                    $thumbSrc = Storage::url($gallery->image);
                    
                    if($isVid) {
                        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $gallery->video_url, $match);
                        $vidId = $match[1] ?? '';
                        if($vidId) {
                            $embedUrl = "https://www.youtube.com/embed/{$vidId}?autoplay=1";
                            $thumbSrc = "https://img.youtube.com/vi/{$vidId}/maxresdefault.jpg";
                        }
                    }
                @endphp
                <div x-show="(mediaFilter === 'all' || mediaFilter === '{{ $gallery->type }}') && (categoryFilter === 'all' || categoryFilter === '{{ Str::slug($category) }}')" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-90"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="break-inside-avoid relative rounded-3xl overflow-hidden group cursor-pointer shadow-xl shadow-slate-200/50 mb-6 bg-slate-100 aspect-[4/3] flex items-center justify-center"
                     @click="lightboxOpen = true; lightboxType = '{{ $gallery->type }}'; lightboxSrc = '{{ $isVid ? $embedUrl : $thumbSrc }}'; lightboxCaption = '{{ addslashes($gallery->caption ?? $gallery->category) }}'">
                    
                    <img src="{{ $thumbSrc }}" alt="{{ $gallery->caption ?? 'Galeri' }}" class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    
                    @if($isVid)
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-10 bg-black/20 group-hover:bg-transparent transition duration-500">
                        <div class="w-16 h-16 bg-white/90 backdrop-blur-md rounded-full flex items-center justify-center shadow-[0_0_30px_rgba(255,255,255,0.4)] group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8 text-red-600 ml-1.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                    @endif
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-secondary/90 via-secondary/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-8 z-20">
                        <span class="text-accent text-xs font-black uppercase tracking-wider mb-2">{{ $gallery->category }}</span>
                        @if($gallery->caption)<p class="text-white font-bold text-lg leading-snug">{{ $gallery->caption }}</p>@endif
                    </div>
                </div>
                @endforeach
            @empty
            <div class="col-span-full py-12 text-center text-slate-500 font-bold bg-white rounded-3xl border border-slate-100">
                Data galeri foto belum tersedia saat ini.
            </div>
            @endforelse
        </div>
    </div>
    
    <!-- Alpine Lightbox Modal -->
    <div x-show="lightboxOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-10" x-transition.opacity>
        <div class="absolute inset-0 bg-secondary/95 backdrop-blur-md" @click="lightboxOpen = false; lightboxSrc = ''"></div>
        <div class="relative z-10 max-w-5xl w-full mx-auto flex flex-col items-center justify-center h-full" x-transition.scale>
            <button @click="lightboxOpen = false; lightboxSrc = ''" class="absolute top-4 right-4 md:-top-6 md:-right-6 w-12 h-12 bg-white/10 hover:bg-white text-white hover:text-secondary rounded-full flex items-center justify-center transition duration-300 z-20 backdrop-blur-md">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            
            <template x-if="lightboxType === 'image'">
                <img :src="lightboxSrc" class="max-w-full max-h-[80vh] object-contain rounded-2xl shadow-2xl">
            </template>
            <template x-if="lightboxType === 'video'">
                <div class="w-full aspect-video bg-black rounded-2xl overflow-hidden shadow-2xl relative">
                    <iframe :src="lightboxSrc" class="absolute inset-0 w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </template>
            
            <p x-show="lightboxCaption" class="text-white font-bold text-xl mt-6 text-center w-full bg-black/50 p-4 rounded-xl backdrop-blur-md" x-text="lightboxCaption"></p>
        </div>
    </div>
</div>
@endsection
