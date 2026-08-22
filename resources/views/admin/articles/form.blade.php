@extends('admin.layouts.app')
@section('title', isset($item) ? 'Edit Artikel' : 'Tulis Artikel')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<div class="max-w-6xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-3xl font-black text-slate-800">{{ isset($item) ? 'Edit Artikel' : 'Tulis Artikel Baru' }}</h2>
    </div>

    <form action="{{ isset($item) ? route('admin.articles.update', $item->id) : route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf @if(isset($item)) @method('PUT') @endif
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <!-- Konten Utama -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Judul Artikel</label>
                        <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}" required class="w-full px-5 py-4 rounded-xl border border-slate-200 outline-none focus:border-primary focus:ring-4 focus:ring-green-500/10 text-lg font-semibold transition-all">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Isi Artikel</label>
                        <textarea id="summernote" name="content" required>{{ old('content', $item->content ?? '') }}</textarea>
                    </div>
                </div>

                <!-- SEO & Meta -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-bold text-slate-800 border-b pb-4 mb-6">SEO Metadata Custom</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Meta Title (Max 60 Char)</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title', $item->meta_title ?? '') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Meta Keywords (Pisahkan dengan koma)</label>
                            <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $item->meta_keywords ?? '') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Meta Description (Max 160 Char)</label>
                        <textarea name="meta_description" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary">{{ old('meta_description', $item->meta_description ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Sidebar Pengaturan -->
            <div class="space-y-6">
                <!-- Status & Publish -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                    <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-4">Pengaturan</h3>
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Status Publikasi</label>
                        <select name="status" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary text-slate-700 font-bold bg-slate-50">
                            <option value="published" {{ old('status', $item->status ?? '') == 'published' ? 'selected' : '' }}>Published (Live)</option>
                            <option value="draft" {{ old('status', $item->status ?? '') == 'draft' ? 'selected' : '' }}>Simpan sebagai Draft</option>
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Kategori Utama</label>
                        <input type="text" name="category" list="category-list" value="{{ old('category', $item->category ?? 'Berita Properti') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary font-bold text-slate-700" placeholder="Pilih atau ketik kategori baru...">
                        <datalist id="category-list">
                            @foreach(\App\Models\Article::select('category')->distinct()->pluck('category') as $cat)
                                @if($cat) <option value="{{ $cat }}"></option> @endif
                            @endforeach
                            <option value="Berita Properti"></option>
                            <option value="Inspirasi & Desain"></option>
                            <option value="Event Perumahan"></option>
                        </datalist>
                        <p class="text-[11px] text-slate-400 mt-1">Anda bisa mengetik nama kategori baru disini.</p>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tags / Label</label>
                        <input type="text" name="tags" placeholder="KPR, Murah, Bebas Banjir" value="{{ old('tags', isset($item) && $item->tags ? implode(',', $item->tags) : '') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary">
                        <p class="text-[10px] text-slate-400 mt-1">Pisahkan dengan koma.</p>
                    </div>

                    <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white py-4 rounded-2xl font-black text-lg shadow-xl shadow-green-500/30 transition-all">
                        Simpan Artikel
                    </button>
                </div>
                
                <!-- Thumbnail -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                    <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-4">Thumbnail Image</h3>
                    <input type="file" name="image" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs">
                    @if(isset($item) && $item->thumbnail)
                        <img src="{{ Storage::url($item->thumbnail) }}" class="mt-4 rounded-xl shadow-sm border object-cover w-full h-40">
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Summernote Script -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $('#summernote').summernote({
        placeholder: 'Mulai menulis artikel yang menarik...',
        tabsize: 2,
        height: 600,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
</script>
@endsection