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

// Route Category
Route::resource('category', App\Http\Controllers\CategoriesController::class);
Route::get('categories/tong-sampah-kategori', [App\Http\Controllers\CategoriesController::class, 'trash'])->name('category.trash');
Route::get('category/{id}/tong-sampah-kategori', [App\Http\Controllers\CategoriesController::class, 'restore'])->name('category.restore');
Route::delete('category/{id}/tong-sampah-kategori', [App\Http\Controllers\CategoriesController::class, 'delete'])->name('category.delete');

// Route Subcategory
Route::resource('subcategory', App\Http\Controllers\SubcategoriesController::class);
Route::get('subcategories/tong-sampah-subkategori', [App\Http\Controllers\SubcategoriesController::class, 'trash'])->name('subcategory.trash');
Route::get('subcategory/{id}/tong-sampah-subkategori', [App\Http\Controllers\SubcategoriesController::class, 'restore'])->name('subcategory.restore');
Route::delete('subcategory/{id}/tong-sampah-subkategori', [App\Http\Controllers\SubcategoriesController::class, 'delete'])->name('subcategory.delete');

// Route Posts
Route::resource('post', App\Http\Controllers\PostController::class);
Route::get('postss/tong-posting-kategori', [App\Http\Controllers\PostController::class, 'trash'])->name('post.trash');
Route::get('post/{id}/tong-posting-kategori', [App\Http\Controllers\PostController::class, 'restore'])->name('post.restore');
Route::delete('post/{id}/tong-posting-kategori', [App\Http\Controllers\PostController::class, 'delete'])->name('post.delete');

Route::view('/admin', 'admin.dashboard');
Route::view('/testlogin', 'auth.loginapp')->name('masuk');
Route::view('/testregister', 'auth.registerapp')->name('daftar');
