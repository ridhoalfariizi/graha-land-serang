@extends('components.layout')
@section('title', 'Hubungi Kami - Graha Land Serang')

@section('content')
<div class="bg-secondary pt-32 pb-48 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=2070')] opacity-10 bg-cover bg-center"></div>
<div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-primary/20 blur-[100px] rounded-full translate-x-1/2 -translate-y-1/2"></div>
    <div class="max-w-7xl mx-auto px-4 xl:px-8 relative z-10 text-left text-white">
        <div class="flex flex-wrap items-center text-sm font-bold text-slate-400 mb-10 space-x-2">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <span class="text-primary">Kontak</span>
        </div>
        
        <div class="mb-5">
            <span class="bg-primary/20 border border-primary text-primary font-bold text-xs md:text-sm px-4 py-1.5 rounded-full uppercase tracking-wider">Layanan Pelanggan</span>
        </div>
        <h1 class="text-4xl md:text-5xl lg:text-7xl font-black mb-4 tracking-tight drop-shadow-md">Hubungi Kami</h1>
        <p class="text-slate-400 text-base md:text-lg max-w-2xl">
            Tim marketing profesional kami selalu sedia mendampingi Anda memiliki hunian idaman. Hubungi kami kapan saja.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 xl:px-8 -mt-24 relative z-10 mb-24">
    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 md:p-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <div>
                <h3 class="text-2xl font-black text-secondary mb-6">Kirim Pesan Kepada Kami</h3>
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-start gap-3">
                        <svg class="w-6 h-6 text-green-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="font-medium text-sm leading-relaxed">{{ session('success') }}</span>
                    </div>
                @endif
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-green-600 bg-slate-50 focus:bg-white" placeholder="Masukkan nama...">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nomor HP/WhatsApp</label>
                        <input type="text" name="phone" required class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-green-600 bg-slate-50 focus:bg-white" placeholder="Contoh: 08123456789">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Pesan Tambahan</label>
                        <textarea name="message" rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-green-600 bg-slate-50 focus:bg-white" placeholder="Tanyakan seputar harga atau ketersediaan unit..."></textarea>
                    </div>
                    <button type="submit" class="w-full py-4 bg-primary text-white font-bold rounded-xl hover:bg-green-800 transition shadow-lg shadow-green-700/30">
                        Kirim Formulir
                    </button>
                    <p class="text-xs text-slate-400 text-center mt-4">Atau hubungi kami langsung via WhatsApp untuk respon cepat.</p>
                </form>
            </div>
            
            <div class="bg-secondary p-10 md:p-12 rounded-3xl relative overflow-hidden shadow-2xl shadow-secondary/40 text-white flex flex-col">
                <!-- Decorative Background -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-primary/20 blur-[80px] rounded-full translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/20 blur-[80px] rounded-full -translate-x-1/2 translate-y-1/2"></div>
                
                <div class="relative z-10 flex-1">
                    <h3 class="text-3xl font-black mb-2 tracking-tight">Informasi Kontak</h3>
                    <p class="text-slate-400 mb-10">Kenyamanan Anda adalah prioritas kami. Jangan ragu untuk menghubungi kami melalui telepon atau pesan WhatsApp.</p>
                    
                    <ul class="space-y-8">
                        <li class="flex items-start gap-5">
                            <div class="w-14 h-14 bg-white/10 rounded-2xl border border-white/20 backdrop-blur-sm flex items-center justify-center shrink-0">
                                <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <span class="block text-sm font-semibold text-slate-400 uppercase tracking-widest mb-1">Alamat Kantor</span>
                                <span class="text-lg font-bold leading-snug block">{{ $settings['contact_address'] ?? 'Pengampelan, Serang' }}</span>
                            </div>
                        </li>
                        <li class="flex items-start gap-5">
                            <div class="w-14 h-14 bg-white/10 rounded-2xl border border-white/20 backdrop-blur-sm flex items-center justify-center shrink-0">
                                <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <span class="block text-sm font-semibold text-slate-400 uppercase tracking-widest mb-1">Telepon / WhatsApp</span>
                                <span class="text-xl font-bold">{{ $settings['contact_phone'] ?? '085947418388' }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <div class="mt-12 relative z-10">
                    <a href="https://wa.me/62{{ ltrim($settings['contact_phone'] ?? '85947418388', '0') }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-3 w-full py-4 bg-[#25D366] text-white font-bold rounded-2xl shadow-[0_8px_30px_rgb(37,211,102,0.3)] hover:scale-[1.02] hover:-translate-y-1 transition duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163...z"/></svg>
                        Hubungi via WhatsApp
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
