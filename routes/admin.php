<?php

use App\Http\Controllers\Admin\Dashboard\AdminDashboardController;
use App\Http\Controllers\Admin\IncomingItem\IncomingItemController;
use App\Http\Controllers\Admin\IncomingItem\IncomingItemReportController;
use App\Http\Controllers\Admin\Item\ItemController;
use App\Http\Controllers\Admin\Item\ItemReportController;
use App\Http\Controllers\Admin\ItemType\ItemTypeController;
use App\Http\Controllers\Admin\OutgoingItem\OutgoingItemController;
use App\Http\Controllers\Admin\OutgoingItem\OutgoingItemReportController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\UnitType\UnitTypeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'role:Administrator'], function () {
    // Route dashboard
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Route untuk profile pengguna
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/edit-profile', [ProfileController::class, 'editProfile'])->name('profile.editProfile');
    Route::put('profile/update-profile', [ProfileController::class, 'updateProfile'])->name('profile.updateProfile');
    // Route untuk password
    Route::get('profile/edit-password', [ProfileController::class, 'editPassword'])->name('profile.editPassword');
    Route::put('profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    // Route Jenis Barang
    Route::resource('item-type', ItemTypeController::class);

    // Route Satuan Barang
    Route::resource('unit-type', UnitTypeController::class);

    // Route Data Barang
    Route::resource('item', ItemController::class);
    Route::get('item-report', [ItemReportController::class, 'index'])->name('item-report.index');
    Route::get('item-report/export', [ItemReportController::class, 'exportPdf'])->name('item-report.exportPdf');
    Route::get('item-report/export-excel', [ItemReportController::class, 'exportExcel'])->name('item-report.exportExcel');

    // Route Barang Masuk
    Route::resource('incoming-item', IncomingItemController::class);
    Route::get('incoming-report', [IncomingItemReportController::class, 'index'])->name('incoming-report.index');
    Route::get('incoming-report/export-pdf', [IncomingItemReportController::class, 'exportPdf'])->name('incoming-report.exportPdf');
    Route::get('incoming-report/export-excel', [IncomingItemReportController::class, 'exportExcel'])->name('incoming-report.exportExcel');

    // Route Barang Keluar
    Route::resource('outgoing-item', OutgoingItemController::class);
    Route::get('outgoing-report', [OutgoingItemReportController::class, 'index'])->name('outgoing-report.index');
    Route::get('outgoing-report/export-pdf', [OutgoingItemReportController::class, 'exportPdf'])->name('outgoing-report.exportPdf');
    Route::get('outgoing-report/export-excel', [OutgoingItemReportController::class, 'exportExcel'])->name('outgoing-report.exportExcel');
});
