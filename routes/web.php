<?php

use App\Http\Controllers\Gudang\Auth\LoginController;
use App\Http\Controllers\Gudang\Dashboard\GudangDashboardController;
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

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'store'])->name('login.store');
Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

Route::group(['prefix' => 'gudang', 'as' => 'gudang.', 'middleware' => ['auth', 'role:Gudang']], function () {
    Route::get('dashboard', [GudangDashboardController::class, 'index'])->name('dashboard');
});
