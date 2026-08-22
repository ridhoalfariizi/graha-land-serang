<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/tentang-kami', [FrontendController::class, 'about'])->name('about');
Route::get('/tipe-rumah', [FrontendController::class, 'houseTypes'])->name('house-types');
Route::get('/tipe-rumah/{slug}', [FrontendController::class, 'houseTypeDetail'])->name('house-type.detail');
Route::get('/fasilitas', [FrontendController::class, 'facilities'])->name('facilities');
Route::get('/lokasi', [FrontendController::class, 'location'])->name('location');
Route::get('/galeri', [FrontendController::class, 'gallery'])->name('galleries');
Route::get('/artikel', [FrontendController::class, 'articles'])->name('articles');
Route::get('/artikel/{slug}', [FrontendController::class, 'articleDetail'])->name('article.detail');
Route::get('/faq', [FrontendController::class, 'faq'])->name('faq');
Route::get('/kontak', [FrontendController::class, 'contact'])->name('contact');
Route::post('/kontak', [FrontendController::class, 'storeLead'])->name('contact.store');

Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.post');

        // Password Reset Routes
        Route::get('forgot-password', [\App\Http\Controllers\Admin\PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('forgot-password', [\App\Http\Controllers\Admin\PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('reset-password/{token}', [\App\Http\Controllers\Admin\PasswordResetController::class, 'showResetForm'])->name('password.reset');
        Route::post('reset-password', [\App\Http\Controllers\Admin\PasswordResetController::class, 'reset'])->name('password.update');
    });

    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Resource Controllers
        Route::resource('house-types', \App\Http\Controllers\Admin\HouseTypeController::class);
        Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class);
    Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);
        
        // Real Resource Controllers for additional modules
        Route::post('galleries/reorder', [\App\Http\Controllers\Admin\GalleryController::class, 'reorder'])->name('galleries.reorder');
        Route::post('galleries/mass-destroy', [\App\Http\Controllers\Admin\GalleryController::class, 'destroyMass'])->name('galleries.mass-destroy');
        Route::resource('facilities', \App\Http\Controllers\Admin\FacilityController::class)->except('show');
        Route::resource('galleries', \App\Http\Controllers\Admin\GalleryController::class)->except('show');
        Route::resource('faqs', \App\Http\Controllers\Admin\FaqController::class)->except('show');
        Route::resource('leads', \App\Http\Controllers\Admin\LeadController::class)->except('show');
        Route::get('pengaturan', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::put('pengaturan', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
        Route::put('profil', [\App\Http\Controllers\Admin\SettingController::class, 'updateProfile'])->name('profile.update');
    });
});
