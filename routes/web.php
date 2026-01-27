<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// Public Service Routes
Route::get('/', [ServiceController::class, 'index'])->name('service.index');
Route::get('/service/{type}', [ServiceController::class, 'showForm'])->name('service.form');
Route::post('/service', [ServiceController::class, 'store'])->name('service.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/requests', [ServiceController::class, 'adminIndex'])->name('requests.index');
        Route::get('/requests/{id}', [ServiceController::class, 'adminShow'])->name('requests.show');
        Route::put('/requests/{id}', [ServiceController::class, 'adminUpdate'])->name('requests.update');
    });
});

require __DIR__.'/auth.php';
