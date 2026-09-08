@extends('components.layout')
@section('title', 'Fasilitas Kawasan - Graha Land Serang')

@section('content')
<div class="bg-secondary pt-32 pb-16 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=2070')] opacity-10 bg-cover bg-center"></div>
<div class="absolute inset-0 bg-gradient-to-r from-primary/20 to-transparent"></div>
    <div class="max-w-7xl mx-auto px-4 xl:px-8 relative z-10 text-left text-white">
        <div class="flex flex-wrap items-center text-sm font-bold text-white/70 mb-10 space-x-2">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <span class="text-white font-black drop-shadow-sm">Fasilitas</span>
        </div>
        
        <div class="mb-5">
            <span class="bg-white/20 border border-white/40 text-white shadow-sm font-bold text-xs md:text-sm px-4 py-1.5 rounded-full uppercase tracking-wider">Keunggulan Klaster</span>
        </div>
        <h1 class="text-4xl md:text-5xl lg:text-7xl font-black mb-4 tracking-tight drop-shadow-md">Fasilitas Kawasan Premium</h1>
        <p class="text-white/90 text-base md:text-lg max-w-2xl drop-shadow-sm">Kami merancang Graha Land Serang tidak hanya sebagai tempat berteduh, melainkan komunitas sosial terpadu yang menunjang segala aktivitas dan kenyamanan keluarga Anda secara paripurna.</p>
    </div>
</div>

<div class="py-24 bg-light" x-data="{ modalOpen: false, modalTitle: '', modalDesc: '', modalImg: '' }">
    <div class="max-w-7xl mx-auto px-4 xl:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @php
                $displayFacilities = (isset($facilities) && count($facilities) > 0) ? collect($facilities->all()) : collect([
                    (object)['name' => 'Masjid Raya', 'description' => 'Masjid megah dan nyaman untuk ibadah warga kawasan Graha Land.', 'image' => null],
                    (object)['name' => 'Sistem Keamanan 24 Jam', 'description' => 'Keamanan One Gate System dengan pantauan CCTV terintegrasi.', 'image' => null],
                    (object)['name' => 'Taman Bermain Anak', 'description' => 'Ruang terbuka hijau dan arena bermain yang aman untuk buah hati Anda.', 'image' => null],
                    (object)['name' => 'Area Olahraga', 'description' => 'Fasilitas olahraga dan jogging track eksklusif khusus warga perumahan.', 'image' => null],
                    (object)['name' => 'Area Komersial', 'description' => 'Kemudahan berbelanja kebutuhan sehari-hari tanpa harus keluar kawasan.', 'image' => null],
                    (object)['name' => 'Jalan Paving Utama', 'description' => 'Akses jalan utama dengan lebar memadai dan material paving block berkualitas.', 'image' => null]
                ]);
            @endphp
            @foreach($displayFacilities as $facility)
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-xl shadow-slate-200/50 group hover:-translate-y-2 transition duration-500 cursor-pointer flex flex-col"
                 @click="modalOpen = true; modalTitle = '{{ addslashes($facility->name) }}'; modalDesc = '{{ addslashes($facility->description ?? '') }}'; modalImg = '{{ $facility->image ? Storage::url($facility->image) : '' }}'">
                
                <div class="relative h-64 overflow-hidden bg-slate-100 flex items-center justify-center">
                    @if($facility->image)
                        <img src="{{ Storage::url($facility->image) }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    @else
                        <div class="flex flex-col items-center justify-center text-slate-300">
                            <svg class="w-12 h-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0V17H4m4-10a2 2 0 110-4 2 2 0 010 4z"/></svg>
                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Belum Ada Foto</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-secondary/10 group-hover:bg-transparent transition duration-500"></div>
                    <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur-sm p-3 rounded-full text-primary opacity-0 group-hover:opacity-100 transition shadow-lg shrink-0">
                         <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                </div>
                
                <div class="p-8 flex-1 flex flex-col">
                    <h3 class="text-2xl font-black text-secondary mb-3">{{ $facility->name }}</h3>
                    <p class="text-slate-500 line-clamp-3 text-lg leading-relaxed">{{ $facility->description ?? 'Fasilitas eksklusif berstandar klaster untuk kemudahan dan kenyamanan keluarga Anda.' }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    <!-- Alpine Detail Modal -->
    <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-10" x-transition.opacity>
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
            <div class="w-full lg:w-1/2 p-10 lg:p-12 flex flex-col justify-center">
                <span class="text-primary font-bold tracking-widest uppercase text-sm mb-4 block">Detail Fasilitas</span>
                <h3 class="text-3xl font-black text-secondary mb-6" x-text="modalTitle"></h3>
                <p class="text-lg text-slate-600 leading-relaxed mb-8" x-text="modalDesc"></p>
                <button @click="modalOpen = false" class="w-full py-4 bg-primary text-white font-bold rounded-xl hover:bg-green-600 transition shadow-lg shadow-primary/30">
                    Tutup Detail
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
