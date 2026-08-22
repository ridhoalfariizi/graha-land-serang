@extends('admin.layouts.app')
@section('title', 'Analytics Dashboard')
@section('content')

<!-- Statistic Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
        <div>
            <p class="text-sm font-bold text-slate-500 mb-1">Total Pengunjung</p>
            <h3 class="text-3xl font-black text-slate-800">{{ number_format($stats['total_visitors']) }}</h3>
        </div>
        <div class="w-14 h-14 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center">
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
        </div>
    </div>
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
        <div>
            <p class="text-sm font-bold text-slate-500 mb-1">Total Leads Masuk</p>
            <h3 class="text-3xl font-black text-slate-800">{{ number_format($stats['total_leads']) }}</h3>
        </div>
        <div class="w-14 h-14 rounded-full bg-green-50 text-green-500 flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
    </div>
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
        <div>
            <p class="text-sm font-bold text-slate-500 mb-1">Tipe Rumah Aktif</p>
            <h3 class="text-3xl font-black text-slate-800">{{ number_format($stats['total_houses']) }}</h3>
        </div>
        <div class="w-14 h-14 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        </div>
    </div>
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
        <div>
            <p class="text-sm font-bold text-slate-500 mb-1">Artikel Diterbitkan</p>
            <h3 class="text-3xl font-black text-slate-800">{{ number_format($stats['total_articles']) }}</h3>
        </div>
        <div class="w-14 h-14 rounded-full bg-purple-50 text-purple-500 flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15" /></svg>
        </div>
    </div>
</div>

<!-- Chart & Popular -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Chart Container -->
    <div class="lg:col-span-2 bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
        <h3 class="text-xl font-bold text-slate-800 mb-2">Trafik Pengunjung 30 Hari Terakhir</h3>
        <p class="text-sm text-slate-500 mb-6">Analisis performa kunjungan website dan sumber konversi leads baru.</p>
        <div class="relative h-80 w-full">
            <canvas id="trafficChart"></canvas>
        </div>
    </div>

    <!-- Popular Articles -->
    <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
        <h3 class="text-xl font-bold text-slate-800 mb-6 border-b pb-4">Artikel Terpopuler</h3>
        <div class="space-y-5">
            @forelse($popular_articles as $article)
            <div class="flex items-start gap-4">
                @if($article->thumbnail)
                    <img src="{{ Storage::url($article->thumbnail) }}" class="w-16 h-16 rounded-xl object-cover border border-slate-200">
                @else
                    <div class="w-16 h-16 rounded-xl bg-slate-100 flex items-center justify-center border border-slate-200"><svg class="w-6 h-6 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0V17H4m4-10a2 2 0 110-4 2 2 0 010 4z"/></svg></div>
                @endif
                <div class="flex-1">
                    <a href="{{ route('admin.articles.edit', $article->id) }}" class="font-bold text-slate-800 hover:text-primary text-sm line-clamp-2 leading-snug">{{ $article->title }}</a>
                    <div class="text-xs text-slate-500 mt-1 font-semibold flex items-center gap-1">
                        <i class="fas fa-eye text-primary"></i> {{ number_format($article->views) }} views
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center text-slate-500 text-sm py-4">Belum ada data artikel.</div>
            @endforelse
        </div>
    </div>

</div>

<!-- Load Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('trafficChart').getContext('2d');

    // Create a powerful gradient for the line chart
    let gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(94, 142, 46, 0.5)'); // Graha Land Primary Green
    gradient.addColorStop(1, 'rgba(94, 142, 46, 0.0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($dates) !!},
            datasets: [{
                label: 'Pengunjung',
                data: {!! json_encode($visitors) !!},
                borderColor: '#5E8E2E',
                backgroundColor: gradient,
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#5E8E2E',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            },
            {
                label: 'Leads Masuk',
                data: {!! json_encode($leads) !!},
                borderColor: '#ef4444',
                backgroundColor: 'transparent',
                borderWidth: 2,
                borderDash: [5, 5],
                tension: 0.4,
                pointBackgroundColor: '#ef4444',
                pointRadius: 3,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'top', align: 'end', labels: { usePointStyle: true, boxWidth: 8, font: { family: "'Plus Jakarta Sans', sans-serif", weight: 'bold' } } }
            },
            scales: {
                y: { beginAtZero: true, grid: { borderDash: [4, 4], color: '#f1f5f9' }, border: { display: false } },
                x: { grid: { display: false }, border: { display: false }, ticks: { maxTicksLimit: 10 } }
            },
            interaction: { mode: 'index', intersect: false }
        }
    });
</script>
@endsection