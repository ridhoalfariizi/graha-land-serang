@extends('components.layout')
@section('title', $settings['site_name'] ?? 'Perumahan Subsidi Modern Graha Land Serang')

@section('content')
<!-- 1. Hero Section -->
<section class="relative min-h-screen flex items-center justify-center pt-20" x-data="{ 
    isVideoPlaying: true,
    currentImageIndex: 0,
    images: [
        '{{ !empty($settings['hero_image_1']) ? Storage::url($settings['hero_image_1']) : asset('images/desain rumah/gambar 1.jpeg') }}',
        '{{ !empty($settings['hero_image_2']) ? Storage::url($settings['hero_image_2']) : asset('images/desain rumah/gambar 2.jpeg') }}',
        '{{ !empty($settings['hero_image_3']) ? Storage::url($settings['hero_image_3']) : asset('images/desain rumah/gambar 3.jpeg') }}',
        '{{ !empty($settings['hero_image_4']) ? Storage::url($settings['hero_image_4']) : asset('images/desain rumah/gambar 4.jpeg') }}'
    ],
    init() {
        setInterval(() => {
            if (!this.isVideoPlaying) {
                this.currentImageIndex = (this.currentImageIndex + 1) % this.images.length;
            }
        }, 6000);
    }
}">
    <div class="absolute inset-0 z-0 bg-black overflow-hidden">
        <!-- Interactive Background Slider -->
        <template x-for="(imgSrc, index) in images">
            <img :src="imgSrc" alt="Graha Land Area" class="absolute inset-0 w-full h-full object-cover select-none transition-all duration-[3000ms] block" :class="(!isVideoPlaying && currentImageIndex === index) ? 'opacity-100 scale-100 z-10' : 'opacity-0 scale-110 z-0'">
        </template>
        
        <!-- Intro Video Background -->
        <video 
            x-show="isVideoPlaying"
            x-transition:leave="transition ease-in duration-[2000ms]"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-110"
            src="{{ !empty($settings['hero_video']) ? Storage::url($settings['hero_video']) : asset('images/video/vd graha land.mp4') }}" 
            class="absolute inset-0 w-full h-full object-cover select-none"
            autoplay muted playsinline preload="auto"
            x-on:ended="isVideoPlaying = false"
            x-on:error="isVideoPlaying = false"
        ></video>

        <div class="absolute inset-0 bg-secondary/80"></div>
    </div>
    
    <div class="relative z-10 text-center max-w-5xl mx-auto px-4 xl:px-8 pb-24 lg:pb-32">
        <span class="inline-block py-1.5 px-4 rounded-full bg-primary/20 border border-primary/50 text-white font-bold text-sm tracking-widest uppercase mb-6 shadow-xl backdrop-blur-md">
            Terbaik di Kelasnya
        </span>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white mb-8 leading-tight tracking-tight">
            Hunian <span class="text-primary relative inline-block">Asri Mewah Modern<svg class="absolute w-full h-3 -bottom-1 left-0 text-accent" fill="currentColor" preserveAspectRatio="none" viewBox="0 0 100 10"><path d="M0,5 Q50,15 100,5 L100,10 L0,10 Z"></path></svg></span> di Kota Serang
        </h1>
        <p class="text-lg md:text-xl text-slate-300 font-medium mb-12 max-w-3xl mx-auto leading-relaxed">
            Miliki rumah impian dengan lokasi strategis, lingkungan nyaman, dan harga terjangkau bagi keluarga masa kini. Dapatkan unit eksklusif Anda sebelum kehabisan!
        </p>
        
        <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8 relative z-20">
            <a href="https://wa.me/62{{ ltrim($settings['contact_phone'] ?? '85947418388', '0') }}" class="px-8 py-4 bg-primary text-white font-bold rounded-2xl hover:-translate-y-1 hover:shadow-2xl hover:shadow-primary/40 transition duration-300 flex items-center justify-center gap-3 text-lg lg:text-xl relative overflow-hidden group">
                <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                <div class="bg-white text-primary w-8 h-8 rounded-full flex items-center justify-center shrink-0 relative z-10">
                    <svg class="w-5 h-5 ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.898-4.45 9.896-9.896-.002-5.451-4.452-9.898-9.907-9.897-5.446 0-9.891 4.444-9.891 9.895 0 1.954.551 3.791 1.597 5.421l1.109 1.72-1.127 4.116 4.22-.112-1.289-2.839zm8.566-4.665c-.078-.13-.286-.207-.598-.363-.312-.156-1.848-.912-2.133-1.017-.286-.104-.495-.156-.704.156-.208.312-.806 1.017-.988 1.225-.182.208-.364.234-.676.078-.312-.156-1.319-.487-2.513-1.554-1.194-1.066-1.565-1.516-1.748-1.828-.182-.312-.02-.48.136-.636.155-.156.312-.363.468-.545.156-.182.208-.312.312-.52.104-.208.052-.39-.026-.546-.078-.156-.704-1.696-.964-2.32-.26-.624-.525-.536-.704-.546-.182-.01-.39-.01-.598-.01-.208 0-.546.078-.832.39-.286.312-1.092 1.066-1.092 2.6s1.118 3.016 1.274 3.224c.156.208 2.203 3.364 5.337 4.718 3.134 1.354 3.134.904 3.706.852.572-.052 1.848-.755 2.108-1.483.26-.728.26-1.354.182-1.483z"/></svg>
                </div>
                <span class="relative z-10">Hubungi Marketing</span>
            </a>
            <a href="#tiperumah" class="px-8 py-4 bg-white/10 backdrop-blur-md border border-white/20 text-white font-bold rounded-2xl hover:bg-white hover:text-secondary hover:-translate-y-1 transition duration-300 text-lg lg:text-xl flex items-center justify-center relative z-20">
                Lihat Tipe Rumah
            </a>
        </div>
    </div>
</section>

<!-- 2. Promo Modern -->
@if($promos->count() > 0)
<section id="promo" class="pt-10 pb-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 xl:px-8 relative z-10 -mt-10 md:-mt-16">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-6">
            @foreach($promos as $promo)
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl p-5 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] border border-slate-100 flex flex-col items-center text-center gap-3 hover:-translate-y-2 hover:shadow-[0_20px_40px_-15px_rgba(94,142,46,0.3)] transition-all duration-300 group">
                <div class="w-14 h-14 bg-gradient-to-br from-[#E8F5E9] to-[#C8E6C9] rounded-2xl flex items-center justify-center shrink-0 text-primary shadow-inner group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <h3 class="text-sm md:text-base font-black text-secondary group-hover:text-white transition-colors">{{ $promo->title }}</h3>
                    @if($promo->description)
                        <p class="text-xs text-slate-500 mt-1 hidden xl:block">{{ $promo->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif



<!-- 4. Pilihan Tipe Rumah -->
<section id="tiperumah" class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 xl:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-primary font-bold uppercase tracking-widest text-sm mb-4 block">Unit Eksklusif</span>
            <h2 class="text-4xl md:text-5xl font-black text-secondary mb-6 leading-tight">Pilihan Tipe Rumah Terbaik</h2>
            <p class="text-lg text-slate-500">Kami menyediakan hunian subsidi yang pas, terjangkau, dan nyaman untuk dinamika masa depan keluarga Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $displayHouses = $houses->count() > 0 ? collect($houses->all()) : collect();
                
                // Mapped custom images user uploaded
                $customImages = ['gambar 2.jpeg', 'gambar 3.jpeg', 'gambar 4.jpeg'];
                $index = 0;
            @endphp
            
            @if($displayHouses->count() == 0)
                <div class="col-span-full py-16 text-center bg-slate-50 rounded-3xl border border-slate-100 shadow-sm mt-8">
                    <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <h3 class="text-lg font-bold text-slate-600">Unit Belum Tersedia</h3>
                </div>
            @else
            @foreach($displayHouses as $house)
            <div class="bg-white rounded-3xl overflow-hidden shadow-xl shadow-slate-200/50 border border-slate-100 group flex flex-col hover:-translate-y-2 transition-transform duration-500">
                <div class="relative h-72 overflow-hidden bg-slate-100">
                    <img src="{{ isset($house->id) ? asset('images/desain rumah/' . $customImages[$index % 3]) : '' }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute top-4 right-4">
                        <span class="bg-primary text-white text-xs font-black px-4 py-2 rounded-xl shadow-lg shadow-primary/30 uppercase tracking-wider">Ready Stok</span>
                    </div>
                </div>
                <div class="p-8 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-2xl font-black text-secondary">{{ $house->name }}</h3>
                        <div class="text-right">
                            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Cicilan Mulai</span>
                            <span class="font-black text-primary whitespace-nowrap">{{ $house->price ? 'Rp'.number_format($house->price, 0, ',', '.') : 'Hub Marketing' }}</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-y-4 gap-x-2 mb-8">
                        <div class="flex items-center gap-3 text-slate-600 bg-slate-50 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span class="font-bold text-sm">LB {{ $house->building_size }} m²</span>
                        </div>
                        <div class="flex items-center gap-3 text-slate-600 bg-slate-50 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                            <span class="font-bold text-sm">LT {{ $house->land_size }} m²</span>
                        </div>
                        <div class="flex items-center gap-3 text-slate-600 bg-slate-50 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.77z"></path></svg>
                            <span class="font-bold text-sm">{{ $house->bedrooms }} K.Tidur</span>
                        </div>
                        <div class="flex items-center gap-3 text-slate-600 bg-slate-50 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            <span class="font-bold text-sm">{{ $house->bathrooms }} K.Mandi</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('house-type.detail', $house->slug) }}" class="mt-auto block w-full py-3.5 bg-secondary text-white font-bold text-center rounded-xl hover:bg-black transition duration-300 shadow-md">
                        Lihat Detail Spesifikasi
                    </a>
                </div>
            </div>
            @php $index++; @endphp
            @if($index == 3) @php break; @endphp @endif
            @endforeach
            @endif
        </div>
        
        <div class="mt-16 text-center">
            <a href="{{ route('house-types') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-transparent border-2 border-primary text-primary font-bold rounded-2xl hover:bg-primary hover:text-white transition duration-300">
                Lihat Semua Tipe Rumah
            </a>
        </div>
    </div>
</section>

<!-- 4.5. Master Plan Kawasan -->
<section class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 xl:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-primary font-bold uppercase tracking-widest text-sm mb-4 block">Denah Terpadu</span>
            <h2 class="text-4xl md:text-5xl font-black text-secondary mb-6 leading-tight">Master Plan Graha Land</h2>
            <p class="text-lg text-slate-500">Lihat tata letak kawasan hunian kami secara menyeluruh. Terintegrasi, asri, dan tertata dengan sangat rapi untuk kenyamanan maksimal Anda.</p>
        </div>
        
        <div x-data="{ expanded: false }" class="relative rounded-3xl p-4 md:p-8 shadow-2xl shadow-slate-200 bg-slate-50 border border-slate-100 mx-auto">
            <button @click="expanded = true" class="absolute top-4 right-4 md:top-8 md:right-8 z-20 bg-white/90 shadow-xl backdrop-blur-md px-3 py-2 md:px-4 text-xs md:text-sm rounded-xl text-primary font-bold flex items-center gap-2 hover:bg-primary hover:text-white transition duration-300">
                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" /></svg>
                Perbesar
            </button>
            <div class="overflow-hidden rounded-2xl w-full h-[300px] md:h-[450px] lg:h-[600px] flex items-center justify-center bg-white cursor-pointer" @click="expanded = true">
                <img src="{{ asset('images/desain denah & yang lain/master plan.png') }}" class="w-full h-full object-contain hover:scale-105 transition-transform duration-700">
            </div>

            <!-- Lightbox Overlay -->
            <div x-show="expanded" class="fixed inset-0 z-[100] bg-secondary/95 backdrop-blur-md flex items-center justify-center p-4 transition-opacity" style="display: none;">
                <button @click="expanded = false" class="absolute top-6 right-6 md:top-10 md:right-10 bg-white/10 hover:bg-white/20 text-white rounded-full p-3 transition duration-300">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                <img src="{{ asset('images/desain denah & yang lain/master plan.png') }}" class="max-w-full max-h-[90vh] object-contain rounded-xl shadow-2xl cursor-zoom-out" @click="expanded = false" @click.away="expanded = false">
            </div>
        </div>
    </div>
</section>

<!-- 5. Fasilitas Unggulan (Photo based) -->
<section class="py-24 bg-light" x-data="{ modalOpen: false, modalTitle: '', modalDesc: '', modalImg: '' }">
    <div class="max-w-7xl mx-auto px-4 xl:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="max-w-xl">
                <span class="text-primary font-bold uppercase tracking-widest text-sm mb-4 block">Nilai Tambah</span>
                <h2 class="text-4xl font-black text-secondary leading-tight">Fasilitas Kawasan Berkualitas</h2>
            </div>
            <a href="{{ route('facilities') }}" class="text-primary font-bold hover:text-green-700 transition flex items-center gap-2">
                Jelajahi Fasilitas <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($facilities as $facility)
            <div class="group relative rounded-3xl overflow-hidden h-80 bg-slate-100 flex items-center justify-center border border-slate-200 cursor-pointer shadow-lg shadow-slate-200/50 hover:-translate-y-2 transition duration-500"
                 @click="modalOpen = true; modalTitle = '{{ addslashes($facility->name) }}'; modalDesc = '{{ addslashes($facility->description ?? '') }}'; modalImg = '{{ $facility->image ? Storage::url($facility->image) : '' }}'">
                @if($facility->image)
                    <img src="{{ Storage::url($facility->image) }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700">
                @else
                    <div class="flex flex-col items-center justify-center text-slate-300">
                        <svg class="w-12 h-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0V17H4m4-10a2 2 0 110-4 2 2 0 010 4z"/></svg>
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Belum Ada Foto</span>
                    </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-secondary/90 via-secondary/20 to-transparent pointer-events-none"></div>
                
                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm p-3 rounded-full text-primary opacity-0 group-hover:opacity-100 transition shadow-lg shrink-0 z-20">
                     <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>

                <div class="absolute bottom-6 left-6 right-6 z-10 pointer-events-none">
                    <h3 class="text-white font-black text-xl mb-2">{{ $facility->name }}</h3>
                    <p class="text-white/80 text-sm line-clamp-2">{{ $facility->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    <!-- Alpine Detail Modal -->
    <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-10 text-left" x-transition.opacity>
        <div class="absolute inset-0 bg-secondary/90 backdrop-blur-sm" @click="modalOpen = false"></div>
        <div class="relative z-10 max-w-4xl w-full bg-white rounded-3xl overflow-hidden shadow-2xl flex flex-col lg:flex-row" x-transition.scale>
            <button @click="modalOpen = false" class="absolute top-4 right-4 w-10 h-10 bg-slate-100/50 hover:bg-slate-100 text-secondary rounded-full flex items-center justify-center transition duration-300 z-20 backdrop-blur-md">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div class="w-full lg:w-1/2 h-64 lg:h-[500px] flex items-center justify-center bg-slate-100">
                <template x-if="modalImg">
                    <img :src="modalImg" class="w-full h-full object-cover">
                </template>
                <template x-if="!modalImg">
                    <div class="flex flex-col items-center justify-center text-slate-300 w-full h-full bg-slate-100">
                        <svg class="w-16 h-16 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0V17H4m4-10a2 2 0 110-4 2 2 0 010 4z"/></svg>
                        <span class="text-xs font-black uppercase tracking-widest text-slate-400">Belum Ada Foto</span>
                    </div>
                </template>
            </div>
            <div class="w-full lg:w-1/2 p-10 lg:p-12 flex flex-col justify-center text-left">
                <span class="text-primary font-bold tracking-widest uppercase text-sm mb-4 block">Detail Fasilitas</span>
                <h3 class="text-3xl font-black text-secondary mb-6" x-text="modalTitle"></h3>
                <p class="text-lg text-slate-600 leading-relaxed mb-8" x-text="modalDesc"></p>
                <button @click="modalOpen = false" class="w-full py-4 bg-primary text-white font-bold rounded-xl hover:bg-green-600 transition shadow-lg shadow-primary/30">
                    Tutup Detail
                </button>
            </div>
        </div>
    </div>
</section>

<!-- 6. Lokasi Strategis -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 xl:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="text-primary font-bold uppercase tracking-widest text-sm mb-4 block">Akses Sentral</span>
                <h2 class="text-4xl md:text-5xl font-black text-secondary mb-6 leading-tight">Lokasi Sangat Strategis</h2>
                <p class="text-lg text-slate-600 mb-8 leading-relaxed">
                    Terletak di jantung mobilitas, memastikan nilai investasi Anda naik setiap tahunnya dan mempermudah urusan kehidupan Anda.
                </p>
                
                <div class="space-y-4 mb-10">
                    <div class="flex items-center justify-between p-4 bg-light rounded-2xl border border-slate-100">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg></div>
                            <span class="font-bold text-secondary">Pusat Kota Serang</span>
                        </div>
                        <span class="text-sm font-bold text-primary bg-primary/10 px-3 py-1 rounded-lg">10 Menit</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-light rounded-2xl border border-slate-100">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-red-100 text-red-600 rounded-xl flex items-center justify-center"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg></div>
                            <span class="font-bold text-secondary">Rumah Sakit Umum</span>
                        </div>
                        <span class="text-sm font-bold text-primary bg-primary/10 px-3 py-1 rounded-lg">5 Menit</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-light rounded-2xl border border-slate-100">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-yellow-100 text-yellow-600 rounded-xl flex items-center justify-center"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg></div>
                            <span class="font-bold text-secondary">Pendidikan Terpadu</span>
                        </div>
                        <span class="text-sm font-bold text-primary bg-primary/10 px-3 py-1 rounded-lg">3 Menit</span>
                    </div>
                </div>
                <a href="{{ route('location') }}" class="px-8 py-4 bg-secondary text-white font-bold rounded-xl hover:bg-black transition duration-300 inline-block">Lihat Peta Lokasi</a>
            </div>
            
            <div class="bg-slate-200 rounded-3xl overflow-hidden h-[500px] shadow-2xl relative">
                @if(!empty($settings['location_embed']))
                    <iframe src="{{ $settings['location_embed'] }}" class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                @else
                    <div class="absolute inset-0 flex items-center justify-center text-slate-500 font-bold">Maps Embed Kosong</div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- 7. Galeri Terbaru -->
<section class="py-24 bg-secondary text-white">
    <div class="max-w-7xl mx-auto px-4 xl:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black mb-6">Momen & Galeri Pembangunan</h2>
            <p class="text-slate-400">Bukti nyata progres kawasan yang berkembang sangat pesat.</p>
        </div>
        
        <div class="columns-1 sm:columns-2 md:columns-3 gap-6 space-y-6">
            @foreach($galleries as $gal)
            <div class="relative rounded-2xl overflow-hidden break-inside-avoid shadow-lg bg-black group p-0 aspect-[4/3] flex items-center justify-center">
                @php
                    $isVid = $gal->type === 'video';
                    $thumbSrc = Storage::url($gal->image);
                    
                    if($isVid) {
                        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $gal->video_url, $match);
                        $vidId = $match[1] ?? '';
                        if($vidId) {
                            $thumbSrc = "https://img.youtube.com/vi/{$vidId}/maxresdefault.jpg";
                        }
                    }
                @endphp
                <img src="{{ $thumbSrc }}" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-105 transition duration-500">
                
                @if($isVid)
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-10">
                    <div class="w-12 h-12 bg-white/90 backdrop-blur-md rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                        <svg class="w-6 h-6 text-red-600 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        
        <div class="mt-16 text-center">
            <a href="{{ route('galleries') }}" class="inline-block px-8 py-4 bg-white/10 backdrop-blur-md border border-white/20 text-white font-bold rounded-2xl hover:bg-white hover:text-secondary transition duration-300">
                Lihat Semua Galeri
            </a>
        </div>
    </div>
</section>

<!-- 8. Testimoni Pembeli (Refined Carousel) -->
@if(!empty($testimonials) && count($testimonials) > 0)
<section class="py-24 bg-light overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 xl:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-primary font-bold uppercase tracking-widest text-sm mb-4 block">Cerita Konsumen</span>
            <h2 class="text-4xl font-black text-secondary leading-tight">Apa Kata Warga Kami?</h2>
        </div>
        
        <div class="relative" x-data="{ 
            init() {
                setInterval(() => {
                    if(this.$refs.slider.scrollLeft + this.$refs.slider.clientWidth >= this.$refs.slider.scrollWidth - 10) {
                        this.$refs.slider.scrollTo({ left: 0, behavior: 'smooth' });
                    } else {
                        this.$refs.slider.scrollBy({ left: 400, behavior: 'smooth' });
                    }
                }, 5000);
            },
            next() { this.$refs.slider.scrollBy({ left: 400, behavior: 'smooth' }); }, 
            prev() { this.$refs.slider.scrollBy({ left: -400, behavior: 'smooth' }); }
        }">
            
            <!-- Navigation Control Arrows -->
            <button @click="prev()" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-2 md:-translate-x-6 z-10 bg-white/90 backdrop-blur-md shadow-2xl text-primary w-12 h-12 md:w-14 md:h-14 rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition-colors border border-slate-100 hidden md:flex cursor-pointer"><svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></button>
            
            <button @click="next()" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-2 md:translate-x-6 z-10 bg-white/90 backdrop-blur-md shadow-2xl text-primary w-12 h-12 md:w-14 md:h-14 rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition-colors border border-slate-100 hidden md:flex cursor-pointer"><svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></button>
            
            <!-- Items Container -->
            <div x-ref="slider" class="flex gap-6 md:gap-8 overflow-x-auto pb-8 snap-x snap-mandatory pt-4 hide-scrollbar scroll-smooth">
                @foreach($testimonials as $testi)
                <div class="snap-center shrink-0 w-[85vw] md:w-96 bg-white p-8 md:p-10 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-2xl hover:shadow-primary/10 hover:-translate-y-1 transition-all duration-300 border border-slate-50 flex flex-col justify-between group">
                    <div>
                        <div class="text-amber-400 flex gap-1 mb-6">
                            @for($i=0; $i<$testi->rating; $i++)
                            <svg class="w-5 h-5 grow-animation" style="animation-delay: {{ $i * 100 }}ms" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <p class="text-slate-600 text-lg leading-relaxed mb-8 italic line-clamp-4 relative">
                            <span class="absolute -top-4 -left-3 text-4xl text-slate-200 font-serif leading-none">"</span>
                            {{ $testi->content }}
                            <span class="absolute -bottom-4 -right-1 text-4xl text-slate-200 font-serif leading-none">"</span>
                        </p>
                    </div>
                    <div class="flex items-center gap-4 pt-6 mt-auto">
                        @if($testi->photo)
                        <img src="{{ Storage::url($testi->photo) }}" class="w-14 h-14 rounded-full object-cover shadow-md border-2 border-primary/20">
                        @else
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-primary/20 to-primary/5 text-primary shadow-inner flex items-center justify-center font-black text-xl border border-primary/20">{{ substr($testi->name, 0, 1) }}</div>
                        @endif
                        <div>
                            <h4 class="font-bold text-secondary text-lg group-hover:text-white transition-colors">{{ $testi->name }}</h4>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $testi->profession ?? 'Warga Graha Land' }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
        </div>
    </div>
</section>
@endif

<!-- 9. FAQ Singkat & Artikel -->
<section class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 xl:px-8">
        
        <!-- Articles Preview -->
        @if(isset($articles) && $articles->count() > 0)
        <div class="mb-24">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <span class="text-primary font-bold uppercase tracking-widest text-sm mb-4 block">Informasi Terbaru</span>
                    <h2 class="text-4xl font-black text-secondary">Artikel Properti</h2>
                </div>
                <a href="{{ route('articles') }}" class="text-primary font-bold hover:text-green-700 hidden md:block">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($articles as $article)
                <a href="{{ route('article.detail', $article->slug) }}" class="group bg-light rounded-3xl overflow-hidden border border-slate-100 hover:shadow-2xl hover:-translate-y-2 transition duration-300">
                    <div class="h-56 overflow-hidden">
                        <img src="{{ $article->thumbnail ? Storage::url($article->thumbnail) : asset('images/desain rumah/gambar 2.jpeg') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    </div>
                    <div class="p-6">
                        <span class="text-primary font-bold text-xs uppercase mb-3 block">{{ $article->published_at->format('d M Y') }}</span>
                        <h3 class="text-xl font-black text-secondary mb-3 group-hover:text-white transition">{{ $article->title }}</h3>
                        <p class="text-slate-500 text-sm line-clamp-3">{{ strip_tags($article->content) }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- FAQ Section -->
        <div class="bg-secondary p-10 md:p-16 rounded-3xl shadow-2xl mt-12 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-4xl font-black text-white mb-6">Pertanyaan Populer (FAQ)</h2>
                <p class="text-slate-400 mb-8">Pahami detail skema KPR, booking, dan aturan lingkungan di hunian kami secara transparan.</p>
                <a href="{{ route('faq') }}" class="inline-block px-8 py-4 bg-primary text-white font-bold rounded-xl hover:bg-green-600 transition shadow-lg shadow-primary/30">Lanjut Pusat Bantuan</a>
            </div>
            <div class="space-y-4" x-data="{ activeAccordion: null }">
                @if(isset($faqs) && count($faqs) > 0)
                    @foreach($faqs as $faq)
                    <div class="bg-white/10 rounded-2xl overflow-hidden">
                        <button @click="activeAccordion = activeAccordion === {{ $faq->id }} ? null : {{ $faq->id }}" class="w-full px-6 py-4 flex justify-between items-center text-left focus:outline-none">
                            <span class="font-bold text-white pr-4">{{ $faq->question }}</span>
                            <svg class="w-5 h-5 text-accent transform transition-transform" :class="{'rotate-180': activeAccordion === {{ $faq->id }}}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="activeAccordion === {{ $faq->id }}" x-collapse class="px-6 pb-6 text-slate-300 text-sm leading-relaxed">
                            {!! nl2br(e($faq->answer)) !!}
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="text-slate-400">Belum ada pertanyaan populer.</div>
                @endif
            </div>
        </div>

    </div>
</section>

<!-- 10. CTA Akhir -->
<section class="py-24 bg-primary relative overflow-hidden">
    <div class="absolute inset-0 mix-blend-overlay opacity-20 object-cover w-full h-full bg-cover bg-center" style="background-image: url('{{ asset('images/desain rumah/gambar 1.jpeg') }}');"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-4xl md:text-5xl lg:text-7xl font-black text-white mb-8 leading-tight">Miliki Rumah Impian Anda Sekarang</h2>
        <p class="text-xl text-green-100 font-medium mb-10 max-w-2xl mx-auto">Tinggalkan rumah kontrakan, berikan hadiah terbaik untuk keluarga dengan mengamankan kavling di Graha Land.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">
            <a href="https://wa.me/62{{ ltrim($settings['contact_phone'] ?? '85947418388', '0') }}" class="px-10 py-5 bg-white text-primary font-black rounded-2xl hover:scale-105 transition-transform duration-300 shadow-2xl flex items-center justify-center gap-2 text-xl">
                Hubungi Marketing
            </a>
        </div>
    </div>
</section>

<!-- Import Alpine Collapse Plugin -->
<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>

<style>
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endsection
