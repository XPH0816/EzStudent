<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index']);

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/register', [CustomerController::class, 'create'])->name('register');
Route::post('/register', [CustomerController::class, 'store'])->name('register.post')->middleware('xss');

Route::get('/profile', [CustomerController::class, 'index'])->name('profile');
Route::put('/updateProfile/{customer}', [CustomerController::class, 'update'])->name('update.profile');

Route::get('/forget-password', [ForgotPasswordController::class, 'forgetPassword'])->name('forget.password');
Route::post('/forget-password', [ForgotPasswordController::class, 'forgetPasswordPost'])->name('forget.password.post');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPasswordPost'])->name('reset.password.post');

//Product
Route::get('/productIndex/{category?}', [ProductController::class, 'index'])->name('productIndex');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/search', [ProductController::class, 'search'])->name('product.search');

Route::middleware(['auth:customer', 'verified'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/update-cart-quantity', [CartController::class, 'updateCartQuantity'])->name('update.cart.quantity');
    Route::post('/addToCart', [CartController::class, 'store'])->name('addToCart');
    Route::get('/addCart/success', [CartController::class, 'showCart'])->name('addCart.success');
    Route::post('/delete-cart-item', [CartController::class, 'deleteCartItem'])->name('delete.cart.item');
    Route::post('/payment', [PaymentController::class, 'index'])->name('payment');
    Route::get('/history', [OrderController::class, 'index'])->name('history');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/orderHistory', [OrderController::class, 'showOrderHistory'])->name('orderHistory');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/checkout/{customerId}', [CartController::class, 'showCheckOut'])->name('checkout');

Route::group(['middleware' => 'auth:customer'], function () {
    Route::get('/email/verify', [VerifyEmailController::class, 'index'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])->middleware('signed')->name('verification.verify');
    Route::post('/email/resend', [VerifyEmailController::class, 'resend'])->middleware('throttle:6,1')->name('verification.resend');
});

Route::get('/admin/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verifyAdmin'])->middleware('signed')->name('admin.verification.verify');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function (){
    Route::get('/email/verify', [VerifyEmailController::class, 'index'])->name('admin.verification.notice');
    Route::post('/email/resend', [VerifyEmailController::class, 'resend'])->middleware('throttle:6,1')->name('admin.verification.resend');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/adminProfile', [adminController::class, 'showProfile'])->name('adminProfile');
    Route::post('/changePassword', [adminController::class, 'changePassword'])->name('admin.changePassword');

    Route::middleware('changed')->group(function () {
        Route::get('/', [HomeController::class, 'admin'])->name('admin.home');
        Route::get('/delete-stock/{id}', [ProductController::class, 'showDestroy'])->name('admin.deleteStockPage');
        Route::delete('/delete-stock/{id}', [ProductController::class, 'destroy'])->name('admin.deleteStock');
        Route::get('/adminAddStock', [ProductController::class, 'displayAddForm'])->name('adminAddStock1'); //add stock
        Route::post('/adminAddStock', [ProductController::class, 'store'])->name('adminAddStock'); //add stock
        Route::put('/update-product/{id}', [ProductController::class, 'updateProduct'])->name('admin.updateProduct');
        Route::get('edit-product/{id}', [ProductController::class, 'edit'])->name('edit-product');
        Route::put('update-product/{id}', [ProductController::class, 'updateProduct'])->name('update-product');

        Route::get('/adminGenerateReport', [ProductController::class, 'generateReport'])->name('adminGenerateReport');

        Route::get('/adminViewMonthlyReport', [adminController::class, 'viewMonthlyReport'])->name('adminViewMonthlyReport');
        Route::get('/feedback', [adminController::class, 'getFeedback'])->name('adminGetFeedback');

        Route::get('/manageOrderHistory', [adminController::class, 'showOrderHistory'])->name('manageOrder');
        Route::get('/markDelivered/{id}', [adminController::class, 'markDelivered'])->name('admin.markDelivered');
        Route::get('/markCancelled/{id}', [adminController::class, 'markCancelled'])->name('admin.markCancelled');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'checkSuperAdminRole', 'verified']], function () {
    Route::get('/register', [adminController::class, 'create'])->name('admin.register');
    Route::post('/register', [adminController::class, 'store']);
    Route::get('/adminList', [adminController::class, 'index'])->name('adminList');
    Route::get('/adminDelete/{id}', [adminController::class, 'destroy'])->name('adminDelete');
    Route::delete('/adminDelete/{id}', [adminController::class, 'delete']);
});

Route::post('single-charge', [PaymentController::class, 'singleCharge'])->name('single.charge');
