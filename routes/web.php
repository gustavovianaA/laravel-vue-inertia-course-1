<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppDashboardController;
use App\Http\Controllers\AppProductController;
use App\Http\Controllers\AppCategoryController;
use App\Http\Controllers\SitePagesController;

Route::get('/', [SitePagesController::class, 'home'])->name('myhome');
Route::get('/about', [SitePagesController::class, 'about'])->name('aboutUs');

/*
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
*/

Route::get('/app', [AppDashboardController::class, 'index'])->name('dashboard')
    ->middleware(['auth', 'verified']);

Route::prefix('app')
    ->name('app.')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        Route::resource('products', AppProductController::class);
        Route::post('/app/products/{product}', [AppProductController::class, 'update'])->name('products.update');
        Route::post('/products/search', [AppProductController::class, 'search'])->name('products.search');


        Route::resource('categories', AppCategoryController::class);
        Route::post('/categories/search', [AppCategoryController::class, 'search'])->name('categories.search');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
