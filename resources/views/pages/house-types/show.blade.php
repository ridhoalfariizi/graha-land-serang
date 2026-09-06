@extends('components.layout')
@section('title', $house->name . ' - Graha Land Serang')

@section('content')

<!-- 1. Hero Detail -->
<div class="bg-secondary pt-32 pb-16 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=2070')] opacity-10 bg-cover bg-center"></div>
<div class="max-w-7xl mx-auto px-4 xl:px-8 text-left text-white">
        <div class="flex flex-wrap items-center text-sm font-bold text-slate-400 mb-10 space-x-2">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <a href="{{ route('house-types') }}" class="hover:text-white transition">Pilihan Tipe Rumah</a>
            <span>/</span>
            <span class="text-primary">{{ $house->name }}</span>
        </div>
        
        <div class="mb-5">
            <span class="bg-primary/20 border border-primary text-primary font-bold text-xs md:text-sm px-4 py-1.5 rounded-full uppercase tracking-wider">Ready Stok / Indent</span>
        </div>
        <h1 class="text-4xl md:text-5xl lg:text-7xl font-black mb-4 tracking-tight drop-shadow-md">{{ $house->name }}</h1>
        <p class="text-2xl md:text-3xl text-accent font-black tracking-wide mb-4 drop-shadow-sm">{{ $house->price ? 'Rp'.number_format($house->price, 0, ',', '.') : 'Harga Menyesuaikan' }}</p>
        <p class="text-slate-400 text-base md:text-lg max-w-2xl">Diskon spesial & promo cicilan KPR sangat ringan berlaku khusus jika Anda menghubungi marketing resmi bulan ini.</p>
    </div>
</div>

<!-- 2. Gallery Slider Alpine -->
<div class="py-12 bg-[#F8FAFC]" x-data="{ 
    activeSlide: 0, 
    slides: {{ json_encode($house->images && is_array($house->images) && count($house->images) > 0 ? array_map(fn($img) => Storage::url($img), $house->images) : [asset('images/desain rumah/gambar 2.jpeg'), asset('images/desain rumah/gambar 3.jpeg'), asset('images/desain rumah/gambar 4.jpeg'), asset('images/desain rumah/gambar 1.jpeg')]) }}
}">
    <div class="max-w-5xl mx-auto px-4 xl:px-8">
        <!-- Main Image -->
        <div class="relative rounded-3xl overflow-hidden shadow-lg h-[300px] sm:h-[400px] md:h-[500px] bg-white mb-6 group border border-slate-200">
            <template x-for="(slide, index) in slides" :key="index">
                <img x-show="activeSlide === index" :src="slide" x-transition.opacity.duration.300ms class="absolute inset-0 w-full h-full object-cover">
            </template>
        </div>
        
        <!-- Thumbnails -->
        <div class="flex gap-4 overflow-x-auto hide-scrollbar pb-2 justify-start md:justify-center">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index" class="relative rounded-xl overflow-hidden h-20 w-28 md:h-24 md:w-36 shrink-0 border-2 transition-all duration-300" :class="activeSlide === index ? 'border-primary shadow-md transform -translate-y-1' : 'border-transparent opacity-60 hover:opacity-100 hover:border-slate-300 bg-slate-200'">
                    <img :src="slide" class="w-full h-full object-cover">
                </button>
            </template>
        </div>
    </div>
</div>

<!-- 3. Spesifikasi, Filter, dan Denah -->
<div class="py-16 bg-light border-y border-slate-100" x-data="{ isModalOpen: false }">
    <div class="max-w-7xl mx-auto px-4 xl:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Col 1: Spesifikasi -->
            <div class="lg:col-span-2">
                <h3 class="text-3xl font-black text-secondary mb-8">Spesifikasi Lengkap</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-10">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-center">
                        <span class="block text-slate-400 text-sm font-bold uppercase tracking-wider mb-2">Luas Bangunan</span>
                        <span class="text-2xl font-black text-secondary">{{ $house->building_size }} m²</span>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-center">
                        <span class="block text-slate-400 text-sm font-bold uppercase tracking-wider mb-2">Luas Tanah</span>
                        <span class="text-2xl font-black text-secondary">{{ $house->land_size }} m²</span>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-center">
                        <span class="block text-slate-400 text-sm font-bold uppercase tracking-wider mb-2">Kamar Tidur</span>
                        <span class="text-2xl font-black text-secondary">{{ $house->bedrooms }}</span>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-center">
                        <span class="block text-slate-400 text-sm font-bold uppercase tracking-wider mb-2">Kamar Mandi</span>
                        <span class="text-2xl font-black text-secondary">{{ $house->bathrooms }}</span>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-center">
                        <span class="block text-slate-400 text-sm font-bold uppercase tracking-wider mb-2">Listrik</span>
                        <span class="text-2xl font-black text-secondary">1300W</span>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-center">
                        <span class="block text-slate-400 text-sm font-bold uppercase tracking-wider mb-2">Sumber Air</span>
                        <span class="text-xl font-black text-secondary">PDAM / Sumur</span>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 mb-10">
                    <h4 class="text-xl font-black text-secondary mb-4">Deskripsi Properti</h4>
                    <p class="text-slate-600 leading-relaxed text-lg">{{ $house->description }}</p>
                </div>
                
                @if($house->features && is_array($house->features))
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                    <h4 class="text-xl font-black text-secondary mb-6">Keunggulan Rumah</h4>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($house->features as $feature)
                        <li class="flex items-center gap-3 text-slate-700">
                            <div class="w-6 h-6 rounded-full bg-primary/20 text-primary flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="font-medium">{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            
            <!-- Col 2: Denah -->
            <div>
                <h3 class="text-3xl font-black text-secondary mb-8">Denah Rumah</h3>
                <div class="bg-white p-4 rounded-3xl shadow-sm border border-slate-100 cursor-zoom-in group" @click="isModalOpen = true">
                    <div class="relative overflow-hidden rounded-2xl bg-white border border-slate-100 pb-[100%] w-full h-0">
                        <img src="{{ $house->floor_plan_image ? Storage::url($house->floor_plan_image) : asset('images/desain denah & yang lain/denah.png') }}" class="absolute inset-0 w-full h-full object-contain p-4 group-hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-secondary/10 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <div class="bg-white p-3 rounded-full shadow-xl">
                                <svg class="w-6 h-6 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                            </div>
                        </div>
                    </div>
                    <p class="text-center text-slate-500 text-sm mt-4 font-bold">Klik gambar untuk memperbesar</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Alpine Modal -->
    <div x-show="isModalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center px-4" x-transition.opacity>
        <div class="fixed inset-0 bg-secondary/95 backdrop-blur-sm" @click="isModalOpen = false"></div>
        <div class="relative z-10 max-w-4xl w-full bg-white rounded-3xl overflow-hidden shadow-2xl p-2" x-transition.scale>
            <button @click="isModalOpen = false" class="absolute top-4 right-4 w-10 h-10 bg-slate-100 text-secondary rounded-full flex items-center justify-center hover:bg-red-500 hover:text-white transition shadow-sm z-20">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <img src="{{ $house->floor_plan_image ? Storage::url($house->floor_plan_image) : asset('images/desain denah & yang lain/denah.png') }}" class="w-full max-h-[90vh] object-contain rounded-2xl shadow-xl bg-white">
        </div>
    </div>
</div>

<!-- 4. Simulasi KPR Otomatis -->
<div class="py-24 bg-[#F8FAFC] border-t border-slate-200" x-data="kprCalculator({{ $house->price ?: 350000000 }})">
    <div class="max-w-5xl mx-auto px-4 xl:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-black text-secondary mb-4">Simulasi KPR Pintar</h2>
            <p class="text-slate-500">Atur uang muka dan tenor sesuka Anda untuk mengetahui estimasi cicilan per bulan.</p>
        </div>
        
        <div class="bg-white rounded-3xl p-8 md:p-12 shadow-2xl grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="space-y-8">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Harga Properti</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-slate-400">Rp</span>
                        <input type="text" disabled x-model="formattedPrice" class="w-full pl-12 pr-4 py-4 rounded-xl bg-slate-50 border border-slate-200 text-secondary font-black text-lg outline-none">
                    </div>
                </div>
                <div>
                    <div class="flex justify-between mb-2">
                        <label class="text-sm font-bold text-slate-700">Uang Muka (DP)</label>
                        <span class="font-bold text-primary" x-text="dpPercent + '%'"></span>
                    </div>
                    <input type="range" x-model="dpPercent" min="0" max="50" step="5" class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-primary mb-2">
                    <div class="text-right font-black text-secondary">Rp <span x-text="formatCurrency(calculateDpAmount())"></span></div>
                </div>
                <div>
                    <div class="flex justify-between mb-2">
                        <label class="text-sm font-bold text-slate-700">Tenor Waktu (Tahun)</label>
                        <span class="font-bold text-primary" x-text="tenor + ' Tahun'"></span>
                    </div>
                    <input type="range" x-model="tenor" min="5" max="30" step="5" class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-primary mb-2">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Estimasi Bunga per Tahun (%)</label>
                    <input type="number" x-model="bunga" min="1" max="15" step="0.1" class="w-full px-4 py-4 rounded-xl bg-white border border-slate-200 text-secondary font-bold outline-none focus:border-primary">
                </div>
            </div>
            
            <div class="bg-light p-8 rounded-3xl border border-slate-200 text-center h-full flex flex-col justify-center">
                <span class="text-slate-500 font-bold uppercase tracking-wider text-sm mb-4 block">Estimasi Cicilan Bulanan</span>
                <div class="text-4xl md:text-5xl font-black text-primary mb-2">
                    Rp <span x-text="formatCurrency(calculateCicilan())"></span>
                </div>
                <span class="text-slate-400 block mb-8">/ bulan</span>
                <p class="text-xs text-slate-500 mb-8 px-4">
                    *Kalkulasi ini hanya sekadar simulasi dan estimasi kasar. Nilai sebenarnya bervariasi bergantung nilai suku bunga bank bersangkutan saat ini.
                </p>
                <a href="https://wa.me/62{{ ltrim($settings['contact_phone'] ?? '85947418388', '0') }}?text=Halo%20saya%20tertarik%20dengan%20Tipe%20{{ urlencode($house->name) }}%20dan%20ingin%20info%20KPR" target="_blank" class="w-full py-4 bg-accent text-secondary font-black rounded-xl hover:bg-yellow-400 transition shadow-lg shadow-yellow-500/20 text-lg uppercase tracking-wider block">
                    Ajukan KPR Sekarang
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Alpine Logic -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('kprCalculator', (initialHarga) => ({
            harga: initialHarga,
            dpPercent: 10,
            tenor: 15,
            bunga: 5.5,
            
            get formattedPrice() {
                return new Intl.NumberFormat('id-ID').format(this.harga);
            },
            
            formatCurrency(value) {
                return new Intl.NumberFormat('id-ID').format(Math.round(value));
            },
            
            calculateDpAmount() {
                return (this.harga * this.dpPercent) / 100;
            },
            
            calculateCicilan() {
                let p = this.harga - this.calculateDpAmount();
                let r = (this.bunga / 100) / 12;
                let n = this.tenor * 12;
                
                if (r === 0) return p / n;
                
                let cicilan = p * (r * Math.pow(1 + r, n)) / (Math.pow(1 + r, n) - 1);
                return cicilan > 0 && isFinite(cicilan) ? cicilan : 0;
            }
        }))
    })
</script>

@endsection
