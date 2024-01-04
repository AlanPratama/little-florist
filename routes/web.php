<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Psy\Readline\Hoa\Autocompleter;

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

Route::get('/login', [AuthController::class, 'loginIndex'])->name('loginIndex');
Route::post('/loginProcess', [AuthController::class, 'loginProcess'])->name('loginProcess');

Route::get('/register', [AuthController::class, 'registerIndex'])->name('registerIndex');
Route::post('/registerProcess', [AuthController::class, 'registerProcess'])->name('registerProcess');

Route::get('/', [UserController::class, 'homepage']);

Route::get('/produk', [ProductController::class, 'productsIndex']);
Route::get('/produk/{slug}', [ProductController::class, 'detailProduct']);

Route::middleware('auth')->group(function() {
    Route::get('logout', [AuthController::class, 'logout']);

    Route::post('/addToCart', [ProductController::class, 'addToCart']);


});
