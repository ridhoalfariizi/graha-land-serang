<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Update Users Table (Roles)
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('super_admin')->after('email');
            }
        });

        // 2. Update House Types
        Schema::table('house_types', function (Blueprint $table) {
            if (!Schema::hasColumn('house_types', 'status')) $table->string('status')->default('Available')->after('description');
            if (!Schema::hasColumn('house_types', 'meta_title')) $table->string('meta_title')->nullable();
            if (!Schema::hasColumn('house_types', 'meta_description')) $table->text('meta_description')->nullable();
            if (!Schema::hasColumn('house_types', 'og_image')) $table->string('og_image')->nullable();
            if (!Schema::hasColumn('house_types', 'canonical_url')) $table->string('canonical_url')->nullable();
        });

        // 3. Update Galleries
        Schema::table('galleries', function (Blueprint $table) {
            if (!Schema::hasColumn('galleries', 'sort_order')) $table->integer('sort_order')->default(0);
            if (!Schema::hasColumn('galleries', 'category')) $table->string('category')->default('Umum');
        });

        // 4. Update Articles
        Schema::table('articles', function (Blueprint $table) {
            if (!Schema::hasColumn('articles', 'meta_title')) $table->string('meta_title')->nullable();
            if (!Schema::hasColumn('articles', 'meta_description')) $table->text('meta_description')->nullable();
            if (!Schema::hasColumn('articles', 'meta_keywords')) $table->string('meta_keywords')->nullable();
            if (!Schema::hasColumn('articles', 'tags')) $table->json('tags')->nullable();
            if (!Schema::hasColumn('articles', 'og_image')) $table->string('og_image')->nullable();
        });

        // 5. Update Leads
        Schema::table('leads', function (Blueprint $table) {
            if (!Schema::hasColumn('leads', 'source')) $table->string('source')->nullable()->after('message');
            if (!Schema::hasColumn('leads', 'status')) $table->string('status')->default('New')->after('source');
            if (!Schema::hasColumn('leads', 'notes')) $table->text('notes')->nullable()->after('status');
        });

        // 6. Update FAQs
        Schema::table('faqs', function (Blueprint $table) {
            if (!Schema::hasColumn('faqs', 'category')) $table->string('category')->default('Umum')->after('answer');
            if (!Schema::hasColumn('faqs', 'is_active')) $table->boolean('is_active')->default(true)->after('sort_order');
        });

        // 7. Update Banners
        Schema::table('banners', function (Blueprint $table) {
            if (!Schema::hasColumn('banners', 'mobile_image')) $table->string('mobile_image')->nullable()->after('image');
            if (!Schema::hasColumn('banners', 'headline')) $table->string('headline')->nullable()->after('title');
            if (!Schema::hasColumn('banners', 'subheadline')) $table->string('subheadline')->nullable()->after('headline');
            if (!Schema::hasColumn('banners', 'cta_text')) $table->string('cta_text')->nullable()->after('subheadline');
            if (!Schema::hasColumn('banners', 'sort_order')) $table->integer('sort_order')->default(0)->after('is_active');
        });
        
        // 8. Update Testimonials
        Schema::table('testimonials', function (Blueprint $table) {
            if (!Schema::hasColumn('testimonials', 'job_title')) $table->string('job_title')->nullable()->after('name');
            if (!Schema::hasColumn('testimonials', 'sort_order')) $table->integer('sort_order')->default(0)->after('is_active');
        });
        
        // 9. Update Facilities
        Schema::table('facilities', function (Blueprint $table) {
            if (!Schema::hasColumn('facilities', 'icon')) $table->string('icon')->nullable()->after('name');
            if (!Schema::hasColumn('facilities', 'description')) $table->text('description')->nullable()->after('icon');
            if (!Schema::hasColumn('facilities', 'image')) $table->string('image')->nullable()->after('description');
            if (!Schema::hasColumn('facilities', 'sort_order')) $table->integer('sort_order')->default(0)->after('image');
            if (!Schema::hasColumn('facilities', 'is_active')) $table->boolean('is_active')->default(true)->after('sort_order');
        });
    }

    public function down(): void
    {
        // For safety during rollback
    }
};
