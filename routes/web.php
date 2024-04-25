<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\IngridentController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\OrdersController;
use App\Http\Controllers\Web\PaymentController as WebPaymentController;
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

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'guest:admin'], function () {
        Route::get('login', [AuthController::class, 'index'])->name('login');

        Route::post('login-check', [AuthController::class, 'loginCheck'])->name('admin.login-check');
    });

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/customers', [DashboardController::class, 'index'])->name('admin.customers');
        Route::get('/users', [DashboardController::class, 'users'])->name('admin.users');
        Route::get('/registration', [DashboardController::class, 'registration'])->name('user.registration.view');
        Route::post('/registration-save', [DashboardController::class, 'registrationSubmit'])->name('admin.registration');

        Route::get('shop/index', [ShopController::class, 'index'])->name('shops.index');

        Route::post('shops/store', [ShopController::class, 'store'])->name('shop.store');

        Route::post('shops/edit/{id}', [ShopController::class, 'edit'])->name('shop.edit');

        Route::post('shops/update/{id}', [ShopController::class, 'update'])->name('shop.update');

        Route::post('shops/delete/{id}', [ShopController::class, 'destroy'])->name('shop.delete');

        // start vijay for admin
        Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');
        Route::get('/showData/{id}', [OrderController::class, 'showData'])->name('admin.showData');
        Route::get('/update/status/{id}', [OrderController::class, 'updateStatus'])->name('admin.update.status');

        Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
        Route::post('/add-category', [CategoryController::class, 'addNewCategory'])->name('admin.addNewCategory');
        Route::post('/category-status', [CategoryController::class, 'categoryStatus'])->name('admin.category-status');
        Route::post('/get-data', [CategoryController::class, 'getData'])->name('admin.get-data');
        Route::post('/category-update', [CategoryController::class, 'categoryUpdate'])->name('admin.category-update');

        Route::get('/items', [ItemController::class, 'index'])->name('admin.items');
        Route::post('/items-table', [ItemController::class, 'itemsTable'])->name('admin.itemsTable');
        Route::post('/item-status', [ItemController::class, 'itemStatus'])->name('admin.item-status');
        Route::post('/add-item', [ItemController::class, 'addNewItem'])->name('admin.addNewItem');
        Route::post('/update-item', [ItemController::class, 'updateItem'])->name('admin.updateItem');
        Route::get('/update-item/{id}', [ItemController::class, 'getItemForUpdate'])->name('admin.getItemForUpdate');

        Route::get('/ingredients', [IngridentController::class, 'index'])->name('admin.ingredients');
        Route::get('/ingredients-data', [IngridentController::class, 'ingredientTable'])->name('admin.ingredientTable');
        Route::post('/add-ingredients', [IngridentController::class, 'addIngredients'])->name('admin.addIngredients');
    });
});

//----------------------------  Client Side Routes  -----------------------------------------------
Route::get('/', [HomeController::class, 'index']);

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('user.log.out');
});

Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('user.login');

Route::post('/ordering', [OrdersController::class, 'ordering'])->name('ordering');
Route::post('/delivery-setup', [OrdersController::class, 'deliverySetup'])->name('delivery-setup');
Route::post('/pickup-setup', [OrdersController::class, 'pickupSetup'])->name('pickup-setup');
Route::post('/getPizzaDetails', [OrdersController::class, 'getPizzaDetails'])->name('getPizzaDetails');
Route::post('/add-to-cart', [OrdersController::class, 'addToCart'])->name('add-to-cart');
Route::post('/get-cart', [OrdersController::class, 'cart'])->name('get-cart');
Route::get('/order/{slug}', [OrdersController::class, 'index'])->name('user.order.index');
Route::get('/cart/item', [OrdersController::class, 'removeCartItem'])->name('user.cart.item.remove');

Route::post('/payment', [WebPaymentController::class, 'generatePaymentLink'])->name('payment.link');
Route::get('/checkout', [WebPaymentController::class, 'checkout'])->name('payment.checkout');
Route::post('/order-save', [WebPaymentController::class, 'orderSave'])->name('order.save');

Route::get('/success', [WebPaymentController::class, 'success'])->name('payment.success');


Route::get('/about', function () {
    return view('web.about');
})->name('about');

Route::get('/contact', function () {
    return view('web.contact');
})->name('contact');

Route::get('/community', function () {
    return view('web.community');
})->name('community');

Route::get('/location', function () {
    return view('web.locations');
})->name('location');
