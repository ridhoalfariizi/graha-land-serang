@extends('admin.layouts.app')
@section('title', 'Tipe Rumah')
@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Manajemen Tipe Rumah</h2>
        <p class="text-slate-500 text-sm mt-1">Kelola spesifikasi, harga, status, dan SEO properti.</p>
    </div>
    <a href="{{ route('admin.house-types.create') }}" class="bg-primary hover:bg-primary-hover text-white px-6 py-2 rounded-xl text-sm font-bold shadow-lg shadow-green-500/30 transition-all flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Tipe Rumah
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs uppercase tracking-wider">
                    <th class="p-4 font-bold">INFO RUMAH</th>
                    <th class="p-4 font-bold">SPESIFIKASI</th>
                    <th class="p-4 font-bold text-right">HARGA (RP)</th>
                    <th class="p-4 font-bold text-center">STATUS</th>
                    <th class="p-4 font-bold text-right">AKSI</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($houses as $h)
                <tr class="hover:bg-slate-50 transition">
                    <td class="p-4">
                        <div class="font-bold text-slate-800 text-base">{{ $h->name }}</div>
                        <div class="text-xs text-slate-500">{{ $h->slug }}</div>
                    </td>
                    <td class="p-4 text-slate-600">
                        LB {{ $h->building_size }} / LT {{ $h->land_size }} m² <br>
                        {{ $h->bedrooms }} KT • {{ $h->bathrooms }} KM
                    </td>
                    <td class="p-4 text-right font-bold text-primary">
                        {{ number_format($h->price, 0, ',', '.') }}
                    </td>
                    <td class="p-4 text-center">
                        @if($h->status == 'Available')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">{{ $h->status }}</span>
                        @elseif($h->status == 'Booking')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">{{ $h->status }}</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">{{ $h->status }}</span>
                        @endif
                    </td>
                    <td class="p-4 text-right">
                        <a href="{{ route('admin.house-types.edit', $h->id) }}" class="text-blue-500 hover:text-blue-700 font-bold mr-3">Edit</a>
                        <form action="{{ route('admin.house-types.destroy', $h->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus tipe rumah ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 font-bold">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-10 text-center text-slate-500">Belum ada tipe rumah</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection