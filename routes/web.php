<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SolanaAuthController;
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

// Route::get('admin', function () {
//     return view('admin.dashboard');
// });

Route::get('login', [SolanaAuthController::class, 'login']); // Cập nhật hồ sơ cá nhân



Route::prefix('auth')->group(function () {

    // Đăng ký người dùng mới

    Route::get('/register', [RegisterController::class, 'index']); // Xử lý đăng ký
    Route::post('/register', [RegisterController::class, 'register']); // Xử lý đăng ký

    // Đăng nhập người dùng
    Route::get('/login', [LoginController::class, 'index']); // Xử lý đăng nhập
    Route::post('/login', [LoginController::class, 'login']); // Xử lý đăng nhập

    // Đăng xuất người dùng
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth'); // Đăng xuất yêu cầu đăng nhập trước
});

Route::prefix('client')->group(function () {

    // Hiển thị danh sách trò chơi cho client
    Route::get('/games', [GameController::class, 'index']); // Danh sách trò chơi
    Route::get('/games/{game}', [GameController::class, 'show']); // Chi tiết một trò chơi

    // Hiển thị danh sách tài khoản game
    Route::get('/accounts', [AccountController::class, 'index']); // Danh sách tài khoản game
    Route::get('/accounts/{account}', [AccountController::class, 'show']); // Chi tiết một tài khoản game

    // Quản lý đơn hàng của client
    Route::get('/orders', [OrderController::class, 'index']); // Danh sách đơn hàng của người dùng
    Route::get('/orders/{order}', [OrderController::class, 'show']); // Chi tiết một đơn hàng
    Route::post('/orders', [OrderController::class, 'store']); // Tạo đơn hàng mới cho người dùng

    // Quản lý thanh toán của client
    Route::get('/payments', [PaymentController::class, 'index']); // Danh sách thanh toán của người dùng
    Route::get('/payments/{payment}', [PaymentController::class, 'show']); // Chi tiết một thanh toán

    // Quản lý hồ sơ cá nhân của client
    Route::get('/profile', [UserController::class, 'show']); // Hiển thị hồ sơ cá nhân
    Route::put('/profile', [UserController::class, 'update']); // Cập nhật hồ sơ cá nhân
});



// Route::get('/games/{game}', [GameController::class, 'edit']); 




