<x-layout>
    <x-slot name="title">Rumah Subsidi | Graha Land Serang</x-slot>

    <div class="pt-24 pb-16 bg-white dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-black text-center text-primary mb-12" data-aos="fade-up">Rumah Subsidi</h1>
            
            @if($house)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start mb-20">
                    <!-- Image -->
                    <div data-aos="fade-right" class="sticky top-24">
                        @if($house->house_image)
                            <img src="{{ Storage::url($house->house_image) }}" alt="{{ $house->type_name }}" class="rounded-2xl shadow-xl w-full">
                        @else
                            <div class="aspect-[4/3] bg-gray-200 dark:bg-gray-800 flex items-center justify-center rounded-2xl">
                                <span class="text-gray-500">House Image</span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Info -->
                    <div data-aos="fade-left">
                        <span class="px-4 py-1.5 rounded-full bg-primary/10 text-primary font-bold text-sm mb-4 inline-block">Best Seller</span>
                        <h2 class="text-3xl font-extrabold text-dark dark:text-white mb-2">{{ $house->type_name }}</h2>
                        <div class="text-2xl font-bold text-green-600 dark:text-green-400 mb-6">{{ $house->price ?? 'Hubungi Kami' }}</div>
                        
                        <p class="text-gray-600 dark:text-gray-300 mb-8">{{ $house->description }}</p>

                        <div class="grid grid-cols-2 gap-4 mb-10">
                            <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl flex items-center gap-3">
                                <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                <div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Kamar Tidur</div>
                                    <div class="font-bold dark:text-white text-lg">{{ $house->bedrooms }}</div>
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl flex items-center gap-3">
                                <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                <div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Kamar Mandi</div>
                                    <div class="font-bold dark:text-white text-lg">{{ $house->bathrooms }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Floor Plan -->
                        <h3 class="text-2xl font-bold dark:text-white mb-4">Denah Rumah</h3>
                        @if($house->floor_plan_image)
                            <img src="{{ Storage::url($house->floor_plan_image) }}" alt="Denah Rumah" class="rounded-xl shadow-md border border-gray-100 dark:border-gray-700 w-full mb-4">
                        @endif
                        <p class="text-gray-600 dark:text-gray-300 text-sm">{{ $house->floor_plan_desc }}</p>
                    </div>
                </div>
            @else
                <div class="text-center py-20 text-gray-500">Data Rumah Subsidi belum diatur di Admin Panel.</div>
            @endif
        </div>
    </div>
</x-layout>
