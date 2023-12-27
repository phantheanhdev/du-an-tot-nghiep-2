<?php

use App\Http\Controllers\BillController;
use App\Events\HelloPusherEvent;
use App\Events\OrderEvent;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FlashSaleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\ProductVariantItemController;
use Illuminate\Support\Facades\Cookie;

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

// ========================================================= admin ====================================================

//Login
Route::middleware(['checkLogin'])->group(function () {
Route::match(['GET', 'POST'], '/login', [App\Http\Controllers\Login\LoginController::class, 'login'])->name('login');
});
Route::get('/logout', [App\Http\Controllers\Login\LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    //
    Route::get('restaurant-manager', [TableController::class, 'restaurant_manager'])->name('restaurant-manager');

    Route::get('order-of-table/{id}', [TableController::class, 'order_of_table'])->name('order-of-table');
    Route::get('getOrder/{id}', [TableController::class, 'getOrderNew']);

    Route::patch('/admin/orders/{id}/update-status', [App\Http\Controllers\TableController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::get('qr-builder', [QrController::class, 'qr_builder'])->name('qr-builder');


    // order
    Route::get('list-order', [OrderController::class, 'index']);
    Route::delete('delete-order', [OrderController::class, 'destroy'])->name('detete-order');
    Route::get('order-status', [OrderController::class, 'updateOrderStatus'])->name('order-status');
    // view invoice order
    Route::get('/invoice/{id}', [OrderController::class, 'viewInvoice'])->name('viewInvoice');
    // download FDF order
    Route::get('/invoice/{id}/generate', [OrderController::class, 'genarateInvoice'])->name('genarateInvoice');
    // print order
    Route::get('/print_order/{id}', [OrderController::class, 'print_order'])->name('print_order');
    Route::get('/order-form/{id}', [OrderController::class, 'billOrder'])->name('order-form');
    Route::get('getOrder', [OrderController::class, 'getOrder']);

    // customer
    Route::resource('/customer', CustomerController::class);
    Route::delete('/delete-customer', [CustomerController::class, 'destroy'])->name('delete-customer');
    Route::get('/show-customer/{id}', [CustomerController::class, 'showCustomer'])->name('show-customer');
    // /

    Route::get('/', [TableController::class, 'restaurant_manager'])->name('restaurant_manager');

    //changePassword
    Route::get('/change-password', [App\Http\Controllers\Login\LoginController::class, 'showForm'])->name('show.password.form');
    Route::post('/update-password', [App\Http\Controllers\Login\LoginController::class, 'updatePassword'])->name('update.password');

    Route::middleware(['checkRole'])->group(function () {
        //User
        Route::match(['GET', 'POST'], '/register', [App\Http\Controllers\Login\LoginController::class, 'register'])->name('register');
        Route::get('/showUser', [App\Http\Controllers\Login\LoginController::class, 'showUser'])->name('showUser');
        Route::get('user/delete/{id}', [App\Http\Controllers\Login\LoginController::class, 'delete'])->name('user.delete');
        Route::match(['get', 'post'], 'user/edit/{id}', [App\Http\Controllers\Login\LoginController::class, 'edit'])->name('user.edit');
        // table
        Route::resource('table', TableController::class);

        // download qr code
        Route::get('download_qr_code/{id}', [TableController::class, 'download_qr_code'])->name('download_qr_code');

        //products
        Route::get('product', [ProductController::class, 'index'])->name('product.index');
        Route::match(['GET', 'POST'], '/add', [App\Http\Controllers\ProductController::class, 'add'])->name('create');
        Route::match(['get', 'post'], '/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::get('/show-product-in-category/{id}', [ProductController::class, 'show_product_in_category'])->name('show_product_in_category');
        Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product.delete');



        //staff
        Route::prefix('staff')->group(function () {
            Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');
            Route::match(['get', 'post'], 'create', [EmployeeController::class, 'create'])->name('employee.create');
            Route::match(['get', 'post'], 'edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
            Route::get('delete/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');
        });

        //category
        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category.index');
            Route::match(['get'], 'create', [CategoryController::class, 'create'])->name('category.create');
            Route::match(['post'], 'store', [CategoryController::class, 'store'])->name('category.store');
            Route::match(['get', 'post'], 'edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
        });

        // bill
        Route::resource('order-board', BillController::class);


        //Coupon
        Route::get('coupons/change-status', [CouponController::class, 'changeStatus'])->name('coupons.change-status');
        Route::resource('coupons', CouponController::class);
        Route::delete('/delete-coupon', [CouponController::class, 'destroy'])->name('delete');

        /** Flash Sale Routes */
        Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale.index');
        Route::post('flash-sale/add-product', [FlashSaleController::class, 'addProduct'])->name('flash-sale.add-product');
        Route::get('flash-sale-status', [FlashSaleController::class, 'changeStatus'])->name('flash-sale-status');
        Route::delete('flash-sale/{id}', [FlashSaleController::class, 'destory'])->name('flash-sale.destory');
        Route::post('flash-sale/deleteAll', [FlashSaleController::class, 'deleteSelectAll'])->name('flash-sale.deleteAll');

        /** Products variant route */

        Route::resource('products-variant', ProductVariantController::class);
        /** Products variant item route */
        Route::get('products-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('products-variant-item.index');

        Route::get('products-variant-item/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('products-variant-item.create');
        Route::post('products-variant-item', [ProductVariantItemController::class, 'store'])->name('products-variant-item.store');

        Route::get('products-variant-item-edit/{variantItemId}', [ProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');

        Route::put('products-variant-item-update/{variantItemId}', [ProductVariantItemController::class, 'update'])->name('products-variant-item.update');

        Route::delete('products-variant-item/{variantItemId}', [ProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');

        /** product review routes */
        Route::get('reviews', [ReviewController::class, 'index'])->name('review.index');
        Route::delete('reviews/{id}', [ReviewController::class, 'destroy'])->name('feedback.destroy');
    });
});


// ======================================================= user ===============================================================


//  http://127.0.0.1:8000/foodie?tableId=6&tableNo=8
//  bat dau quet , nhap ten  http://127.0.0.1:8000/foodie?tableId=6&tableNo=8

Route::group(['middleware' => ['customer:customer', 'checkCustomer']], function () {
    Route::get('order/menu', [MenuController::class, 'index'])->name('order.menu');

    // Action order food
    Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart']);
    Route::delete('/remove-from-cart', [CartController::class, 'remove']);
    Route::post('/remove-cart', [CartController::class, 'clean_session']);

    Route::post('order', [CartController::class, 'order'])->name('order');
    Route::get('/get-cart', [CartController::class, 'getCart'])->name('get.cart');

    // Apply coupon
    Route::get('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
    Route::get('coupon-calculation', [CartController::class, 'couponCalculation'])->name('coupon-calculation');
    Route::get('cacel-coupon', [CartController::class, 'cencelCoupon'])->name('cencel-coupon');
    Route::post('review', [ReviewController::class, 'create'])->name('review.create');
    Route::get('filtering', [AdminDashboardController::class, 'filtering'])->name('statistical.filtering');
});

// form infor user
//  http://127.0.0.1:8000/foodie?tableId=6&tableNo=8

Route::get('/foodie', [HomeController::class, 'form_infor_user'])->name('form_infor_user')->middleware('guest:customer');


Route::post('/submit_form', [HomeController::class, 'loginUser'])->name('login.customer');
Route::post('/customer/logout', [HomeController::class, 'logout'])->name('customer.logout');


Route::get('home', [HomeController::class, 'home']);

// pusher event
Route::get('/pusher', function (Illuminate\Http\Request $request) {
    event(new HelloPusherEvent($request));
});

Route::get('/client', function (Illuminate\Http\Request $request) {
    event(new OrderEvent($request));
});
