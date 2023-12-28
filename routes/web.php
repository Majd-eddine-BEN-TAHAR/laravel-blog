<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Auth::routes();

// The ->name('home') part assigns a name ('home') to the route, which can be used to generate URLs or redirects to this route.
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', 'App\Http\Controllers\ProfileController@index')->name('profile.index');
    Route::put('/profile', 'App\Http\Controllers\ProfileController@update')->name('profile.update');

    Route::get('/password/change', 'App\Http\Controllers\PasswordController@showChangePasswordForm')->name('password.change');
    Route::post('/password/change', 'App\Http\Controllers\PasswordController@changePassword')->name('password.update');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin-only', function () {
        return "This is a protected admin route.";
    });

    Route::get('/admin/dashboard', 'App\Http\Controllers\AdminController@index')->name('admin.dashboard');
    Route::get('/admin/posts', 'App\Http\Controllers\AdminController@posts')->name('admin.posts');
    Route::get('/admin/categories', 'App\Http\Controllers\AdminController@categories')->name('admin.categories');
    Route::put('/admin/categories/{category}', 'App\Http\Controllers\AdminController@updateCategory')->name('admin.categories.update');
    Route::get('/admin/categories/{category}/edit', 'App\Http\Controllers\AdminController@editCategory')->name('admin.categories.edit');
    Route::post('/admin/categories', 'App\Http\Controllers\AdminController@storeCategory')->name('admin.categories.store');
    Route::delete('/admin/categories/{category}', 'App\Http\Controllers\AdminController@destroyCategory')->name('admin.categories.destroy');
    Route::get('/admin/users', 'App\Http\Controllers\AdminController@users')->name('admin.users');
    Route::get('/admin/settings', 'App\Http\Controllers\AdminController@settings')->name('admin.settings');
});
