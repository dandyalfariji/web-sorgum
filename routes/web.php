<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\CompanyPageController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\FooterController;
use App\Livewire\ProductDetail;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('landingpage');
})->name('home');

Route::get('/marketplace', function() {
    return view('marketplace');
})->name('marketplace');

// Halaman detail produk menggunakan slug
Route::get('/product/{product:slug}', ProductDetail::class)->name('product.detail');

// Halaman artikel
Route::get('/artikel', function() {
    return view('artikel');
})->name('article.index');

Route::get('/artikel/{article:slug}', function(\App\Models\Article $article) {
    return view('artikel-detail', compact('article'));
})->name('article.detail');

// Sorgummi Chatbot Route
Route::post('/sorgummi/chat', [\App\Http\Controllers\SorgummiController::class, 'chat'])->name('sorgummi.chat');

// Halaman Sorgummi AI (target menu navigasi "Sorgummi AI" -> /ai)
Route::get('/ai', \App\Livewire\SorgummiAi::class)->name('sorgummi.ai');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Panel Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('articles', ArticleController::class);
    Route::patch('products/{product}/toggle', [ProductController::class, 'toggle'])->name('products.toggle');
    Route::resource('products', ProductController::class);
    Route::resource('hero-sections', HeroSectionController::class);
    Route::resource('company-pages', CompanyPageController::class);
    Route::resource('features', FeatureController::class);
    Route::resource('team-members', TeamMemberController::class);
    Route::resource('partners', PartnerController::class);
    Route::resource('headers', HeaderController::class);
    Route::resource('footers', FooterController::class);
});
