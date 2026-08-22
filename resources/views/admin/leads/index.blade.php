@extends('admin.layouts.app')
@section('title', 'Data Leads Masuk')
@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Leads & Pesan</h2>
        <p class="text-slate-500 text-sm">Monitor prospek pelanggan yang masuk dari website.</p>
    </div>
    <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-xl text-sm font-bold shadow-lg border-b-4 border-blue-700 active:border-b-0 active:mt-1 print:hidden">
        Cetak Laporan / PDF
    </button>
</div>
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs uppercase tracking-wider">
                <th class="p-4 font-bold">WAKTU MASUK</th>
                <th class="p-4 font-bold">KONTAK</th>
                <th class="p-4 font-bold">PESAN & SUMBER</th>
                <th class="p-4 font-bold text-right print:hidden">AKSI</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-sm">
            @forelse($data as $b)
            <tr class="hover:bg-slate-50">
                <td class="p-4 text-slate-600">
                    <div class="font-bold text-slate-800">{{ $b->created_at->format('d M Y') }}</div>
                    <div class="text-xs">{{ $b->created_at->format('H:i') }} WIB</div>
                </td>
                <td class="p-4">
                    <div class="font-bold text-slate-800">{{ $b->name }}</div>
                    <div class="text-slate-600 text-xs">{{ $b->phone }}</div>
                    <div class="text-slate-600 text-xs">{{ $b->email }}</div>
                </td>
                <td class="p-4">
                    <div class="bg-slate-100 p-3 rounded-lg text-slate-700 italic text-xs mb-2">"{{ $b->message }}"</div>
                    <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-md text-[10px] font-bold">{{ $b->source ?? 'Formulir Website' }}</span>
                </td>
                <td class="p-4 text-right print:hidden">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $b->phone) }}" target="_blank" class="bg-green-500 text-white px-3 py-1 rounded-lg text-xs font-bold hover:bg-green-600">WhatsApp</a>
                    <form action="{{ route('admin.leads.destroy', $b->id) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Hapus Lead ini?')">
                        @csrf @method('DELETE')
                        <button class="text-slate-400 hover:text-red-500">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="p-10 text-center text-slate-500">Belum ada leads masuk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection