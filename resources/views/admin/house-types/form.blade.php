@extends('admin.layouts.app')
@section('title', isset($house) ? 'Edit Tipe Rumah' : 'Tambah Tipe Rumah')
@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-slate-800">{{ isset($house) ? 'Edit Tipe Rumah' : 'Tambah Tipe Rumah Baru' }}</h2>
        <a href="{{ route('admin.house-types.index') }}" class="text-slate-500 hover:text-slate-700 font-bold">← Kembali</a>
    </div>

    <form action="{{ isset($house) ? route('admin.house-types.update', $house->id) : route('admin.house-types.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($house)) @method('PUT') @endif
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kolom Kiri: Informasi Utama -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Info Dasar -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 border-b pb-3 mb-4">Informasi Dasar</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Tipe Rumah</label>
                            <input type="text" name="name" value="{{ old('name', $house->name ?? '') }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary bg-slate-50 focus:bg-white transition-all">
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Harga (Rp)</label>
                                <input type="hidden" id="priceInput" name="price" value="{{ old('price', $house->price ?? '') }}">
                                <input type="text" id="priceDisplay" value="{{ old('price', $house->price ?? '') }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary bg-slate-50 focus:bg-white transition-all">
                                <div id="priceText" class="text-xs font-bold text-emerald-600 mt-1.5 h-4"></div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Status</label>
                                <select name="status" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary bg-slate-50 focus:bg-white transition-all">
                                    <option value="Available" {{ old('status', $house->status ?? '') == 'Available' ? 'selected' : '' }}>Available</option>
                                    <option value="Booking" {{ old('status', $house->status ?? '') == 'Booking' ? 'selected' : '' }}>Booking</option>
                                    <option value="Sold Out" {{ old('status', $house->status ?? '') == 'Sold Out' ? 'selected' : '' }}>Sold Out</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Lengkap</label>
                            <textarea name="description" required rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary bg-slate-50 focus:bg-white transition-all">{{ old('description', $house->description ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Spesifikasi -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 border-b pb-3 mb-4">Spesifikasi Bangunan</h3>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-1">Luas Bangunan (m²)</label>
                            <input type="number" name="building_size" value="{{ old('building_size', $house->building_size ?? '') }}" required class="w-full px-4 py-2 rounded-lg border border-slate-200 outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-1">Luas Tanah (m²)</label>
                            <input type="number" name="land_size" value="{{ old('land_size', $house->land_size ?? '') }}" required class="w-full px-4 py-2 rounded-lg border border-slate-200 outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-1">Kamar Tidur</label>
                            <input type="number" name="bedrooms" value="{{ old('bedrooms', $house->bedrooms ?? '') }}" required class="w-full px-4 py-2 rounded-lg border border-slate-200 outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-1">Kamar Mandi</label>
                            <input type="number" name="bathrooms" value="{{ old('bathrooms', $house->bathrooms ?? '') }}" required class="w-full px-4 py-2 rounded-lg border border-slate-200 outline-none focus:border-primary">
                        </div>
                    </div>
                    
                    <label class="block text-sm font-bold text-slate-700 mb-2">Daftar Fitur Unggulan (Ceklis yang sesuai)</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @php 
                            $allFeatures = ['Carport', 'Taman Depan', 'Taman Belakang', 'Ruang Keluarga', 'Dapur', 'Balkon', 'Smart Home', 'Keamanan 24 Jam']; 
                            $savedFeatures = old('features', isset($house) ? ($house->features ?? []) : []);
                        @endphp
                        @foreach($allFeatures as $feat)
                        <label class="flex items-center space-x-2 cursor-pointer p-2 rounded-lg hover:bg-slate-50 border border-transparent hover:border-slate-200 transition">
                            <input type="checkbox" name="features[]" value="{{ $feat }}" {{ in_array($feat, $savedFeatures) ? 'checked' : '' }} class="w-4 h-4 text-primary rounded focus:ring-primary border-slate-300">
                            <span class="text-sm font-medium text-slate-700">{{ $feat }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Media & SEO -->
            <div class="space-y-6">
                <!-- Media Uploads -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 border-b pb-3 mb-4">Media Gambar</h3>
                    
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Foto Galeri Rumah (Bisa pilih multi-foto)</label>
                        <input type="file" name="images[]" multiple accept="image/*" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-primary hover:file:bg-green-100">
                        @if(isset($house) && $house->images)
                            <p class="text-xs text-green-600 mt-2 font-medium">✓ Telah diupload {{ count($house->images) }} gambar. (Upload baru akan mereplace lama)</p>
                        @endif
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Denah Rumah (Floorplan)</label>
                        <input type="file" name="floor_plan_image" accept="image/*" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-primary hover:file:bg-green-100">
                        @if(isset($house) && $house->floor_plan_image)
                            <img src="{{ Storage::url($house->floor_plan_image) }}" class="mt-3 aspect-video object-cover rounded-xl border">
                        @endif
                    </div>
                </div>

                <!-- SEO Metadata -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 border-b pb-3 mb-4">SEO Metadata</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2">Meta Title</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title', $house->meta_title ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-slate-200 outline-none focus:border-primary text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2">Meta Description</label>
                            <textarea name="meta_description" rows="3" class="w-full px-4 py-2 rounded-lg border border-slate-200 outline-none focus:border-primary text-sm">{{ old('meta_description', $house->meta_description ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2">Canonical URL</label>
                            <input type="url" name="canonical_url" value="{{ old('canonical_url', $house->canonical_url ?? '') }}" placeholder="https://" class="w-full px-4 py-2 rounded-lg border border-slate-200 outline-none focus:border-primary text-sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-primary hover:bg-primary-hover text-white px-10 py-4 rounded-xl font-black shadow-xl shadow-green-500/30 transition-all text-lg">
                {{ isset($house) ? 'Simpan Perubahan' : 'Publish Tipe Rumah' }}
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const priceInput = document.getElementById('priceInput');
        const priceDisplay = document.getElementById('priceDisplay');
        const priceText = document.getElementById('priceText');

        if(priceInput && priceDisplay && priceText) {
            function formatWord(num) {
                if(isNaN(num) || num === 0) return '';
                
                let formatted = '';
                if(num >= 1000000000000) {
                    formatted = (num / 1000000000000).toLocaleString('id-ID', {maximumFractionDigits:2}) + ' Triliun';
                } else if(num >= 1000000000) {
                    formatted = (num / 1000000000).toLocaleString('id-ID', {maximumFractionDigits:2}) + ' Miliar';
                } else if(num >= 1000000) {
                    formatted = (num / 1000000).toLocaleString('id-ID', {maximumFractionDigits:2}) + ' Juta';
                } else if(num >= 1000) {
                    formatted = (num / 1000).toLocaleString('id-ID', {maximumFractionDigits:2}) + ' Ribu';
                } else {
                    formatted = num.toLocaleString('id-ID');
                }
                return 'Terbaca: Rp ' + formatted;
            }

            function processNumber(value) {
                // Hapus semua karakter selain angka
                const numericStr = String(value).replace(/\D/g, '');
                if(!numericStr) return { str: '', num: 0 };
                const num = parseInt(numericStr, 10);
                // Format dengan separator ribuan titik (format Indonesia)
                const formattedStr = new Intl.NumberFormat('id-ID').format(num);
                return { str: formattedStr, num: num };
            }

            priceDisplay.addEventListener('input', function(e) {
                let currentPos = e.target.selectionStart;
                let oldLength = e.target.value.length;
                
                const res = processNumber(e.target.value);
                e.target.value = res.str;
                priceInput.value = res.num || '';
                priceText.innerText = formatWord(res.num);
                
                // Menjaga posisi kursor saat mengetik agar tidak loncat ke belakang
                let newLength = e.target.value.length;
                let newPos = currentPos + (newLength - oldLength);
                e.target.setSelectionRange(newPos, newPos);
            });

            // Run on load
            if(priceDisplay.value) {
                const res = processNumber(priceDisplay.value);
                priceDisplay.value = res.str;
                priceInput.value = res.num || '';
                priceText.innerText = formatWord(res.num);
            }
        }
    });
</script>
@endsection