<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/user', function (){
    $user = User::find(1)->load('addresses');
    return [
        'user' => $user
    ];
});

Route::post('/test', function (){
    $id = request('id');
    if (!$id){
        return User::get();
    }
    return [User::findOrFail($id)];
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','is_admin'])->group(function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin');
    Route::get('/users', [AdminController::class, 'users'])->name('adminUsers');
    Route::get('/products', [AdminController::class, 'products'])->name('adminProducts');
    Route::post('/product/add', [AdminController::class, 'addProduct'])->name('adminAddProduct');
    Route::post('/product/edit', [AdminController::class, 'editProduct'])->name('adminEditProduct');
    Route::get('/categories', [AdminController::class, 'categories'])->name('adminCategories');
    Route::post('/categories/add', [AdminController::class, 'addCategory'])->name('adminAddCategory');
    Route::post('/categories/edit', [AdminController::class, 'editCategory'])->name('adminEditCategory');
    Route::get('/enterAsUser/{id}', [AdminController::class, 'enterAsUser'])->name('enterAsUser');
    Route::prefix('roles')->group(function (){
        Route::post('/add',[AdminController::class, 'addRole'])->name('addRole');
        Route::post('/addRoleToUser',[AdminController::class, 'addRoleToUser'])->name('addRoleToUser');
    });
    Route::get('/orders', [AdminController::class, 'orders'])->name('adminOrders');
    
    Route::post('/exportCategories', [AdminController::class, 'exportCategories'])->name('exportCategories');
    Route::post('/exportProducts', [AdminController::class, 'exportProducts'])->name('exportProducts');
    Route::post('/importCategories', [AdminController::class, 'importCategories'])->name('importCategories');
    Route::post('/importProducts', [AdminController::class, 'importProducts'])->name('importProducts');
});

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'cart'])->name('cart');
    Route::get('/info', [CartController::class, 'info']);
    Route::get('/productsQuantity', [CartController::class, 'productsQuantity']);
    Route::post('/removeFromCart', [CartController::class, 'removeFromCart'])->name('removeFromCart');
    Route::post('/addToCart', [CartController::class, 'addToCart'])->name('addToCart');
    Route::post('/createOrder', [CartController::class, 'createOrder'])->name('createOrder');
    Route::post('/retryOrder', [CartController::class, 'retryOrder'])->name('retryOrder');
});

Auth::routes();

Route::get('/getCategories', [HomeController::class, 'getCategories']);
Route::get('/category/{category}', [HomeController::class, 'category'])->name('category');
Route::get('/category/{category}/getProducts', [HomeController::class, 'getProducts']);
Route::get('/profile/{user}', [ProfileController::class, 'profile'])->name('profile');
Route::get('/profile/{user}/orders', [ProfileController::class, 'userOrders'])->name('userOrders');
Route::post('/profile/save', [ProfileController::class, 'save'])->name('saveProfile');
Route::post('/profile/setMainAddr', [ProfileController::class, 'setMainAddr'])->name('setMainAddr');
Route::post('/profile/deleteUserAddress', [ProfileController::class, 'deleteUserAddress'])->name('deleteUserAddress');