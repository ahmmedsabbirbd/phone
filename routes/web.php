<?php

use App\Http\Controllers\LogController;
use App\Http\Controllers\OptionalController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

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

Route::controller(PhoneController::class)->group(function () {
    Route::get('/phones', 'allPhones');
    Route::get('/phones/{id}', 'phone')->whereNumber('id');
    Route::get('/phones/{id}/{fields}', 'fields')->whereIn('fields', ['brand', 'model', 'storage', 'color']);
    Route::get('/phones/{id}/photos', 'viewPhotos')->whereNumber('id');
    Route::get('/phones/{id}/download', 'downloadPhotos')->whereNumber('id');
    Route::get('/phones/{id}/cookie', 'cookie')->whereNumber('id');
    Route::get('/phones/{id}/mycookie', 'myCookie')->whereNumber('id');
    Route::get('/phones/{id}/view', 'phoneView')->whereNumber('id');


    Route::post('/phones', 'createPhone');
});

// OptionalRoute
Route::get('/optional/{name?}', [OptionalController::class, 'optionalRoute'])->whereAlpha('name');

Route::controller(LogController::class)->group(function () {
    Route::get('/log', 'log');
});

Route::controller(SessionController::class)->group(function () {
    Route::get('/session', 'saveSession');
    Route::get('/session/get', 'getSession');
    Route::get('/session/pull', 'pullSession');
    Route::get('/session/forget', 'forgetSession');
    Route::get('/session/flash', 'flashSession');
});