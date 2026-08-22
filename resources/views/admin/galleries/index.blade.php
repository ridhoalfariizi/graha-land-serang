@extends('admin.layouts.app')
@section('title', 'Manajemen Galeri')
@section('content')

@if(session('success'))
<div class="mb-4 p-4 bg-green-100 text-green-700 rounded-xl font-bold">
    {{ session('success') }}
</div>
@endif

<div x-data="galleryManager()" class="space-y-6">
    <!-- Header & Actions -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-slate-800">Manajemen Galeri</h2>
        <div class="flex gap-3">
            <button x-show="selected.length > 0" @click="deleteSelected" class="bg-red-500 text-white px-5 py-2 rounded-xl text-sm font-bold shadow-lg hover:bg-red-600 transition">
                Hapus Terpilih (<span x-text="selected.length"></span>)
            </button>
            <button @click="showUploadModal = true" class="bg-primary hover:bg-primary-hover text-white px-6 py-2 rounded-xl text-sm font-bold shadow-lg shadow-green-500/30 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Upload Foto (Multiple)
            </button>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
        @if($galleries->count() > 0)
        <div id="sortable-gallery" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
            @foreach($galleries as $gallery)
            <div data-id="{{ $gallery->id }}" class="group relative rounded-xl overflow-hidden shadow-sm border border-slate-200 cursor-move aspect-square bg-slate-100">
                @if($gallery->type === 'video')
                    @php
                        // Extract YT video ID for thumbnail
                        $videoId = '';
                        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $gallery->video_url, $match);
                        if(isset($match[1])) { $videoId = $match[1]; }
                    @endphp
                    @if($videoId)
                        <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center bg-slate-800 text-slate-400">
                            <svg class="w-12 h-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="text-xs font-bold uppercase">External Video</span>
                        </div>
                    @endif
                    
                    <!-- Video Play Icon Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <div class="w-10 h-10 bg-white/90 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-5 h-5 text-red-600 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                @else
                    <img src="{{ Storage::url($gallery->image) }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                    <!-- Checkbox -->
                    <div class="absolute top-2 left-2">
                        <input type="checkbox" value="{{ $gallery->id }}" x-model="selected" class="w-5 h-5 text-primary border-slate-300 rounded focus:ring-primary">
                    </div>
                    <!-- Delete Single -->
                    <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST" class="absolute top-2 right-2" onsubmit="return confirm('Yakin hapus foto ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-500/90 hover:bg-red-600 text-white p-2 rounded-lg backdrop-blur-sm transition">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                    <!-- Category Badge -->
                    <div class="absolute bottom-2 left-3 right-2 text-white">
                        <span class="px-2 py-1 bg-white/20 backdrop-blur-md rounded-md text-[10px] font-bold uppercase">{{ $gallery->category }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <p class="text-xs text-slate-500 mt-4"><span class="font-bold">Tips:</span> Anda dapat melakukan drag & drop pada foto di atas untuk mengubah urutan galeri pada website.</p>
        @else
        <div class="py-12 text-center flex flex-col items-center">
            <svg class="w-16 h-16 text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <p class="text-slate-500">Belum ada foto galeri.</p>
        </div>
        @endif
    </div>

    <!-- Upload Modal -->
    <div x-show="showUploadModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm" style="display: none;">
        <div class="bg-white rounded-2xl w-full max-w-lg p-8 shadow-2xl relative" @click.away="showUploadModal = false">
            <button @click="showUploadModal = false" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <h3 class="text-2xl font-bold text-slate-800 mb-6">Tambah Item Galeri</h3>
            
            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Tipe Media</label>
                    <div class="flex gap-4">
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="type" value="image" x-model="mediaType" class="peer sr-only">
                            <div class="px-4 py-3 text-center border-2 border-slate-200 rounded-xl peer-checked:border-primary peer-checked:bg-green-50 font-bold text-slate-500 peer-checked:text-primary transition">Foto / Gambar</div>
                        </label>
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="type" value="video" x-model="mediaType" class="peer sr-only">
                            <div class="px-4 py-3 text-center border-2 border-slate-200 rounded-xl peer-checked:border-primary peer-checked:bg-green-50 font-bold text-slate-500 peer-checked:text-primary transition">Video URL</div>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kategori Galeri</label>
                    <select name="category" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-green-600 outline-none">
                        <option value="Umum">Umum</option>
                        <option value="Eksterior">Eksterior</option>
                        <option value="Interior">Interior</option>
                        <option value="Fasilitas">Fasilitas</option>
                        <option value="Progres">Progres Pembangunan</option>
                    </select>
                </div>
                
                <div x-show="mediaType === 'image'">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Pilih Foto (Bisa pilih banyak sekaligus)</label>
                    <input type="file" name="images[]" multiple accept="image/*" :required="mediaType === 'image'" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-green-50 file:text-primary hover:file:bg-green-100">
                </div>

                <div x-show="mediaType === 'video'">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Link YouTube / TikTok</label>
                    <input type="url" name="video_url" :required="mediaType === 'video'" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-green-600 outline-none" placeholder="https://www.youtube.com/watch?v=...">
                    <p class="text-xs text-slate-400 mt-2">Gunakan link YouTube lengkap untuk performa galeri yang optimal.</p>
                </div>

                <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white py-3 rounded-xl font-bold shadow-lg shadow-green-500/30 transition mt-4">
                    Simpan ke Galeri
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Load Sortable JS & Alpine -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('galleryManager', () => ({
            showUploadModal: false,
            mediaType: 'image',
            selected: [],
            init() {
                let el = document.getElementById('sortable-gallery');
                if (el) {
                    Sortable.create(el, {
                        animation: 150,
                        onEnd: (evt) => {
                            let items = el.children;
                            let order = [];
                            for (let i = 0; i < items.length; i++) {
                                order.push(items[i].getAttribute('data-id'));
                            }
                            fetch('{{ route("admin.galleries.index") }}/reorder', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ order: order })
                            });
                        }
                    });
                }
            },
            deleteSelected() {
                if (confirm('Yakin menghapus ' + this.selected.length + ' foto terpilih?')) {
                    fetch('{{ route("admin.galleries.index") }}/mass-destroy', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ ids: this.selected })
                    }).then(res => window.location.reload());
                }
            }
        }));
    });
</script>
@endsection