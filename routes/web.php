<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\UserController;

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
Route::get('/', 'UserController@dashboard')->name('dashboard') ->middleware('auth');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login-user', 'UserController@login')->name('user.login');
Route::post('/login/store', 'UserController@store')->name('user.login.store');

Route::get('/register/create', 'UserController@register')->name('user.register.store');
Route::post('/register/store', 'UserController@registerStore')->name('user.register.store');
Route::get('/user/verify/{token}', 'UserController@verifyEmail')->name('user.verifyEmail');
Route::post('users/verify', 'UserController@resend')-> name('resendEmail');





