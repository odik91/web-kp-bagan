<?php

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

Route::get('/', function () {
    return redirect('/testlogin');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route Menu
// Route::get('/menu', [App\Http\Controllers\MenuController::class, 'index'])->name('menu');
Route::resource('menu', App\Http\Controllers\MenuController::class);
Route::get('menus/tong-sampah-menu', [App\Http\Controllers\MenuController::class, 'trash'])->name('menu.trash');
Route::get('menu/{id}/tong-sampah-menu', [App\Http\Controllers\MenuController::class, 'restore'])->name('menu.restore');
Route::delete('menu/{id}/tong-sampah-menu', [App\Http\Controllers\MenuController::class, 'delete'])->name('menu.delete');


// Route Submenu
Route::resource('submenu', App\Http\Controllers\SubmenuController::class);
Route::get('submenus/tong-sampah-submenu', [App\Http\Controllers\SubmenuController::class, 'trash'])->name('submenu.trash');
Route::get('submenu/{id}/tong-sampah-submenu', [App\Http\Controllers\SubmenuController::class, 'restore'])->name('submenu.restore');
Route::delete('submenu/{id}/tong-sampah-submenu', [App\Http\Controllers\SubmenuController::class, 'delete'])->name('submenu.delete');

Route::view('/admin', 'admin.dashboard');
Route::view('/testlogin', 'auth.loginapp')->name('masuk');
Route::view('/testregister', 'auth.registerapp')->name('daftar');
