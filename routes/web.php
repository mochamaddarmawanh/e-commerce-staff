<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ReportController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthenticationController::class, 'index'])->name('login');
    Route::post('/authenticate', [AuthenticationController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout']);
});

Route::middleware(['auth', 'not_verified'])->group(function () {
    Route::get('/verify-email', [AuthenticationController::class, 'not_verified'])->name('verification.notice');
    Route::post('/verify-resend', [AuthenticationController::class, 'resend'])->name('verification.verify');
    Route::get('/verify-resend/{id}/{hash}', [AuthenticationController::class, 'verify'])->name('verification.verify');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/verify-success', [AuthenticationController::class, 'verify_success']);
    Route::get('/dashboards', [DashboardController::class, 'index']);
    Route::resource('/users', UserController::class);

    Route::resource('/products', ProductController::class);
    Route::post('/product-delete-selected-rows', [ProductController::class, 'delete_selected_rows']);

    Route::resource('/categories', CategoryController::class)->except('show');
    Route::resource('/colors', ColorController::class)->except('show');
    Route::resource('/brands', BrandController::class)->except('show');
    Route::resource('/tags', TagController::class)->except('show');
    // Route::resource('/reports', ReportController::class);

    // Route::delete('/product-delete-selected-rows', [ProductController::class, 'delete_selected_rows'])->name('products-delete-selected-rows');
});
