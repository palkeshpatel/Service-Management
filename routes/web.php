<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PanelDamageController;
use App\Http\Controllers\JunctionBoxController;
use App\Http\Controllers\HotspotController;
use Illuminate\Support\Facades\Route;

// Public Service Routes
Route::get('/', [ServiceController::class, 'index'])->name('service.index');
Route::get('/service/thank-you', [ServiceController::class, 'thankYou'])->name('service.thankyou');

// Panel Damage Routes
Route::get('/service/panel-damage', [PanelDamageController::class, 'create'])->name('service.panel_damage.create');
Route::post('/service/panel-damage', [PanelDamageController::class, 'store'])->name('service.panel_damage.store');

// Junction Box Routes
Route::get('/service/junction-box', [JunctionBoxController::class, 'create'])->name('service.junction_box.create');
Route::post('/service/junction-box', [JunctionBoxController::class, 'store'])->name('service.junction_box.store');

// Hotspot Routes
Route::get('/service/hotspot', [HotspotController::class, 'create'])->name('service.hotspot.create');
Route::post('/service/hotspot', [HotspotController::class, 'store'])->name('service.hotspot.store');

// Keep old routes temporarily to prevent immediate 404s if accessed directly or cached, but redirect?
// Actually, it's better to remove them to enforce new structure as requested.


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.requests.index');
        });
        Route::get('/requests', [ServiceController::class, 'adminIndex'])->name('requests.index');
        Route::get('/requests/{id}', [ServiceController::class, 'adminShow'])->name('requests.show');
        Route::put('/requests/{id}', [ServiceController::class, 'adminUpdate'])->name('requests.update');
    });
});

require __DIR__ . '/auth.php';