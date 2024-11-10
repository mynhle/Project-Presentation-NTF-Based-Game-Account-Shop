<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\TransactionHistoryController;
use App\Models\User;
use App\Models\Game;
use App\Models\Account;
use App\Models\Order;
use App\Models\Payment;
use App\Models\TransactionHistory;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Admin\

Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Routes cho Reports & Analytics
    // Route::prefix('reports')->name('reports.')->group(function () {
    //     Route::get('revenue', 'Admin\ReportController@revenueReport')->name('revenue'); // Báo cáo doanh thu
    //     Route::get('orders', 'Admin\ReportController@orderStatistics')->name('orders'); // Thống kê đơn hàng
    //     Route::get('accounts', 'Admin\ReportController@accountStatistics')->name('accounts'); // Thống kê tài khoản
    //     Route::get('users', 'Admin\ReportController@userAnalytics')->name('users'); // Phân tích người dùng
    // });

    // Routes cho Games
    Route::prefix('games')->name('games.')->group(function () {
        Route::get('/', [GameController::class,'index'])->name('index'); // Danh sách tài khoản
        Route::get('create', [GameController::class, 'create'])->name('create'); // Thêm tài khoản mới
        Route::post('store', [GameController::class, 'store'])->name('store'); // Lưu tài khoản mới
        Route::get('{slug}/edit', [GameController::class, 'edit'])->name('edit'); // Chỉnh sửa tài khoản
        Route::put('{slug}', [GameController::class, 'update'])->name('update');//cập nhật tài khoản
        Route::delete('{slug}', [GameController::class, 'destroy'])->name('destroy'); // Xóa tài khoản
    });

    // Route::resource('games', GameController::class);


    // Routes cho Accounts
    Route::prefix('accounts')->name('accounts.')->group(function () {
        Route::get('/', [AccountController::class,'index'])->name('index'); // Danh sách tài khoản
        Route::get('create', [AccountController::class, 'create'])->name('create'); // Thêm tài khoản mới
        Route::post('store', [AccountController::class, 'store'])->name('store'); // Lưu tài khoản mới
        Route::get('{account}/edit', [AccountController::class, 'edit'])->name('edit'); // Chỉnh sửa tài khoản
        Route::put('{account}', [AccountController::class, 'update'])->name('update'); // Cập nhật tài khoản
        Route::delete('{account}', [AccountController::class, 'destroy'])->name('destroy'); // Xóa tài khoản
    });

    // Routes cho Order Management
    // Route::prefix('orders')->name('orders.')->group(function () {
    //     Route::get('/', 'OrderController@index')->name('index'); // Danh sách đơn hàng
    //     Route::get('create', 'OrderController@create')->name('create'); // Thêm đơn hàng mới
    //     Route::post('store', 'OrderController@store')->name('store'); // Lưu đơn hàng mới
    //     Route::get('{order}/edit', 'OrderController@edit')->name('edit'); // Chỉnh sửa đơn hàng
    //     Route::put('{order}', 'OrderController@update')->name('update'); // Cập nhật đơn hàng
    //     Route::delete('{order}', 'OrderController@destroy')->name('destroy'); // Xóa đơn hàng
    //     Route::get('{order}', 'OrderController@show')->name('show'); // Xem chi tiết đơn hàng
    //     Route::put('{order}/status', 'OrderController@updateStatus')->name('updateStatus'); // Cập nhật trạng thái đơn hàng
    // });


    // Routes cho Payment Management
    // Route::prefix('payments')->name('payments.')->group(function () {
    //     Route::get('/', 'PaymentController@index')->name('index'); // Danh sách các thanh toán
    // });

    // Routes cho User Management
    // Route::prefix('users')->name('users.')->group(function () {
    //     Route::get('/', 'UserController@index')->name('index'); // Danh sách người dùng
    //     Route::get('create', 'UserController@create')->name('create'); // Thêm người dùng mới
    //     Route::post('store', 'UserController@store')->name('store'); // Lưu người dùng mới
    //     Route::get('{user}/edit', 'UserController@edit')->name('edit'); // Chỉnh sửa thông tin người dùng
    //     Route::put('{user}', 'UserController@update')->name('update'); // Cập nhật người dùng
    //     Route::delete('{user}', 'UserController@destroy')->name('destroy'); // Xóa người dùng
    //     Route::get('{user}', 'UserController@show')->name('show'); // Xem chi tiết người dùng
    // });

    // Routes cho Content Management
    // Route::prefix('content')->name('content.')->group(function () {
    //     Route::get('/', 'ContentController@index')->name('index'); // Danh sách nội dung
    //     Route::get('create', 'ContentController@create')->name('create'); // Tạo nội dung mới
    //     Route::post('store', 'ContentController@store')->name('store'); // Lưu nội dung mới
    //     Route::get('{content}/edit', 'ContentController@edit')->name('edit'); // Chỉnh sửa nội dung
    //     Route::put('{content}', 'ContentController@update')->name('update'); // Cập nhật nội dung
    //     Route::delete('{content}', 'ContentController@destroy')->name('destroy'); // Xóa nội dung
    //     Route::get('{content}', 'ContentController@show')->name('show'); // Xem chi tiết nội dung
    // });

});
