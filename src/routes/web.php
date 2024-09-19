<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StoreRepresentativeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
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

Route::get('/register', function () {return view('auth.register');})->name('register');
Route::post('/register', [RegisterController::class, 'create'])->name('register.store');
// Route::post('/login', [LoginController::class, 'login'])->name('login');

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
    Route::get('reviews/create/{shop}', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/store', [StoreController::class, 'index'])->name('store.dashboard');
});

Route::middleware(['auth', 'checkRole:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/store-representatives/create', [AdminController::class, 'create'])->name('admin.store-representatives.create');
    Route::post('/admin/store-representatives', [AdminController::class, 'store'])->name('admin.store-representatives.store');
});
Route::middleware(['auth', 'checkRole:store_representative'])->group(function () {
    Route::resource('/store', StoreController::class);
    Route::get('/store', [StoreController::class, 'index'])->name('store.index');
    Route::post('/store', [StoreController::class, 'store'])->name('store.store');
    Route::get('/store/reservations', [StoreController::class, 'reservations']);
    Route::get('/store/create', [StoreController::class, 'create'])->name('store.create');
    Route::get('/store/{shop}/edit', [StoreController::class, 'edit'])->name('store.edit');
    Route::put('/store/{shop}/edit', [StoreController::class, 'update'])->name('store.update');
});
