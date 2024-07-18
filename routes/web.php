<?php

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

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::post('logout', [AuthController::class, 'destroy'])->name('logout');

Route::group(['prefix' => 'gudang', 'as' => 'gudang.', 'middleware' => ['auth', 'role:Gudang']], function () {
    Route::get('dashboard', [GudangDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/edit-profile', [ProfileController::class, 'editProfile'])->name('profile.editProfile');
    Route::put('profile/update-profile', [ProfileController::class, 'updateProfile'])->name('profile.updateProfile');
    Route::get('profile/edit-password', [ProfileController::class, 'editPassword'])->name('profile.editPassword');
    Route::put('profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    // Route Jenis Barang
    Route::resource('item-type', ItemTypeController::class);

    // Route Satuan Barang
    Route::resource('unit-type', UnitTypeController::class);

    // Route Gudang
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
