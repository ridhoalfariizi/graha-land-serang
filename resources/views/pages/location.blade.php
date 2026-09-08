@extends('components.layout')
@section('title', 'Lokasi Proyek - Graha Land Serang')

@section('content')
<div class="bg-secondary pt-32 pb-16 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=2070')] opacity-10 bg-cover bg-center"></div>
<div class="max-w-7xl mx-auto px-4 xl:px-8 text-left text-white">
        <div class="flex flex-wrap items-center text-sm font-bold text-white/70 mb-10 space-x-2">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <span class="text-white font-black drop-shadow-sm">Lokasi & Akses</span>
        </div>
        
        <div class="mb-5">
            <span class="bg-white/20 border border-white/40 text-white shadow-sm font-bold text-xs md:text-sm px-4 py-1.5 rounded-full uppercase tracking-wider">Akses Sentral</span>
        </div>
        <h1 class="text-4xl md:text-5xl lg:text-7xl font-black mb-4 tracking-tight drop-shadow-md">Lokasi Sangat Strategis</h1>
        <p class="text-white/90 text-base md:text-lg max-w-2xl drop-shadow-sm">Terletak di jantung mobilitas Kota Serang. Memastikan nilai investasi Anda terus naik secara konsisten setiap tahunnya dan mempermudah segala urusan rutinitas kehidupan keluarga Anda.</p>
    </div>
</div>

<div class="py-24 bg-[#F8FAFC]">
    <div class="max-w-7xl mx-auto px-4 xl:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 lg:gap-16 items-start">
            
            <!-- Map (3 cols) -->
            <div class="lg:col-span-3 bg-white p-4 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 relative group overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-tr from-primary/10 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 pointer-events-none rounded-[2rem]"></div>
                @if(!empty($settings['location_embed']))
                    <iframe src="{{ $settings['location_embed'] }}" class="w-full h-[400px] sm:h-[500px] lg:h-[600px] rounded-3xl relative z-10" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                @else
                    <div class="w-full h-[500px] flex flex-col items-center justify-center text-slate-300 rounded-3xl bg-slate-50 border-2 border-dashed border-slate-200 relative z-10">
                        <svg class="w-16 h-16 mb-4 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="font-bold uppercase tracking-wider text-sm">Google Maps Belum Diatur</span>
                    </div>
                @endif
            </div>

            <!-- Nearby Places (2 cols) -->
            <div class="lg:col-span-2 flex flex-col justify-center h-full">
                <div class="mb-10">
                    <h3 class="text-3xl lg:text-4xl font-black text-secondary mb-4 leading-tight">Pusat Mobilitas Terdekat</h3>
                    <p class="text-slate-500 text-lg leading-relaxed">Berada persis di tengah pusaran kawasan padat yang terus berkembang. Dekat dengan pusat perbelanjaan, rumah sakit, institusi pendidikan, dan akses lintasan gerbang jalan tol.</p>
                </div>
                
                <div class="space-y-4 relative">
                    <!-- Decor line -->
                    <div class="absolute left-6 top-8 bottom-8 w-0.5 bg-slate-200 hidden sm:block"></div>

                    @if(!empty($settings['nearby_places']))
                        @foreach($settings['nearby_places'] as $place)
                        <div class="flex items-center p-4 bg-white rounded-2xl shadow-sm border border-slate-100 hover:-translate-y-1 hover:shadow-md hover:border-primary/30 transition duration-300 relative z-10 group">
                            <div class="w-12 h-12 rounded-xl bg-slate-50 text-slate-400 group-hover:bg-primary/10 group-hover:text-white transition-colors flex items-center justify-center shrink-0 border border-slate-100 mr-5">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <span class="text-base lg:text-lg font-bold text-secondary group-hover:text-white transition-colors flex-1">{{ $place }}</span>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center p-8 bg-white rounded-3xl border border-slate-100 border-dashed">
                            <p class="text-slate-500 font-bold">Belum ada rute sekitar yang dimasukkan ke dalam sistem oleh Admin.</p>
                        </div>
                    @endif
                </div>
                
                <div class="mt-12 flex flex-col sm:flex-row gap-4">
                    <a href="https://maps.google.com" target="_blank" class="inline-flex items-center justify-center gap-2 px-6 py-4 bg-secondary text-white font-bold rounded-xl hover:bg-black transition-colors w-full sm:w-auto shadow-lg">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        Buka Aplikasi Maps
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
