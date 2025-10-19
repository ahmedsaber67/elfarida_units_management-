<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\StatisticsController;


// ==========================
// Auth
// ==========================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');





// ==========================
// Admin only
// ==========================
Route::middleware(['auth','role:admin'])->group(function () {
    Route::resource('units', UnitController::class)->except(['show']); 
    Route::get('/units/bulk', [UnitController::class, 'bulk'])->name('units.bulk');
    Route::put('/units/bulk-update', [UnitController::class, 'bulkUpdate'])->name('units.bulk.update');
    Route::get('/units/export', [UnitController::class, 'export'])->name('units.export');
    Route::get('/units/{unit}/logs', [UnitController::class, 'logs'])->name('units.logs');
});
// ==========================
// supervisor only 
// ==========================

Route::middleware(['auth','role:supervisor,admin'])->group(function () {
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
    Route::resource('/units', UnitController::class);

});

// ==========================
// Sales (auth فقط)
// ==========================
Route::middleware(['auth','role:sales,supervisor,admin'])->group(function () {
    Route::resource('/units', UnitController::class)->only('index');
});