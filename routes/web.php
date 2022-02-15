<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','is_admin'])->group(function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin');
    Route::get('/users', [AdminController::class, 'users'])->name('adminUsers');
    Route::get('/products', [AdminController::class, 'products'])->name('adminProducts');
    Route::get('/categories', [AdminController::class, 'categories'])->name('adminCategories');
    Route::post('/categories/add', [AdminController::class, 'addCategory'])->name('adminAddCategory');
    Route::get('/enterAsUser/{id}', [AdminController::class, 'enterAsUser'])->name('enterAsUser');
    Route::prefix('roles')->group(function (){
        Route::post('/add',[AdminController::class, 'addRole'])->name('addRole');
        Route::post('/addRoleToUser',[AdminController::class, 'addRoleToUser'])->name('addRoleToUser');
    });
    Route::get('/orders', [AdminController::class, 'orders'])->name('adminOrders');
    
    Route::post('/exportCategories', [AdminController::class, 'exportCategories'])->name('exportCategories');
});

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'cart'])->name('cart');
    Route::post('/removeFromCart', [CartController::class, 'removeFromCart'])->name('removeFromCart');
    Route::post('/addToCart', [CartController::class, 'addToCart'])->name('addToCart');
    Route::post('/createOrder', [CartController::class, 'createOrder'])->name('createOrder');
});

Auth::routes();

Route::get('/category/{category}', [HomeController::class, 'category'])->name('category');
Route::get('/profile/{user}', [ProfileController::class, 'profile'])->name('profile');
Route::get('/profile/{user}/orders', [ProfileController::class, 'userOrders'])->name('userOrders');
Route::post('/profile/save', [ProfileController::class, 'save'])->name('saveProfile');
Route::post('/profile/setMainAddr', [ProfileController::class, 'setMainAddr'])->name('setMainAddr');
Route::post('/profile/deleteUserAddress', [ProfileController::class, 'deleteUserAddress'])->name('deleteUserAddress');