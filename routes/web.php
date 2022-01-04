<?php

use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth:sanctum', 'verified', 'isAdmin'])->group(function () {
    Route::prefix('admin/')->group(function () {
        Route::resource('user', UserController::class);
        Route::get('user-delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::resource('paket', PaketController::class);
        Route::get('all-paket', [PaketController::class, 'allPaket'])->name('paket.all');
        Route::get('paket-delete/{id}', [PaketController::class, 'destroy'])->name('paket.destroy');
        Route::get('is-active-update/{id}', [PaketController::class, 'updateIsActive'])->name('isactive.update');
        Route::resource('transaksi', TransaksiController::class);
        Route::get('transaksi-delete/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
        Route::post('transaksi-store-user', [TransaksiController::class, 'storeUser'])->name('transaksi.store.user');
        Route::put('transaksi-status-bayar/{id}', [TransaksiController::class, 'updateStatusBayar'])->name('transaksi.update.status-bayar');
        Route::put('transaksi-status-pengerjaan/{id}', [TransaksiController::class,
        'updateStatusPengerjaan'])->name('transaksi.update.status-pengerjaan');

        Route::get('export-transaksi/{id}', [TransaksiController::class, 'exportTransaksi'])->name('transaksi.export');
    });
});