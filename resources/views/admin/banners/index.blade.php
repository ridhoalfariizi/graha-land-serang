@extends('admin.layouts.app')
@section('title', 'Manajemen Banner')
@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-slate-800">Banner & Slider</h2>
    <a href="{{ route('admin.banners.create') }}" class="bg-primary hover:bg-primary-hover text-white px-6 py-2 rounded-xl text-sm font-bold shadow-lg shadow-green-500/30">Tambah Banner</a>
</div>
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs uppercase tracking-wider">
                <th class="p-4 font-bold">Preview Desktop & Mobile</th>
                <th class="p-4 font-bold">INFO BANNER</th>
                <th class="p-4 font-bold text-center">STATUS</th>
                <th class="p-4 font-bold text-right">AKSI</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-sm">
            @foreach($data as $b)
            <tr class="hover:bg-slate-50">
                <td class="p-4 flex gap-4 items-center">
                    @if($b->image)<img src="{{ Storage::url($b->image) }}" class="h-16 w-24 object-cover rounded shadow-sm border">@endif
                    @if($b->mobile_image)<img src="{{ Storage::url($b->mobile_image) }}" class="h-16 w-12 object-cover rounded shadow-sm border">@endif
                </td>
                <td class="p-4">
                    <div class="font-bold text-slate-800">{{ $b->title }}</div>
                    <div class="text-xs text-slate-500">{{ $b->headline }} - {{ $b->subheadline }}</div>
                </td>
                <td class="p-4 text-center">
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $b->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500' }}">
                        {{ $b->is_active ? 'Aktif' : 'Draft' }}
                    </span>
                </td>
                <td class="p-4 text-right">
                    <a href="{{ route('admin.banners.edit', $b->id) }}" class="text-blue-500 hover:text-blue-700 font-bold mr-3">Edit</a>
                    <form action="{{ route('admin.banners.destroy', $b->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus banner?')">
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