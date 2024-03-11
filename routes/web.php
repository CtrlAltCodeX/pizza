<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\IngridentController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\OrdersController;
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
        Route::get('/orders', [DashboardController::class, 'index'])->name('admin.orders');

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

Route::get('/', function () {
    return view('web.index');
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
