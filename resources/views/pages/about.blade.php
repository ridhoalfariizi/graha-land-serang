@extends('components.layout')
@section('title', 'Tentang Perumahan - Graha Land Serang')

@section('content')
<div class="bg-secondary pt-32 pb-16 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=2070')] opacity-10 bg-cover bg-center"></div>
<div class="max-w-7xl mx-auto px-4 xl:px-8 text-left text-white">
        <div class="flex flex-wrap items-center text-sm font-bold text-slate-400 mb-10 space-x-2">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <span class="text-primary">Tentang Kami</span>
        </div>
        
        <div class="mb-5">
            <span class="bg-primary/20 border border-primary text-primary font-bold text-xs md:text-sm px-4 py-1.5 rounded-full uppercase tracking-wider">Profil Perusahaan</span>
        </div>
        <h1 class="text-4xl md:text-5xl lg:text-7xl font-black mb-4 tracking-tight drop-shadow-md">Membangun Hunian Mapan Untuk Masa Depan</h1>
        <p class="text-slate-400 text-base md:text-lg max-w-2xl">Kami berdedikasi menciptakan kawasan lingkungan tempat tinggal yang tidak hanya nyaman untuk ditinggali, namun juga dirancang strategis menjadi instrumen investasi terbaik bagi masa depan berharga keluarga Anda.</p>
    </div>
</div>

<!-- 3. Tentang Graha Land (Dipindah dari Home) -->
<section class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 xl:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="relative">
                <div class="absolute inset-0 bg-primary translate-x-4 translate-y-4 rounded-3xl"></div>
                <img src="{{ asset('images/desain rumah/gambar 1.jpeg') }}" class="relative z-10 rounded-3xl shadow-2xl w-full h-[500px] object-cover">
                <div class="absolute -bottom-6 left-4 md:-bottom-8 md:-left-8 bg-white p-4 md:p-6 rounded-2xl shadow-xl z-20 border border-slate-50 flex items-center pr-8 md:pr-6">
                    <div class="flex items-center gap-3 md:gap-4">
                        <div class="text-4xl md:text-5xl font-black text-primary">5+</div>
                        <div class="text-xs md:text-sm font-bold text-slate-500 uppercase leading-snug">Tahun<br>Pengalaman</div>
                    </div>
                </div>
            </div>
            <div>
                <span class="text-primary font-bold uppercase tracking-widest text-sm mb-4 block">Mengenal Kami</span>
                <h2 class="text-4xl md:text-5xl font-black text-secondary mb-6 leading-tight">Pengembang Properti Terpercaya Kota Serang</h2>
                <div class="text-lg text-slate-600 mb-6 leading-relaxed">
                    <p class="mb-4">{{ $settings['about_text'] ?? 'Graha Land didirikan dengan visi menghadirkan kawasan hunian terpadu yang modern, aman, dan nyaman untuk mendukung produktivitas serta gaya hidup harmonis keluarga Indonesia.' }}</p>
                </div>
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 mb-10">
                    <div class="flex items-center gap-3">
                         <div class="w-12 h-12 bg-light rounded-full flex items-center justify-center text-primary shadow-sm border border-slate-100">
                             <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                         </div>
                         <span class="font-bold text-secondary">Legalitas Valid & Aman</span>
                    </div>
                    <div class="flex items-center gap-3">
                         <div class="w-12 h-12 bg-light rounded-full flex items-center justify-center text-primary shadow-sm border border-slate-100">
                             <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                         </div>
                         <span class="font-bold text-secondary">Kawasan Bebas Banjir</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visi & Misi -->
<div class="py-24 bg-light border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 xl:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Visi -->
            <div class="bg-white p-10 md:p-12 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-40 h-40 bg-primary/5 rounded-bl-full -z-10 group-hover:scale-110 transition duration-500"></div>
                <div class="w-16 h-16 bg-primary/10 text-primary rounded-2xl flex items-center justify-center mb-8 shadow-inner shadow-primary/20">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h3 class="text-3xl font-black text-secondary mb-6">Visi Kami</h3>
                <p class="text-slate-600 leading-relaxed text-lg">Menjadi pengembang properti terdepan di Serang, Banten yang dikenal secara luas karena selalu menyajikan inovasi desain arsitektur yang komprehensif, kualitas material bangunan premium standar tinggi, dan dedikasi pelayanan purna jual yang selalu berorientasi pada kepuasan pelanggan secara mutlak.</p>
            </div>
            
            <!-- Misi -->
            <div class="bg-white p-10 md:p-12 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-40 h-40 bg-accent/5 rounded-bl-full -z-10 group-hover:scale-110 transition duration-500"></div>
                <div class="w-16 h-16 bg-accent/10 text-accent rounded-2xl flex items-center justify-center mb-8 shadow-inner shadow-accent/20">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle cx="12" cy="12" r="10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="12" cy="12" r="6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="12" cy="12" r="2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="text-3xl font-black text-secondary mb-6">Misi Utama Kami</h3>
                <ul class="text-slate-600 space-y-6 text-lg">
                    <li class="flex items-start gap-4 hover:translate-x-2 transition">
                        <div class="bg-primary/20 text-primary rounded-full p-1.5 mt-1 shrink-0"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></div>
                        <span>Membangun ekosistem kawasan perumahan dengan konsep tata ruang yang asri, fungsional dan terintegrasi secara pintar.</span>
                    </li>
                    <li class="flex items-start gap-4 hover:translate-x-2 transition">
                        <div class="bg-primary/20 text-primary rounded-full p-1.5 mt-1 shrink-0"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></div>
                        <span>Memberikan berbagai kemudahan akses kepemilikan rumah impian dengan program pembiayaan yang koperatif dan fleksibel bagi semua kalangan.</span>
                    </li>
                    <li class="flex items-start gap-4 hover:translate-x-2 transition">
                        <div class="bg-primary/20 text-primary rounded-full p-1.5 mt-1 shrink-0"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></div>
                        <span>Konsisten menjaga standar *quality control* berlapis di setiap pembangunan unit demi durabilitas jangka panjang perlindungan Anda.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="py-24 bg-[#F8FAFC]">
    <div class="max-w-7xl mx-auto px-4 xl:px-8 text-center border-t border-slate-200 pt-16">
        <h2 class="text-4xl font-black text-secondary mb-4">Developer Partners</h2>
        <p class="text-slate-500 mb-12 max-w-xl mx-auto">Didukung oleh tim manajemen handal dari dua raksasa entitas perseroan di industri pengembangan hunian.</p>
        <div class="flex flex-wrap justify-center gap-12 group">
            @if(!empty($settings['developers_list']))
                @foreach($settings['developers_list'] as $dev)
                <div class="bg-white py-6 px-12 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 font-extrabold text-2xl text-slate-700 hover:text-primary transition hover:-translate-y-2 hover:border-primary">
                    {{ $dev }}
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
