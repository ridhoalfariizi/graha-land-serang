@extends('admin.layouts.app')
@section('title', isset($item) ? 'Edit FAQ' : 'Tambah FAQ')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
    <form action="{{ isset($item) ? route('admin.faqs.update', $item->id) : route('admin.faqs.store') }}" method="POST">
        @csrf @if(isset($item)) @method('PUT') @endif
        
        <div class="mb-6">
            <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
            <select name="category" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary">
                <option value="Umum" {{ old('category', $item->category ?? '') == 'Umum' ? 'selected' : '' }}>Umum</option>
                <option value="KPR" {{ old('category', $item->category ?? '') == 'KPR' ? 'selected' : '' }}>KPR & Pembayaran</option>
                <option value="Legalitas" {{ old('category', $item->category ?? '') == 'Legalitas' ? 'selected' : '' }}>Legalitas & Sertifikat</option>
            </select>
        </div>
        
        <div class="mb-6">
            <label class="block text-sm font-bold text-slate-700 mb-2">Pertanyaan</label>
            <input type="text" name="question" value="{{ old('question', $item->question ?? '') }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold text-slate-700 mb-2">Jawaban</label>
            <textarea name="answer" required rows="5" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-primary">{{ old('answer', $item->answer ?? '') }}</textarea>
        </div>

        <div class="mb-6 flex items-center space-x-3">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 text-primary">
            <label for="is_active" class="font-bold text-slate-700">Tampilkan di Website</label>
        </div>

        <button class="w-full bg-primary hover:bg-primary-hover text-white px-8 py-3 rounded-xl font-bold shadow-lg">Simpan FAQ</button>
    </form>
</div>
@endsection