@extends('admin.layouts.app')
@section('title', isset($item) ? 'Edit Testimoni' : 'Tambah Testimoni')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
    <form action="{{ isset($item) ? route('admin.testimonials.update', $item->id) : route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf @if(isset($item)) @method('PUT') @endif
        
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Pelanggan</label>
                <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Profesi / Pekerjaan</label>
                <input type="text" name="job_title" value="{{ old('job_title', $item->job_title ?? '') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Rating (1-5)</label>
                <input type="number" name="rating" min="1" max="5" value="{{ old('rating', $item->rating ?? 5) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Foto Pelanggan</label>
                <input type="file" name="image" class="w-full px-3 py-2 rounded-xl border border-slate-200">
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold text-slate-700 mb-2">Isi Testimoni</label>
            <textarea name="content" required rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary">{{ old('content', $item->content ?? '') }}</textarea>
        </div>

        <div class="mb-6 flex items-center space-x-3">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 text-primary">
            <label for="is_active" class="font-bold text-slate-700">Tampilkan di Website</label>
        </div>

        <button class="w-full bg-primary hover:bg-primary-hover text-white px-8 py-3 rounded-xl font-bold shadow-lg">Simpan Testimoni</button>
    </form>
</div>
@endsection