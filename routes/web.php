<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
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

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function () {
    Session::forget('user');

    return redirect('login');
});

Route::get('/adminlogout', function () {
    Session::forget('user');

    return redirect('adminlogin');
});

Route::view('/register', 'register');
Route::view('/adminlogin', 'adminlogin');
Route::view('/allorder', 'allorder');
Route::view('/category', 'category');

Route::post('/login', [UserController::class, 'login']);
Route::post('/registeruser', [UserController::class, 'register'])->name('register');
Route::get('/profile', [UserController::class, 'profile']);

Route::post('/adminlogin', [AdminController::class, 'adminlogin']);
Route::get('/alluser', [AdminController::class, 'allUser']);
Route::get('/alladmin', [AdminController::class, 'allAdmin']);
Route::get('/allproduct', [AdminController::class, 'allProduct']);

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('detail/{id}', [ProductController::class, 'detail']);
Route::get('search', [ProductController::class, 'search']);

Route::post('/alluser', [AdminController::class, 'addUser'])->name('addUser');
Route::post('/alladmin', [AdminController::class, 'addAdmin'])->name('addAdmin');
Route::get('edit-user/{id}', [AdminController::class, 'editUser'])->name('editUser');
Route::put('updateuser', [AdminController::class, 'updateUser'])->name('updateUser');
Route::delete('users/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
Route::get('edit-admin/{id}', [AdminController::class, 'editAdmin'])->name('editAdmin');
Route::put('updateadmin', [AdminController::class, 'updateAdmin'])->name('updateAdmin');
Route::delete('admins/{id}', [AdminController::class, 'deleteAdmin'])->name('deleteAdmin');

Route::delete('products/{id}', [AdminController::class, 'deleteProduct'])->name('deleteProduct');
Route::post('/allproduct', [AdminController::class, 'addProduct'])->name('addProduct');
Route::get('edit-product/{id}', [ProductController::class, 'editProduct'])->name('editProduct');
Route::put('updateproduct', [ProductController::class, 'updateProduct'])->name('updateProduct');

Route::get('/category', [CategoryController::class, 'showCat']);
Route::post('/category', [CategoryController::class, 'addCat'])->name('addCat');
Route::delete('category/{id}', [CategoryController::class, 'deleteCat'])->name('deleteCat');
Route::get('edit-cat/{id}', [CategoryController::class, 'editCat'])->name('editCat');
Route::put('updatecat', [CategoryController::class, 'updateCat'])->name('updateCat');

Route::resource('orders', OrderController::class);
Route::get('edit-status/{id}', [OrderController::class, 'editStatus'])->name('editStatus');
Route::put('updatestatus', [OrderController::class, 'updateStatus'])->name('updateStatus');
Route::get('allorder', [OrderController::class, 'showorders']);
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orderdetail/{id}', [OrderController::class, 'orderDetail']);
Route::get('/adminorderdetail/{id}', [OrderController::class, 'adminorderDetail']);
Route::get('orderlist', [OrderController::class, 'showuserOrder']);
Route::put('uploadslip', [OrderController::class, 'uploadSlip'])->name('uploadSlip');

Route::get('men', [ProductController::class, 'showMen']);
Route::get('women', [ProductController::class, 'showWomen']);
Route::get('accessory', [ProductController::class, 'showAccessory']);

Route::resource('banners', BannerController::class);

Route::get('showproduct', [ProductController::class, 'showProducts']);

Route::get('addresses/create', [AddressController::class, 'create'])->name('addresses.create');
Route::post('addresses', [AddressController::class, 'store'])->name('addresses.store');
Route::delete('addresses/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');

Route::get('/address', [AddressController::class, 'index'])->name('address');
