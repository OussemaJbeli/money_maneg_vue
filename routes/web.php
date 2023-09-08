<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\FlashedDataController;
use App\Http\Controllers\Auth\TicketsController;
use App\Http\Controllers\Auth\CarrencyController;
use App\Http\Controllers\Auth\ItemsController;
use App\Http\Controllers\Auth\RegionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

/////////////// tickets
Route::get('/Tickets', [TicketsController::class, 'index'])
    ->name('Tickets')
    ->middleware('auth');

Route::post('/Tickets/{user}', [TicketsController::class, 'store'])
    ->name('Tickets.store')
    ->middleware('auth');

Route::get('/Tickets/{Ticket}/show', [TicketsController::class, 'show'])
    ->name('Tickets.show')
    ->middleware('auth');

Route::get('/Tickets/{item}/delete', [TicketsController::class, 'destroy'])
    ->name('Tickets.destroy')
    ->middleware('auth');

////////////////items
Route::get('/Items', [ItemsController::class, 'index'])
    ->name('Items')
    ->middleware('auth');

Route::post('/Items/{user}', [ItemsController::class, 'store'])
    ->name('items.store')
    ->middleware('auth');

Route::put('/Items/{item}/update', [ItemsController::class, 'update'])
    ->name('items.edit')
    ->middleware('auth');

Route::get('/Items/{item}/delete', [ItemsController::class, 'destroy'])
    ->name('items.destroy')
    ->middleware('auth');

Route::get('/Items/{tickets}/edit', [ItemsController::class, 'edit'])
    ->name('items.destroy')
    ->middleware('auth');

////////////////carrency
Route::get('/Carrency', [CarrencyController::class, 'index'])
    ->name('Carrency')
    ->middleware('auth');

////////////////region
Route::get('/Region', [RegionController::class, 'index'])
    ->name('Region')
    ->middleware('auth');

Route::put('/Region/store', [RegionController::class, 'store'])
    ->name('Region.store')
    ->middleware('auth');


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
