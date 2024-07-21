<?php

use App\Http\Controllers\Admin\Dashboard\AdminDashboardController;
use App\Http\Controllers\Admin\Item\ItemController;
use App\Http\Controllers\Admin\ItemType\ItemTypeController;
use App\Http\Controllers\Admin\UnitType\UnitTypeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'role:Administrator'], function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Route Jenis Barang
    Route::resource('item-type', ItemTypeController::class);

    // Route Satuan Barang
    Route::resource('unit-type', UnitTypeController::class);

    // Route Data Barang
    Route::resource('item', ItemController::class);
});
