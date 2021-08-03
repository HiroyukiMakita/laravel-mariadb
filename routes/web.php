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
    function () {
        return view('pages.read');
    }
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

// use controllers
