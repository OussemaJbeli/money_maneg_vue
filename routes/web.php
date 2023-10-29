<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\target_limitController;
use App\Http\Controllers\Exchange_Controller;
use App\Http\Controllers\Auth\TicketsController;
use App\Http\Controllers\Auth\CarrencyController;
use App\Http\Controllers\Auth\ItemsController;
use App\Http\Controllers\Auth\IconsController;
use App\Http\Controllers\Auth\RegionController;
use App\Http\Controllers\Auth\Member_walletController;
use Illuminate\Support\Facades\Route;

// ////////////////Mywallet_user_mode
Route::get('/MyWallet', [Member_walletController::class, 'index'])
    ->name('MyWallet')
    ->middleware('auth');


////////////////dashboard
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

    Route::get('App', [DashboardController::class, 'test'])
    ->name('App')
    ->middleware('auth');

///////////////money plane limit
Route::get('/Limit', [target_limitController::class, 'index'])
    ->name('Limit')
    ->middleware('auth');

Route::get('/Limit/{user}/create_dachboard', [target_limitController::class, 'create_dachboard'])
    ->name('Limit.create_dachboard')
    ->middleware('auth');

Route::get('/Limit/{user}/create_plan_target', [target_limitController::class, 'create_plan_target'])
    ->name('Limit.create_plan_target')
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

/////////////////icons
Route::put('/Icons/create', [IconsController::class, 'create'])
    ->name('icons.create')
    ->middleware('auth');

////////////////carrency
Route::get('/Carrency', [CarrencyController::class, 'index'])
    ->name('Carrency')
    ->middleware('auth');

Route::get('/main_update/{user}/{currency}', [CarrencyController::class, 'main_update'])
    ->name('main_update')
    ->middleware('auth');

////api currency

Route::get('/Exchange_rate', [Exchange_Controller::class, 'index'])
    ->name('exchange_rate')
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
    //reset_data
    Route::get('/profile/Reset_Data', [ProfileController::class, 'Reset_Data'])->name('profile.Reset_Data');

});
