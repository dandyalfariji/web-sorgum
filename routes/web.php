<?php

use App\Livewire\ProductDetail;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function() {
    return view('landingpage');
})->name('home');

Route::get('/marketplace', function() {
    return view('marketplace');
})->name('marketplace');

// Halaman detail produk menggunakan slug
Route::get('/product/{product:slug}', ProductDetail::class)->name('product.detail');
