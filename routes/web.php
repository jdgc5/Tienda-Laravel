<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;
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
Auth::routes();

Route::resource('user',UserController::class);
Route::resource('admin', ProductoController::class);
Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('index');
// Route::resource('usuario',UsersController::class);



// Route::get('user/login', [UserController::class, 'processLogin'])->name('user.login');
Route::get('usera/login', [UserController::class, 'login'])->name('user.login');
Route::get('user/create', [UserController::class, 'createUser'])->name('user.create');
Route::post('usera/store', [UserController::class, 'storeUser'])->name('usera.store');
Route::post('usera/logout', [UserController::class, 'logout'])->name('usera.logout');
Route::post('user/processLogin', [UserController::class, 'processLogin'])->name('user.processLogin');



Route::get('backend/producto/view/{id}', [ProductoController::class, 'view'])-> name ('producto.view');
// Route::get('setting', [SettingController::class, 'index'])-> name ('setting.index');
// Route::put('setting', [SettingController::class, 'update'])-> name ('setting.update');
Route::get('show',[ProductoController::class, 'showAll']);