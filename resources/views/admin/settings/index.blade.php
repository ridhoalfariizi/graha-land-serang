@extends('admin.layouts.app')
@section('title', 'Cendekia Settings & System Setup')
@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-3xl font-black text-slate-800">Pengaturan Website</h2>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 text-green-700 font-bold rounded-xl border border-green-200">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Media Latar Beranda -->
            <div class="col-span-1 lg:col-span-2 bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                <h3 class="text-xl font-bold text-slate-800 border-b pb-4 mb-6">Media Latar Beranda (Hero Section)</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Video Pengantar (opsional)</label>
                        @if(isset($settings['hero_video']) && $settings['hero_video'])
                            <video src="{{ Storage::url($settings['hero_video']) }}" class="w-full h-32 object-cover rounded-lg mb-3" muted controls></video>
                        @endif
                        <input type="file" name="hero_video" accept="video/mp4,video/webm" class="w-full text-sm">
                        <p class="text-[10px] text-slate-500 mt-1">Format: mp4, maks 10MB</p>
                    </div>

                    @for($i = 1; $i <= 4; $i++)
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Gambar Slider {{ $i }}</label>
                        @if(isset($settings['hero_image_'.$i]) && $settings['hero_image_'.$i])
                            <img src="{{ Storage::url($settings['hero_image_'.$i]) }}" class="w-full h-32 object-cover rounded-lg mb-3">
                        @endif
                        <input type="file" name="hero_image_{{ $i }}" accept="image/*" class="w-full text-sm">
                        <p class="text-[10px] text-slate-500 mt-1">Format: jpg/png/webp</p>
                    </div>
                    @endfor
                </div>
                <p class="text-sm text-amber-600 mt-4 font-medium"><i class="fas fa-info-circle mr-1"></i> Biarkan kosong jika tidak ingin mengubah media yang sudah ada.</p>
            </div>

            <!-- Informasi Umum -->
            <div class="space-y-8">
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-bold text-slate-800 border-b pb-4 mb-6">Informasi Umum Properti</h3>
                    
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Properti / Perumahan</label>
                            <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'Graha Land Serang' }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nomor WhatsApp Utama</label>
                            <input type="text" name="whatsapp_number" value="{{ $settings['whatsapp_number'] ?? '6281234567890' }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary outline-none">
                            <p class="text-[10px] text-slate-500 mt-1">Gunakan format 628... tanpa 0 atau +</p>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Pesan WhatsApp Default</label>
                            <textarea name="whatsapp_text" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary outline-none">{{ $settings['whatsapp_text'] ?? 'Halo, saya tertarik dengan Graha Land Serang.' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Lengkap Perumahan</label>
                            <textarea name="company_address" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary outline-none">{{ $settings['company_address'] ?? 'Jl. Raya Graha Land, Serang, Banten' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Mode Maintenance -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-red-500/10 rounded-bl-full"></div>
                    <h3 class="text-xl font-bold text-slate-800 border-b pb-4 mb-6">Sistem & Keamanan</h3>
                    
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200">
                        <div class="flex items-center justify-between mb-2">
                            <div>
                                <h4 class="font-bold text-slate-800">Mode Maintenance (Perbaikan Server)</h4>
                                <p class="text-xs text-slate-500 mt-1">Mengaktifkan mode ini akan menyembunyikan website utama dari publik.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="maintenance_mode" value="0">
                                <input type="checkbox" name="maintenance_mode" value="1" {{ ($settings['maintenance_mode'] ?? '0') == '1' ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-14 h-7 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-red-500"></div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <!-- SEO & Analytics -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-bold text-slate-800 border-b pb-4 mb-6">SEO Global & Analytics</h3>
                    
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">SEO Global Meta Title</label>
                            <input type="text" name="seo_title" value="{{ $settings['seo_title'] ?? 'Graha Land Serang - Perumahan Mewah Harga Terjangkau' }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">SEO Global Meta Description</label>
                            <textarea name="seo_description" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary outline-none">{{ $settings['seo_description'] ?? 'Temukan hunian ideal Anda di Graha Land Serang.' }}</textarea>
                        </div>
                        <div class="pt-4 border-t border-slate-100">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Google Analytics Tracking ID / GTM (Contoh: G-XXXXXXX)</label>
                            <input type="text" name="ga_tracking_id" value="{{ $settings['ga_tracking_id'] ?? '' }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary outline-none font-mono text-sm bg-slate-50">
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-bold text-slate-800 border-b pb-4 mb-6">Tautan Sosial Media</h3>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-pink-100 text-pink-600 rounded-l-xl flex items-center justify-center font-bold text-xl border border-r-0 border-slate-200"><i class="fab fa-instagram"></i></div>
                            <input type="url" name="social_instagram" value="{{ $settings['social_instagram'] ?? '' }}" placeholder="https://instagram.com/..." class="flex-1 px-4 py-3 rounded-r-xl border border-slate-200 focus:border-primary outline-none">
                        </div>
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-l-xl flex items-center justify-center font-bold text-xl border border-r-0 border-slate-200"><i class="fab fa-facebook"></i></div>
                            <input type="url" name="social_facebook" value="{{ $settings['social_facebook'] ?? '' }}" placeholder="https://facebook.com/..." class="flex-1 px-4 py-3 rounded-r-xl border border-slate-200 focus:border-primary outline-none">
                        </div>
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-red-100 text-red-600 rounded-l-xl flex items-center justify-center font-bold text-xl border border-r-0 border-slate-200"><i class="fab fa-youtube"></i></div>
                            <input type="url" name="social_youtube" value="{{ $settings['social_youtube'] ?? '' }}" placeholder="https://youtube.com/..." class="flex-1 px-4 py-3 rounded-r-xl border border-slate-200 focus:border-primary outline-none">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white py-4 rounded-2xl font-black text-lg shadow-xl shadow-green-500/30 transition-all">
                    Simpan Semua Pengaturan
                </button>
            </div>
        </div>
    </form>

    <!-- Profil Admin -->
    <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 mt-8">
        <h3 class="text-xl font-bold text-slate-800 border-b pb-4 mb-6">Profil & Keamanan Akun Admin</h3>
        
        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf @method('PUT')
            
            @if ($errors->any())
                <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Email Login</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Password Baru (Opsional)</label>
                    <input type="password" name="password" placeholder="Kosongkan jika tidak ingin ganti" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary outline-none">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password baru" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary outline-none">
                </div>
            </div>
            <div class="mt-6 text-right">
                <button type="submit" class="bg-primary hover:bg-primary-hover text-white px-8 py-3 rounded-2xl font-bold shadow-lg shadow-green-500/30 transition-all">
                    Perbarui Profil Akun
                </button>
            </div>
        </form>
    </div>
</div>
@endsection