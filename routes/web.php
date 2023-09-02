<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\ConfigController;
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

Route::get('/Config', [ConfigController::class, 'index'])->name('config.index')->middleware('auth');
Route::get('/Config/create', [ConfigController::class, 'create'])->name('config.create')->middleware('auth');
Route::get('/Config/Config', [ConfigController::class, 'update'])->name('config.update')->middleware('auth');
Route::get('/Config/store', [ConfigController::class, 'store'])->name('config.store')->middleware('auth');
Route::get('/Config/icons', [ConfigController::class, 'icons_get'])->name('config.icons_get')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
