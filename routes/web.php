<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\DashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

Route::get('/Tickets', function () {
    return Inertia::render('Tickets');
})->middleware(['auth', 'verified'])->name('Tickets');

Route::get('/Items', function () {
    return Inertia::render('Items');
})->middleware(['auth', 'verified'])->name('Items');

Route::get('/Carrency', function () {
    return Inertia::render('Carrency');
})->middleware(['auth', 'verified'])->name('Carrency');

Route::get('/Region', function () {
    return Inertia::render('Region');
})->middleware(['auth', 'verified'])->name('Region');

//config theme and imgs


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //update_theme
    Route::get('/profile/{user}/{theme_id}/theme', [ProfileController::class, 'updateTheme'])->name('profile.updateTheme');
    //update_sid_img
    Route::get('/profile/{user}/{sid_img_id}/sid_img', [ProfileController::class, 'updateSideImg'])->name('profile.updateSideImg');
    //update_avatar
    Route::get('/profile/{user}/{avatar}/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar');
});

require __DIR__.'/auth.php';
