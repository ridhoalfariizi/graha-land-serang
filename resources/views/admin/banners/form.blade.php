@extends('admin.layouts.app')
@section('title', isset($item) ? 'Edit Banner' : 'Tambah Banner')
@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
    <form action="{{ isset($item) ? route('admin.banners.update', $item->id) : route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf @if(isset($item)) @method('PUT') @endif
        
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Judul (Internal)</label>
                <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Headline</label>
                <input type="text" name="headline" value="{{ old('headline', $item->headline ?? '') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary">
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold text-slate-700 mb-2">Sub-Headline</label>
            <input type="text" name="subheadline" value="{{ old('subheadline', $item->subheadline ?? '') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary">
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Image Desktop (1920x800)</label>
                <input type="file" name="image" class="w-full px-4 py-3 rounded-xl border border-slate-200">
                @if(isset($item) && $item->image)<img src="{{ Storage::url($item->image) }}" class="mt-2 h-20 rounded">@endif
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Image Mobile (600x800)</label>
                <input type="file" name="mobile_image" class="w-full px-4 py-3 rounded-xl border border-slate-200">
                @if(isset($item) && $item->mobile_image)<img src="{{ Storage::url($item->mobile_image) }}" class="mt-2 h-20 rounded">@endif
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">CTA Teks</label>
                <input type="text" name="cta_text" value="{{ old('cta_text', $item->cta_text ?? '') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Link Redirect</label>
                <input type="url" name="link" value="{{ old('link', $item->link ?? '') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary">
            </div>
        </div>

        <div class="mb-6 flex items-center space-x-3">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 text-primary">
            <label for="is_active" class="font-bold text-slate-700">Tampilkan Banner (Aktif)</label>
        </div>

        <div class="flex justify-end">
            <button class="bg-primary hover:bg-primary-hover text-white px-8 py-3 rounded-xl font-bold shadow-lg">Simpan Banner</button>
        </div>
    </form>
</div>
@endsection