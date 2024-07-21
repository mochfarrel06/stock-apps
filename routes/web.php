<?php

use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Gudang\Dashboard\GudangDashboardController;
use App\Http\Controllers\Gudang\IncomingItem\IncomingItemController;
use App\Http\Controllers\Gudang\IncomingItem\IncomingItemReportController;
use App\Http\Controllers\Gudang\Item\ItemController;
use App\Http\Controllers\Gudang\Item\ItemReportController;
use App\Http\Controllers\Gudang\ItemType\ItemTypeController;
use App\Http\Controllers\Gudang\OutgoingItem\OutgoingItemController;
use App\Http\Controllers\Gudang\OutgoingItem\OutgoingItemReportController;
use App\Http\Controllers\Gudang\Profile\ProfileController;
use App\Http\Controllers\Gudang\UnitType\UnitTypeController;
use App\Http\Controllers\Manajer\Dashboard\ManajerDashboardController;
use App\Http\Controllers\Manajer\IncomingItem\ManajerIncomingItemController;
use App\Http\Controllers\Manajer\IncomingItem\ManajerIncomingItemReportController;
use App\Http\Controllers\Manajer\Item\ManajerItemController;
use App\Http\Controllers\Manajer\Item\ManajerItemReportController;
use App\Http\Controllers\Manajer\ItemType\ManajerItemTypeController;
use App\Http\Controllers\Manajer\OutgoingItem\ManajerOutgoingItemController;
use App\Http\Controllers\Manajer\OutgoingItem\ManajerOutgoingItemReportController;
use App\Http\Controllers\Manajer\Profile\ManajerProfileController;
use App\Http\Controllers\Manajer\UnitType\ManajerUnitTypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('login', [AdminAuthController::class, 'index'])->name('login');
    Route::post('login', [AdminAuthController::class, 'store'])->name('store');
    Route::post('logout', [AdminAuthController::class, 'destroy'])->name('destroy');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::post('logout', [AuthController::class, 'destroy'])->name('logout');

Route::group(['prefix' => 'gudang', 'as' => 'gudang.', 'middleware' => ['auth', 'role:Gudang']], function () {
    // Route untuk dashboard gudang
    Route::get('dashboard', [GudangDashboardController::class, 'index'])->name('dashboard');

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

Route::group(['prefix' => 'manajer', 'as' => 'manajer.', 'middleware' => ['auth', 'role:Manajer']], function () {
    // Route Dashboard
    Route::get('dashboard', [ManajerDashboardController::class, 'index'])->name('dashboard');

    // Route untuk profile pengguna
    Route::get('profile', [ManajerProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/edit-profile', [ManajerProfileController::class, 'editProfile'])->name('profile.editProfile');
    Route::put('profile/update-profile', [ManajerProfileController::class, 'updateProfile'])->name('profile.updateProfile');
    // Route untuk password
    Route::get('profile/edit-password', [ManajerProfileController::class, 'editPassword'])->name('profile.editPassword');
    Route::put('profile/update-password', [ManajerProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    // Item
    Route::get('item', [ManajerItemController::class, 'index'])->name('item.index');
    Route::get('item/{id}/show', [ManajerItemController::class, 'show'])->name('item.show');
    Route::get('item-report', [ManajerItemReportController::class, 'index'])->name('item-report.index');
    Route::get('item-report/export', [ManajerItemReportController::class, 'exportPdf'])->name('item-report.exportPdf');
    Route::get('item-report/export-excel', [ManajerItemReportController::class, 'exportExcel'])->name('item-report.exportExcel');

    // Item Type
    Route::get('item-type', [ManajerItemTypeController::class, 'index'])->name('item-type.index');
    Route::get('item-type/{id}/show', [ManajerItemTypeController::class, 'show'])->name('item-type.show');

    // Unit Type
    Route::get('unit-type', [ManajerUnitTypeController::class, 'index'])->name('unit-type.index');
    Route::get('unit-type/{id}/show', [ManajerUnitTypeController::class, 'show'])->name('unit-type.show');

    // IncomingItem
    Route::get('incoming-item', [ManajerIncomingItemController::class, 'index'])->name('incoming-item.index');
    Route::get('incoming-item/{id}/show', [ManajerIncomingItemController::class, 'show'])->name('incoming-item.show');
    Route::get('incoming-report', [ManajerIncomingItemReportController::class, 'index'])->name('incoming-report.index');
    Route::get('incoming-report/export-pdf', [ManajerIncomingItemReportController::class, 'exportPdf'])->name('incoming-report.exportPdf');
    Route::get('incoming-report/export-excel', [ManajerIncomingItemReportController::class, 'exportExcel'])->name('incoming-report.exportExcel');

    // OutgoingItem
    Route::get('outgoing-item', [ManajerOutgoingItemController::class, 'index'])->name('outgoing-item.index');
    Route::get('outgoing-item/{id}/show', [ManajerOutgoingItemController::class, 'show'])->name('outgoing-item.show');
    Route::get('outgoing-report', [ManajerOutgoingItemReportController::class, 'index'])->name('outgoing-report.index');
    Route::get('outgoing-report/export-pdf', [ManajerOutgoingItemReportController::class, 'exportPdf'])->name('outgoing-report.exportPdf');
    Route::get('outgoing-report/export-excel', [ManajerOutgoingItemReportController::class, 'exportExcel'])->name('outgoing-report.exportExcel');
});
