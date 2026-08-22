@extends('admin.layouts.app')
@section('title', 'Manajemen Testimoni')
@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-slate-800">Manajemen Testimoni</h2>
    <a href="{{ route('admin.testimonials.create') }}" class="bg-primary hover:bg-primary-hover text-white px-6 py-2 rounded-xl text-sm font-bold shadow-lg">Tambah Testimoni</a>
</div>
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs uppercase tracking-wider">
                <th class="p-4 font-bold">FOTO</th>
                <th class="p-4 font-bold">NAMA & PROFESI</th>
                <th class="p-4 font-bold">TESTIMONI</th>
                <th class="p-4 font-bold text-center">STATUS</th>
                <th class="p-4 font-bold text-right">AKSI</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-sm">
            @foreach($data as $b)
            <tr class="hover:bg-slate-50">
                <td class="p-4">
                    @if($b->photo)<img src="{{ Storage::url($b->photo) }}" class="h-12 w-12 rounded-full object-cover shadow-sm border">@endif
                </td>
                <td class="p-4">
                    <div class="font-bold text-slate-800">{{ $b->name }}</div>
                    <div class="text-xs text-slate-500">{{ $b->job_title ?? 'Pelanggan' }}</div>
                </td>
                <td class="p-4">
                    <div class="text-yellow-400 text-xs mb-1">
                        @for($i=0; $i<$b->rating; $i++) ★ @endfor
                    </div>
                    <div class="text-slate-600 line-clamp-2 italic">"{{ $b->content }}"</div>
                </td>
                <td class="p-4 text-center">
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $b->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500' }}">
                        {{ $b->is_active ? 'Tampil' : 'Sembunyi' }}
                    </span>
                </td>
                <td class="p-4 text-right">
                    <a href="{{ route('admin.testimonials.edit', $b->id) }}" class="text-blue-500 font-bold mr-3">Edit</a>
                    <form action="{{ route('admin.testimonials.destroy', $b->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus?')">
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