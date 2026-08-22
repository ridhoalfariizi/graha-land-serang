@extends('admin.layouts.app')
@section('title', 'Manajemen Artikel')
@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-slate-800">Artikel & Blog</h2>
    <a href="{{ route('admin.articles.create') }}" class="bg-primary hover:bg-primary-hover text-white px-6 py-2 rounded-xl text-sm font-bold shadow-lg shadow-green-500/30">Tambah Artikel</a>
</div>
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs uppercase tracking-wider">
                <th class="p-4 font-bold">INFO ARTIKEL</th>
                <th class="p-4 font-bold">KATEGORI & TAGS</th>
                <th class="p-4 font-bold text-center">VIEWS</th>
                <th class="p-4 font-bold text-right">AKSI</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-sm">
            @foreach($data as $b)
            <tr class="hover:bg-slate-50">
                <td class="p-4">
                    <div class="font-bold text-slate-800 text-base mb-1">{{ $b->title }}</div>
                    <div class="text-xs text-slate-500 flex gap-2 items-center">
                        <span class="px-2 py-1 rounded bg-slate-100 font-bold {{ $b->status == 'Published' ? 'text-green-600 bg-green-50' : 'text-slate-500' }}">{{ $b->status }}</span>
                        {{ $b->created_at->format('d M Y') }}
                    </div>
                </td>
                <td class="p-4">
                    <div class="font-bold text-slate-700">{{ $b->category ?? 'Umum' }}</div>
                    <div class="flex gap-1 mt-1 flex-wrap">
                        @if($b->tags)
                        @foreach($b->tags as $t)
                            <span class="px-2 py-0.5 bg-slate-100 text-slate-500 rounded text-[10px]">{{ $t }}</span>
                        @endforeach
                        @endif
                    </div>
                </td>
                <td class="p-4 text-center font-bold text-slate-600">
                    {{ $b->views ?? 0 }} <i class="fas fa-eye text-slate-400"></i>
                </td>
                <td class="p-4 text-right">
                    <a href="{{ route('admin.articles.edit', $b->id) }}" class="text-blue-500 font-bold mr-3">Edit</a>
                    <form action="{{ route('admin.articles.destroy', $b->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus artikel ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 font-bold">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection