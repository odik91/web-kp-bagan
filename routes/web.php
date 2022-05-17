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
// Route::get('/menu', [App\Http\Controllers\MenuController::class, 'index'])->name('menu');
Route::resource('menu', App\Http\Controllers\MenuController::class);
// Route::get('/tambah-menu', [App\Http\Controllers\MenuController::class, 'create'])->name('tambah-menu');

Route::view('/admin', 'admin.dashboard');
Route::view('/testlogin', 'auth.loginapp')->name('masuk');
Route::view('/testregister', 'auth.registerapp')->name('daftar');
