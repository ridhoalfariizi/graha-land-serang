<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{User, HouseType, Facility, Gallery, Article, Faq, Lead, Setting, Promo};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Setup Admin
        $admin = User::create([
            'name' => 'Admin Graha Land',
            'email' => 'admin@ptbanaciptagraha.com',
            'password' => Hash::make('password')
        ]);

        // 2. Initial Setup Settings (Key-Value)
        $settings = [
            ['key' => 'site_name', 'value' => 'Graha Land Serang'],
            ['key' => 'contact_phone', 'value' => '085947418388'],
            ['key' => 'contact_email', 'value' => 'ptbanaciptagraha@gmail.com'],
            ['key' => 'contact_address', 'value' => 'Pengampelan, Kecamatan Walantaka, Kota Serang, Banten'],
            ['key' => 'hero_title', 'value' => 'Hunian Subsidi Modern Bernuansa Eropa di Kota Serang'],
            ['key' => 'hero_subtitle', 'value' => 'Miliki rumah impian dengan lokasi strategis, lingkungan nyaman, dan harga terjangkau untuk keluarga masa kini.'],
            ['key' => 'about_text', 'value' => 'Graha Land Serang hadir sebagai solusi hunian modern untuk keluarga masa kini. Kami merupakan proyek perumahan yang dikembangkan oleh kolaborasi dua perusahaan terpercaya di bidang properti dan pengembangan kawasan.'],
            ['key' => 'location_embed', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920.24072877028!2d106.11586522384768!3d-6.22941549704403!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e420078028ddc5d%3A0xe54dbe5988ba97bc!2sPengampelan%2C%20Walantaka%2C%20Serang%20City%2C%20Banten!5e0!3m2!1sen!2sid!4v1710926034173!5m2!1sen!2sid'],
            ['key' => 'nearby_places', 'value' => [
                'Puspem Kabupaten Serang', 'Polres Kabupaten Serang', 'Pasar Ciruas',
                'SMAN 1 Ciruas', 'SMKN 1 Kragilan', 'RS Hermina Ciruas', 'RS Adhyaksa Banten'
            ]],
            ['key' => 'developers_list', 'value' => [
                'PT Bana Cipta Graha', 'PT Bumi Tata Nusantara'
            ]],
            ['key' => 'why_choose_us', 'value' => [
                'Harga Terjangkau', 'Lokasi Strategis', 'Lingkungan Nyaman',
                'Desain Modern Bernuansa Eropa', 'Legalitas Aman', 'Investasi Masa Depan'
            ]]
        ];

        foreach ($settings as $setting) {
            Setting::create([
                'key' => $setting['key'],
                'value' => $setting['value'],
                'type' => is_array($setting['value']) ? 'json' : 'string'
            ]);
        }

        // 3. Setup Promos
        Promo::create(['title' => 'DP 0%']);
        Promo::create(['title' => 'Gratis BPHTB']);
        Promo::create(['title' => 'Gratis Notaris']);
        Promo::create(['title' => 'Gratis Pompa Air']);
        Promo::create(['title' => 'Booking Fee Rp500.000']);

        // 4. Setup House Type
        HouseType::create([
            'slug' => 'type-30-60',
            'name' => 'Rumah Subsidi Type 30/60',
            'price' => '166000000',
            'building_size' => 30,
            'land_size' => 60,
            'bedrooms' => 2,
            'bathrooms' => 1,
            'description' => 'Rumah subsidi modern dengan desain minimalis elegan yang dirancang untuk memberikan kenyamanan bagi keluarga Indonesia.',
            'features' => ['2 Kamar Tidur', '1 Kamar Mandi', 'Ruang Keluarga', 'Carport', 'Taman Depan', 'Taman Belakang']
        ]);

        // 5. Setup Facilities
        Facility::create(['name' => 'Mushola']);
        Facility::create(['name' => 'Taman Hijau']);
        Facility::create(['name' => 'Area Bermain Anak']);
        Facility::create(['name' => 'One Gate System']);
        Facility::create(['name' => 'Open Space Area']);

        // 6. Setup Example Article
        Article::create([
            'title' => 'Investasi Properti di Kota Serang',
            'slug' => 'investasi-properti-di-kota-serang',
            'excerpt' => 'Mengapa investasi properti di Serang semakin menjanjikan?',
            'content' => '<p>Temukan alasan mengapa Kota Serang menjadi sorotan utama...</p>',
            'author_id' => $admin->id,
            'status' => 'published',
            'published_at' => now(),
            'category' => 'Investasi Properti'
        ]);

        // 7. Setup FAQs
        Faq::create([
            'question' => 'Berapa Booking Fee untuk Graha Land Serang?',
            'answer' => 'Booking Fee hanya Rp 500.000 saja sudah termasuk pengajuan KPR.',
            'sort_order' => 1
        ]);
    }
}
