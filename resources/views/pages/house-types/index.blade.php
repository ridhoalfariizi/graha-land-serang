@extends('components.layout')
@section('title', 'Pilihan Tipe Rumah - Graha Land Serang')

@section('content')
<div class="bg-secondary pt-32 pb-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=2070')] opacity-10 bg-cover bg-center"></div>
<div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-primary/20 blur-[100px] rounded-full translate-x-1/2 -translate-y-1/2"></div>
    <div class="max-w-7xl mx-auto px-4 xl:px-8 relative z-10 text-left text-white">
        <div class="flex flex-wrap items-center text-sm font-bold text-slate-400 mb-10 space-x-2">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <span class="text-primary">Tipe Rumah</span>
        </div>
        
        <div class="mb-5">
            <span class="bg-primary/20 border border-primary text-primary font-bold text-xs md:text-sm px-4 py-1.5 rounded-full uppercase tracking-wider">Katalog Unit</span>
        </div>
        <h1 class="text-4xl md:text-5xl lg:text-7xl font-black mb-4 tracking-tight drop-shadow-md">Pilihan Tipe Rumah</h1>
        <p class="text-slate-400 text-base md:text-lg max-w-2xl">
            Temukan hunian subsidi yang sempurna, terjangkau, dan berkualitas untuk pondasi awal kehidupan keluarga Anda.
        </p>
    </div>
</div>

<div class="py-24 bg-[#F8FAFC]">
    <div class="max-w-7xl mx-auto px-4 xl:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $displayHouses = $houses->count() > 0 ? collect($houses->all()) : collect();
                
                // Mapped custom images user uploaded
                $customImages = ['gambar 2.jpeg', 'gambar 3.jpeg', 'gambar 4.jpeg', 'gambar 1.jpeg'];
                $index = 0;
            @endphp
            
            @if($displayHouses->count() == 0)
                <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-slate-100 shadow-sm">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <h3 class="text-xl font-bold text-slate-600 mb-2">Belum Ada Katalog Rumah</h3>
                    <p class="text-slate-500 text-sm">Data tipe rumah akan segera ditambahkan oleh administrator kami.</p>
                </div>
            @else
            @foreach($displayHouses as $house)
            <div class="bg-white rounded-3xl overflow-hidden shadow-xl shadow-slate-200/50 border border-slate-100 group hover:-translate-y-2 transition duration-300 flex flex-col">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ isset($house->id) ? asset('images/desain rumah/' . $customImages[$index % 4]) : '' }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-accent text-secondary text-xs font-black px-3 py-1.5 rounded-xl uppercase tracking-wider shadow-lg shadow-yellow-500/20">Mulai {{ $house->price ? 'Rp'.number_format($house->price, 0, ',', '.') : 'Harga Menyesuaikan' }}</span>
                    </div>
                </div>
                <div class="p-8 flex-1 flex flex-col">
                    <h3 class="text-2xl font-black text-secondary mb-2">{{ $house->name }}</h3>
                    <p class="text-slate-500 text-sm line-clamp-2 mb-6">{{ $house->description }}</p>
                    
                    <div class="grid grid-cols-2 gap-4 mb-8 mt-auto">
                        <div class="flex items-center gap-2 text-slate-700">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span class="font-bold text-sm">LB {{ $house->building_size }} m²</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-700">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                            <span class="font-bold text-sm">LT {{ $house->land_size }} m²</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-700">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.77z" clip-rule="evenodd"></path></svg>
                            <span class="font-bold text-sm">{{ $house->bedrooms }} K.Tidur</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-700">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            <span class="font-bold text-sm">{{ $house->bathrooms }} K.Mandi</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('house-type.detail', $house->slug) }}" class="block w-full py-3 bg-slate-50 text-secondary font-bold text-center rounded-xl border border-slate-200 hover:bg-primary hover:text-white transition hover:border-primary">
                        Detail Spesifikasi
                    </a>
                </div>
            </div>
            @php $index++; @endphp
            @if($index == 6) @php break; @endphp @endif
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
