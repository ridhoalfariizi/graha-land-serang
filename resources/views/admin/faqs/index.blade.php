@extends('admin.layouts.app')
@section('title', 'Manajemen FAQ')
@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-slate-800">FAQ & Bantuan</h2>
    <a href="{{ route('admin.faqs.create') }}" class="bg-primary hover:bg-primary-hover text-white px-6 py-2 rounded-xl text-sm font-bold shadow-lg">Tambah FAQ</a>
</div>
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs uppercase tracking-wider">
                <th class="p-4 font-bold">PERTANYAAN & JAWABAN</th>
                <th class="p-4 font-bold">KATEGORI</th>
                <th class="p-4 font-bold text-center">STATUS</th>
                <th class="p-4 font-bold text-right">AKSI</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-sm">
            @foreach($data as $b)
            <tr class="hover:bg-slate-50">
                <td class="p-4">
                    <div class="font-bold text-slate-800">{{ $b->question }}</div>
                    <div class="text-xs text-slate-500 mt-1 line-clamp-1">{{ $b->answer }}</div>
                </td>
                <td class="p-4"><span class="px-3 py-1 bg-slate-100 rounded-full font-bold text-xs">{{ $b->category }}</span></td>
                <td class="p-4 text-center">
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $b->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $b->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td class="p-4 text-right">
                    <a href="{{ route('admin.faqs.edit', $b->id) }}" class="text-blue-500 font-bold mr-3">Edit</a>
                    <form action="{{ route('admin.faqs.destroy', $b->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus FAQ?')">
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