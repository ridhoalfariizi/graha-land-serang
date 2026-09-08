<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta SEO -->
        <title>@yield('title', $settings['seo_title'] ?? 'Graha Land Serang')</title>
    <meta name="description" content="@yield('meta_description', $settings['seo_description'] ?? 'Sistem Perumahan Mewah Graha Land Serang')">
    <meta name="keywords" content="@yield('meta_keywords', 'perumahan serang, rumah murah banten, graha land')">
    <!-- Open Graph (WhatsApp, Facebook) -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', $settings['seo_title'] ?? 'Graha Land Serang')">
    <meta property="og:description" content="@yield('meta_description', $settings['seo_description'] ?? 'Sistem Perumahan Mewah Graha Land Serang')">
    <meta property="og:image" content="@yield('og_image', asset('images/desain rumah/gambar 1.jpeg'))">
    <meta property="og:image:type" content="image/jpeg">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('title', $settings['seo_title'] ?? 'Graha Land Serang')">
    <meta name="twitter:description" content="@yield('meta_description', $settings['seo_description'] ?? 'Sistem Perumahan Mewah Graha Land Serang')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/desain rumah/gambar 1.jpeg'))">
    
    <!-- GTM Analytics Dummy -->
    @if(isset($settings['ga_tracking_id']) && $settings['ga_tracking_id'])
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings['ga_tracking_id'] }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ $settings['ga_tracking_id'] }}');
    </script>
    @endif
    <meta name="description" content="@yield('meta_description', $settings['hero_subtitle'] ?? 'Hunian Modern di Kota Serang')">
    @yield('meta_opengraph')
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-nav { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255, 255, 255, 0.3); }
        .hero-gradient { background: linear-gradient(0deg, rgba(15,23,42,0.95) 0%, rgba(15,23,42,0.6) 50%, rgba(15,23,42,0.4) 100%); }
    </style>
</head>
<body class="bg-[#F8FAFC] text-secondary antialiased overflow-x-hidden selection:bg-primary selection:text-white" x-data="{ mobileMenuOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 50)">

    <!-- Navigation -->
    <nav :class="{'glass-nav shadow-sm': scrolled, 'bg-transparent': !scrolled}" class="fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 xl:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-2">
                    <img src="{{ asset('images/logo/logo graha land serang.webp') }}" alt="Graha Land Logo" :class="scrolled ? '' : 'brightness-0 invert'" class="h-10 md:h-12 w-auto object-contain drop-shadow-md transition-all duration-300">
                </a>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-8">
                    @php
                        $menus = [
                            'home' => 'Home',
                            'about' => 'Tentang Kami',
                            'house-types' => 'Tipe Rumah',
                            'facilities' => 'Fasilitas',
                            'location' => 'Lokasi',
                            'galleries' => 'Galeri',
                            'articles' => 'Artikel',
                            'faq' => 'FAQ',
                        ];
                    @endphp
                    
                    @foreach($menus as $route => $name)
                    <a href="{{ route($route) }}" 
                       :class="scrolled ? ('{{ request()->routeIs($route) }}' ? 'font-bold text-primary' : 'text-slate-600 hover:text-primary') : ('{{ request()->routeIs($route) }}' ? 'font-bold text-white' : 'text-white/80 hover:text-white')" 
                       class="text-[15px] font-semibold transition-colors duration-200">
                        {{ $name }}
                    </a>
                    @endforeach
                    
                    <a href="{{ route('contact') }}" class="px-6 py-2.5 bg-accent text-secondary font-bold rounded-full hover:bg-yellow-400 hover:-translate-y-0.5 transition-all shadow-lg shadow-yellow-500/20 text-sm">
                        Hubungi Kami
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="lg:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" :class="scrolled ? 'text-secondary' : 'text-white'" class="p-2 transition-colors">
                        <svg class="h-6 w-6" x-show="!mobileMenuOpen" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                        <svg class="h-6 w-6" x-show="mobileMenuOpen" style="display: none;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="lg:hidden absolute top-20 left-0 w-full bg-white shadow-xl border-t border-slate-100 z-40" style="display: none;">
            <div class="px-4 pt-2 pb-6 space-y-1">
                @foreach($menus as $route => $name)
                <a href="{{ route($route) }}" class="block px-3 py-3 rounded-lg text-base font-semibold text-slate-700 hover:bg-slate-50 hover:text-primary">
                    {{ $name }}
                </a>
                @endforeach
                <a href="{{ route('contact') }}" class="block w-full text-center mt-4 px-3 py-3 bg-primary text-white font-bold rounded-xl shadow-md">
                    Hubungi Marketing
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <footer class="bg-secondary relative overflow-hidden pt-24 pb-8 border-t-4 border-primary">
        <!-- Abstract Background Glows -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] bg-primary/20 blur-[120px] rounded-full mix-blend-screen"></div>
            <div class="absolute -bottom-[20%] -right-[10%] w-[40%] h-[50%] bg-green-500/10 blur-[100px] rounded-full mix-blend-screen"></div>
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 xl:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 mb-20">
                <!-- Col 1: Brand, About & Social Media -->
                <div>
                    <a href="{{ route('home') }}" class="inline-block mb-6 group">
                        <div class="bg-white/95 p-3 px-6 rounded-2xl drop-shadow-lg group-hover:scale-105 transition-transform duration-300 inline-flex">
                            <img src="{{ asset('images/logo/logo graha land serang.webp') }}" alt="Graha Land Logo" class="h-10 md:h-12 w-auto object-contain">
                        </div>
                    </a>
                    <p class="text-white/80 leading-relaxed text-[14px] mb-8 font-medium">
                        Menghadirkan kawasan hunian asri Mewah dan Modern di Kota Serang. Terpadu dengan fasilitas lengkap dan keamanan <i>One Gate System</i>.
                    </p>
                    <div class="flex items-center gap-3">
                        <!-- Facebook -->
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white hover:text-primary border border-white/20 flex items-center justify-center text-white transition-all duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/></svg>
                        </a>
                        <!-- Instagram -->
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white hover:text-primary border border-white/20 flex items-center justify-center text-white transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <!-- TikTok -->
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white hover:text-primary border border-white/20 flex items-center justify-center text-white transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.04.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93v7.26c0 1.94-.48 3.86-1.57 5.4-2.48 3.51-7.66 4.31-11.16 1.73-3.62-2.67-4.14-8.08-1.12-11.39 1.79-1.95 4.54-2.73 7.08-1.98v4.21c-1.07-.3-2.28-.15-3.2.4-1.1.66-1.66 1.96-1.39 3.2.32 1.44 1.61 2.5 3.09 2.55 1.5.06 2.92-.81 3.49-2.19.26-.64.35-1.34.35-2.03V0h3.922z"/></svg>
                        </a>
                    </div>
                </div>
                
                <!-- Col 2: Navigation -->
                <div class="lg:pl-8">
                    <h3 class="text-white font-black mb-8 uppercase tracking-widest text-sm flex items-center gap-2">
                        Tautan Cepat
                    </h3>
                    <ul class="space-y-4 text-[14px] font-bold">
                        @php
                            $footerNav = [
                                'about' => 'Tentang Perumahan',
                                'house-types' => 'Pilihan Tipe Rumah',
                                'facilities' => 'Fasilitas Kawasan',
                                'location' => 'Peta Lokasi Terpusat',
                                'galleries' => 'Galeri Proyek',
                                'faq' => 'Pusat Bantuan (FAQ)'
                            ];
                        @endphp
                        @foreach($footerNav as $route => $name)
                        <li>
                            <a href="{{ route($route) }}" class="text-white/80 hover:text-white hover:translate-x-2 transition-all duration-300 flex items-center gap-3 group">
                                <span class="text-primary group-hover:text-white transition-colors">&rsaquo;</span>
                                {{ $name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                <!-- Col 3: Contact Info -->
                <div>
                    <h3 class="text-white font-black mb-8 uppercase tracking-widest text-sm">Pusat Informasi</h3>
                    <ul class="space-y-6 text-[14px] font-medium">
                        <li class="flex gap-4 group">
                            <div class="w-8 h-8 rounded-full bg-white/20 border border-white/10 flex items-center justify-center text-white group-hover:bg-white group-hover:text-primary transition-colors duration-300 shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <span class="text-white/80 pt-1 group-hover:text-white transition-colors leading-relaxed">{{ $settings['contact_address'] ?? 'Pengampelan, Walantaka, Kota Serang, Banten' }}</span>
                        </li>
                        <li class="flex gap-4 group">
                            <div class="w-8 h-8 rounded-full bg-white/20 border border-white/10 flex items-center justify-center text-white group-hover:bg-white group-hover:text-primary transition-colors duration-300 shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <span class="text-white/90 font-bold pt-1.5 group-hover:text-white transition-colors">{{ $settings['contact_phone'] ?? '0859 4741 8388' }}</span>
                        </li>
                        <li class="flex gap-4 group">
                            <div class="w-8 h-8 rounded-full bg-white/20 border border-white/10 flex items-center justify-center text-white group-hover:bg-white group-hover:text-primary transition-colors duration-300 shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <span class="text-white/80 pt-1.5 group-hover:text-white transition-colors">{{ $settings['contact_email'] ?? 'ptbanaciptagraha@gmail.com' }}</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Col 4: Developers & CTA -->
                <div>
                    <h3 class="text-lg font-bold text-white mb-6 uppercase tracking-wider">Dikembangkan Oleh</h3>
                    <div class="flex flex-wrap items-center gap-4 sm:gap-6 bg-white/5 rounded-2xl p-4 border border-white/10 w-fit">
                        <img src="{{ asset('images/logo/logo pt bana cipta graha.webp') }}" alt="PT Bana Cipta Graha" class="h-10 sm:h-12 w-auto object-contain drop-shadow brightness-0 invert opacity-90 transition-opacity hover:opacity-100">
                        <div class="h-8 w-px bg-white/20 hidden sm:block"></div>
                        <img src="{{ asset('images/logo/logo bumi tata nusantaraa.webp') }}" alt="PT Bumi Tata Nusantara" class="h-8 sm:h-10 w-auto object-contain drop-shadow brightness-0 invert opacity-90 transition-opacity hover:opacity-100">
                        <div class="h-8 w-px bg-white/20 hidden sm:block"></div>
                        <img src="{{ asset('images/logo/logo graha land.webp') }}" alt="Graha Land" class="h-8 sm:h-10 w-auto object-contain drop-shadow brightness-0 invert opacity-90 transition-opacity hover:opacity-100">
                    </div>
                    
                    <a href="https://wa.me/62{{ ltrim($settings['contact_phone'] ?? '85947418388', '0') }}?text=Halo%20Admin%20Graha%20Land,%20saya%20ingin%20info%20lebih%20lanjut" target="_blank" class="w-full py-4 text-center bg-[#25D366] text-white rounded-xl font-bold uppercase tracking-widest text-[13px] hover:bg-white hover:text-[#128C7E] transition-colors duration-300 shadow-xl shadow-[#25D366]/20 block mt-8">
                        Hubungi WhatsApp
                    </a>
                </div>
            </div>
            
            <div class="mt-8 pt-8 border-t border-white/10 flex justify-center items-center">
                <p class="text-sm text-white/60 font-medium text-center">
                    &copy; {{ date('Y') }} Graha Land Serang. Hak Cipta Dilindungi.
                </p>
            </div>
        </div>
    </footer>
    
    <!-- Floating WA Widget -->
    <div class="fixed bottom-6 right-6 z-[100] flex flex-col items-end gap-3 drop-shadow-2xl" x-data="{ showBubble: false }" @mouseenter="showBubble = true" @mouseleave="showBubble = false">
        <!-- Speech Bubble -->
        <div x-show="showBubble" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-2 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-2 scale-95"
             class="relative bg-white rounded-2xl shadow-xl p-4 border border-slate-100 flex items-center gap-3 origin-hover" style="display: none;">
            <div class="w-10 h-10 bg-green-50 text-[#25D366] rounded-full flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
            </div>
            <div>
                <p class="text-[10px] font-black tracking-widest uppercase text-slate-400 mb-0.5">Online Sekarang</p>
                <p class="text-[15px] font-bold text-slate-700">Ada yang bisa bantu?</p>
            </div>
            <!-- Bubble Tail -->
            <div class="absolute -bottom-2 right-8 w-4 h-4 bg-white border-b border-r border-slate-100 transform rotate-45"></div>
        </div>
        
        <!-- WA Button Pill -->
        <a href="https://wa.me/62{{ ltrim($settings['contact_phone'] ?? '85947418388', '0') }}?text=Halo%20Admin%20Graha%20Land,%20saya%20ingin%20info%20lebih%20lanjut" target="_blank" class="bg-[#25D366] hover:bg-[#128C7E] text-white rounded-full p-2 md:p-1.5 md:pr-6 shadow-xl shadow-[#25D366]/40 hover:scale-[1.03] transition-transform duration-300 flex items-center justify-center gap-0 md:gap-3 w-max">
            <div class="bg-white/20 text-white w-14 h-14 md:w-12 md:h-12 rounded-full flex items-center justify-center shrink-0 relative">
                <svg class="w-8 h-8 md:w-7 md:h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.298-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                <div class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-red-500 rounded-full border-2 border-white animate-pulse hidden md:block"></div>
            </div>
            <div class="hidden md:flex flex-col justify-center pr-3">
                <p class="text-[10px] uppercase font-bold tracking-wider text-white/90 leading-none mb-0.5">Langsung</p>
                <p class="text-base font-black leading-none">Hubungi WhatsApp</p>
            </div>
        </a>
    </div>

    <!-- Studio Freight Lenis (Smooth Scrolling) -->
    <script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@1.0.27/bundled/lenis.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const lenis = new Lenis({
                duration: 1.2,
                easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), 
                direction: 'vertical', 
                gestureDirection: 'vertical',
                smooth: true,
                mouseMultiplier: 1,
                smoothTouch: false,
                touchMultiplier: 2,
                infinite: false,
            });

            // Prevent smooth scroll on scrollbar drag
            lenis.on('scroll', (e) => {
                Alpine.store('scrolled', window.scrollY > 50);
            });

            function raf(time) {
                lenis.raf(time);
                requestAnimationFrame(raf);
            }

            requestAnimationFrame(raf);
        });
    </script>

</body>
</html>
