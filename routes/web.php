<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Transaction;
use Illuminate\Database\Events\TransactionCommitted;
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

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);

    Route::post('/addToCart', [ProductController::class, 'addToCart']);
    Route::delete('/deleteCart/{id}', [ProductController::class, 'deleteCart'])->name('cart.destroy');

    Route::post('/transaction.start', [TransactionController::class, 'start'])->name('transaction.start');
    Route::post('/transaction.start.now.{id}', [TransactionController::class, 'startNow'])->name('transaction.start.now');

    Route::get('/transaksi-detail', [TransactionController::class, 'detail'])->name('transaction.detail');
    Route::get('/transaksi-detail-now', [TransactionController::class, 'detailNow'])->name('transaction.detail.now');

    Route::delete('/cancelTransaction/{code}', [TransactionController::class, 'cancelTransaction'])->name('cancel.transaction');

    Route::post('/transaction.order', [TransactionController::class, 'order'])->name('transaction.order');
    Route::post('/transaction.order.now', [TransactionController::class, 'orderNow'])->name('transaction.order.now');



    // GET DATA TRANSACTION
    Route::get('/transaksi', [TransactionController::class, 'transactionIndex']);
    Route::prefix('/transaksi')->group(function () {
        Route::get('/belum-bayar/{code}', [TransactionController::class, 'belumBayarDetail']);
        Route::get('/diproses/{code}', [TransactionController::class, 'diprosesDetail']);


        Route::get('/dikirim/{code}', [TransactionController::class, 'dikirimDetail']);
        Route::post('transaction.done.{code}', [TransactionController::class, 'transactionDone'])->name('transaction.done');

        Route::get('/selesai/{code}', [TransactionController::class, 'selesaiDetail']);
    });




    Route::middleware('only_admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard']);

        Route::prefix('transaksi')->group(function () {
            Route::get('/belum-bayar', [AdminController::class, 'belumBayar']);
            Route::post('transaction.process.{code}', [AdminController::class, 'transactionProcess'])->name('transaction.process');

            Route::get('/diproses', [AdminController::class, 'diproses']);
            Route::post('transaction.send.{code}', [AdminController::class, 'transactionSend'])->name('transaction.send');

            Route::get('/dikirim', [AdminController::class, 'dikirim']);



            Route::get('/selesai', [AdminController::class, 'selesai']);


        });
    });
});
