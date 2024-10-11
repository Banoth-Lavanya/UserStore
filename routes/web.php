<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;

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

Route::get('/', function () {
    return view('users.register');
});


Route::get('register', function () {
    return view('users.register');
})->name('register');
Route::post('register', [UserController::class, 'register']);
Route::get('login', function () {
    return view('users.login');
})->name('login');

Route::post('login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
// Protected routes for authenticated users
Route::middleware(['auth.session'])->group(function () {
    Route::get('products', [StoreController::class, 'index'])->name('products.index');
    Route::get('products/create', [StoreController::class, 'create'])->name('products.create');
    Route::post('products', [StoreController::class, 'store'])->name('products.store');
    Route::get('products/{id}', [StoreController::class, 'show'])->name('products.show');
    Route::delete('products/{id}', [StoreController::class, 'destroy'])->name('products.destroy');
    Route::get('profile', [UserController::class, 'getProfile'])->name('profile.show');
    Route::get('admin/customers', [UserController::class, 'listCustomers'])->name('admin.customers');
    // Update profile route
    
    Route::get('profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::post('profile/updateProfile', [UserController::class, 'updateProfile'])->name('profile.update');    
    Route::get('products/manage', [StoreController::class, 'manage'])->name('products.manage');
});

Route::middleware(['auth.session', 'admin'])->group(function () {
    Route::get('products/{id}/edit', [StoreController::class, 'edit'])->name('products.edit');
});



//Route::post('/logout', [UserController::class, 'logout']);
