@extends('admin.layouts.app')
@section('title', isset($item) ? 'Edit Fasilitas' : 'Tambah Fasilitas')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
    <form action="{{ isset($item) ? route('admin.facilities.update', $item->id) : route('admin.facilities.store') }}" method="POST" enctype="multipart/form-data">
        @csrf @if(isset($item)) @method('PUT') @endif
        
        <div class="mb-6">
            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Fasilitas</label>
            <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Icon Class (Contoh: fas fa-swimming-pool)</label>
            <input type="text" name="icon" value="{{ old('icon', $item->icon ?? '') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi</label>
            <textarea name="description" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary">{{ old('description', $item->description ?? '') }}</textarea>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold text-slate-700 mb-2">Gambar Fasilitas HD</label>
            <input type="file" name="image" class="w-full px-4 py-3 rounded-xl border border-slate-200">
            @if(isset($item) && $item->image)<img src="{{ Storage::url($item->image) }}" class="mt-2 h-20 rounded">@endif
        </div>

        <div class="mb-6 flex items-center space-x-3">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 text-primary">
            <label for="is_active" class="font-bold text-slate-700">Tampilkan di Website</label>
        </div>

        <button class="w-full bg-primary hover:bg-primary-hover text-white px-8 py-3 rounded-xl font-bold shadow-lg">Simpan Fasilitas</button>
    </form>
</div>
@endsection