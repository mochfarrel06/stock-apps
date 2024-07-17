<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Gudang\Dashboard\GudangDashboardController;
use App\Http\Controllers\Gudang\IncomingItem\IncomingItemController;
use App\Http\Controllers\Gudang\Item\ItemController;
use App\Http\Controllers\Gudang\Item\ItemReportController;
use App\Http\Controllers\Gudang\ItemType\ItemTypeController;
use App\Http\Controllers\Gudang\OutgoingItem\OutgoingItemController;
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

    // Route Barang Keluar
    Route::resource('outgoing-item', OutgoingItemController::class);
});
