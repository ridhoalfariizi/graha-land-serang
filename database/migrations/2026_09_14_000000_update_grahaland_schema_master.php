<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Create testimonials table
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo')->nullable();
            $table->text('content');
            $table->tinyInteger('rating')->default(5);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Create banners table
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->string('link')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 3. Create visitors table
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->string('user_agent')->nullable();
            $table->string('page_url');
            $table->timestamps();
        });

        // 4. Update articles table
        Schema::table('articles', function (Blueprint $table) {
            $table->unsignedBigInteger('views_count')->default(0)->after('status');
        });

        // 5. Update house_types table
        Schema::table('house_types', function (Blueprint $table) {
            if (!Schema::hasColumn('house_types', 'images')) {
                $table->json('images')->nullable()->after('house_image');
            }
            if (!Schema::hasColumn('house_types', 'floor_plan_image')) {
                $table->string('floor_plan_image')->nullable()->after('images');
            }
            if (!Schema::hasColumn('house_types', 'features')) {
                $table->json('features')->nullable()->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('banners');
        Schema::dropIfExists('visitors');
        
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('views_count');
        });
        
        Schema::table('house_types', function (Blueprint $table) {
            $table->dropColumn(['images', 'floor_plan_image', 'features']);
        });
    }
};
