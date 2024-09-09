<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\Auth\CustomRegisteredUserController;

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

Route::post('/register', [CustomRegisteredUserController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('shops.index');
    Route::get('/thanks', function () {return view('auth.thanks');})->name('thanks');
    Route::post('/favorite/{shop}', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');
    Route::get('/detail/{id}', [ShopController::class, 'show'])->name('shops.show');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/done', function () {return view('done');})->name('reservations.done');
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
    Route::delete('/reservation/{id}/cancel', [MypageController::class, 'cancel'])->name('reservation.cancel');
    Route::get('/reservations/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
});