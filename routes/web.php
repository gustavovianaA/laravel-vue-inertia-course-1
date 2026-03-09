<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AppDashboardController;
use App\Http\Controllers\AppProductController;

Route::get('/', [FrontendController::class, 'index'])->name('myhome');
Route::get('/about', [FrontendController::class, 'about'])->name('aboutUs');
Route::inertia('/contact', 'Frontend/Contact')->name('contactUs');
Route::resource('products', ProductController::class);


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::prefix('app')->group(function () {

    Route::get('/', [AppDashboardController::class, 'index'])->name('dashboard');

    Route::resource('products', AppProductController::class);

})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
