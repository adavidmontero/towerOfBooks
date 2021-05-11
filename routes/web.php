<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:Admin|Secretary'])->group(function () {
    Route::resource('author', 'AuthorController');
    Route::resource('book', 'BookController');
    Route::resource('category', 'CategoryController');
    Route::resource('copy', 'CopyController');
    Route::resource('genre', 'GenreController');
    Route::resource('permission', 'PermissionController');
    Route::resource('role', 'RoleController');
    Route::resource('user', 'UserController');
    Route::get('/home', 'HomeController@index')->name('home.index');
});

Route::middleware(['auth', 'role:Reader'])->group(function () {
    Route::get('/reader', function() {
        return view('frontoffice.reader');
    });
});