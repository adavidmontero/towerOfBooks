<?php

use App\Models\Copy;
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
    return redirect()->route('login');
});

Auth::routes();

//Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:Admin|Secretary'])->group(function () {
    Route::resource('author', 'AuthorController');
    Route::resource('book', 'BookController');
    Route::resource('category', 'CategoryController');
    Route::resource('copy', 'CopyController');
    Route::resource('genre', 'GenreController');
    Route::resource('loan', 'LoanController');
    Route::put('/update_devolution/{loan}', 'LoanController@update_devolution')->name('loan.update_devolution');
    Route::resource('permission', 'PermissionController');
    Route::resource('role', 'RoleController');
    Route::resource('user', 'UserController');
    Route::get('/home', 'HomeController@index')->name('home.index');
});

Route::middleware(['auth', 'role:Reader'])->group(function () {
    Route::get('/reader', function() {
        return view('frontoffice.reader', [
            'copies' => Copy::paginate(20)->filter(function ($copy) {
                return $copy->state === 'Disponible';
            })
        ]);
    });
    Route::get('/front/loan', 'LoanController@front_index')->name('loan.front_index');
    Route::resource('profile', 'ProfileController');
    Route::get('/edit_pass/{user}/edit', 'UserController@edit_password')->name('user.edit_pass');
    Route::put('/edit_pass/{user}', 'UserController@update_password')->name('user.update_pass');
});