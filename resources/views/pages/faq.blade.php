@extends('components.layout')
@section('title', 'Pusat Bantuan (FAQ) - Graha Land Serang')

@section('content')
<div class="bg-secondary pt-32 pb-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=2070')] opacity-10 bg-cover bg-center"></div>
<div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-primary/20 blur-[100px] rounded-full translate-x-1/2 -translate-y-1/2"></div>
    <div class="max-w-7xl mx-auto px-4 xl:px-8 relative z-10">
        <div class="flex flex-wrap items-center text-sm font-bold text-slate-400 mb-10 space-x-2">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <span class="text-primary">FAQ</span>
        </div>
        <div class="mb-5">
            <span class="bg-primary/20 border border-primary text-primary font-bold text-xs md:text-sm px-4 py-1.5 rounded-full uppercase tracking-wider">Layanan Pelanggan</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-white mb-6">Pusat Bantuan (FAQ)</h1>
        <p class="text-lg text-slate-300 max-w-2xl leading-relaxed">
            Jawaban cepat untuk pertanyaan yang sering diajukan mengenai proyek dan sistem pembayaran kami.
        </p>
    </div>
</div>

<div class="py-24 bg-white" x-data="{ activeAccordion: null }">
    <div class="max-w-3xl mx-auto px-4">
        <div class="space-y-4">
            @forelse($faqs as $faq)
            <div class="border border-slate-200 rounded-2xl overflow-hidden">
                <button @click="activeAccordion = activeAccordion === {{ $faq->id }} ? null : {{ $faq->id }}" class="w-full px-6 py-4 text-left flex justify-between items-center bg-slate-50 hover:bg-slate-100 transition focus:outline-none">
                    <span class="font-bold text-secondary">{{ $faq->question }}</span>
                    <svg class="w-5 h-5 text-slate-500 transform transition-transform" :class="{'rotate-180': activeAccordion === {{ $faq->id }}}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="activeAccordion === {{ $faq->id }}" x-collapse class="bg-white">
                    <div class="p-6 text-slate-600 leading-relaxed border-t border-slate-100">
                        {!! nl2br(e($faq->answer)) !!}
                    </div>
                </div>
            </div>
            @empty
            <div class="py-12 text-center text-slate-500">
                Belum ada data FAQ yang ditambahkan.
            </div>
            @endforelse
        </div>
        
        <div class="mt-16 text-center">
            <p class="text-slate-500 mb-4">Masih memiliki pertanyaan?</p>
            <a href="https://wa.me/62{{ ltrim($settings['contact_phone'] ?? '85947418388', '0') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-accent text-secondary font-bold rounded-xl hover:bg-yellow-400 transition shadow-lg shadow-yellow-500/20">
                Tanyakan pada Marketing
            </a>
        </div>
    </div>
</div>
<!-- Import Alpine Collapse Plugin -->
<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
