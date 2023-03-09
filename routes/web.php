<?php

use Illuminate\Support\Facades\Auth;

 use Illuminate\Support\Facades\Route;

 use App\Http\Controllers\HomeController;
 use App\Http\Controllers\RoleController;
 use App\Http\Controllers\UserController;
 use App\Http\Controllers\ProductController;

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
     return view('welcome');
 });

 Auth::routes();
 Route::get('/home', [HomeController::class, 'index'])->name('home');

 Route::group(['middleware' => ['auth']], function() {

     Route::get('products', [ProductController::class,'index'])->name('products.index');
     Route::get('products/create', [ProductController::class,'create'])->name('products.create');
     Route::get('products/edit/{id}', [ProductController::class,'edit'])->name('products.edit');
     Route::get('products/show/{id}', [ProductController::class,'show'])->name('products.show');
     Route::get('products/delete/{id}', [ProductController::class,'destroy'])->name('products.destroy');
     //Users
     Route::get('users', [UserController::class,'index'])->name('users.index');
     Route::get('users/create', [UserController::class,'create'])->name('users.create');
     Route::post('users/create', [UserController::class,'store'])->name('users.store');
     Route::get('users/edit/{id}', [UserController::class,'edit'])->name('users.edit');
     Route::get('users/show/{id}', [UserController::class,'show'])->name('users.show');
     Route::get('users/delete/{id}', [UserController::class,'destroy'])->name('users.destroy');
     //Roles
     Route::get('roles', [RoleController::class,'index'])->name('roles.index');
     Route::get('roles/create', [RoleController::class,'create'])->name('roles.create');
     Route::get('roles/edit/{id}', [RoleController::class,'edit'])->name('roles.edit');
     Route::get('roles/show/{id}', [RoleController::class,'show'])->name('roles.show');
     Route::get('roles/delete/{id}', [RoleController::class,'destroy'])->name('roles.destroy');

 });
