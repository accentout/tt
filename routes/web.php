<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/shop', [IndexController::class,'shop'])->name('shop');
Route::get('/show/{id}', [IndexController::class,'show'])->name('show');


Route::middleware('guest')->group(function ()
{
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register/register-store', [UserController::class, 'registerStore'])->name('register.store');

    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login/login-store', [UserController::class, 'loginStore'])->name('login.store');
});

Route::middleware('auth')->group(function ()
{
    Route::get('/logout', [UserController::class,'logout'])->name('logout');

    Route::get('/create', [ProductController::class,'create'])->name('create');
    Route::post('/create-store', [ProductController::class,'createStore'])->name('create.store');

    Route::prefix('/cart')->group(function ()
    {
        Route::get('/', [CartController::class,'index'])->name('cart');
        Route::get('/add/{id}', [CartController::class,'add'])->name('cart.add');
        Route::get('/delete/{id}', [CartController::class,'delete'])->name('cart.delete');
    });
});
