<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// view screen only
Route::get(
    '/',
    function () {
        return view('index');
    }
);
Route::get(
    '/pages/create',
    function () {
        return view('pages.create');
    }
);
Route::get(
    '/pages/read',
    'Example\ReadController'
);
Route::get(
    '/pages/update',
    function () {
        return view('pages.update');
    }
);
Route::get(
    '/pages/delete',
    function () {
        return view('pages.delete');
    }
);
Route::get(
    '/pages/role',
    function () {
        return view('pages.role');
    }
)->middleware('auth');
Route::get(
    '/pages/manager/user-register',
    function () {
        return view('pages.manager.user-register');
    }
)->middleware('auth');

Route::post('/role/change', 'Auth\Role\ChangeController')
    ->middleware('auth')
    ->name('role-change');

Route::get('/pages/search-vue-component', function () {
    return view('pages.search-vue-component');
});

// use controllers

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
