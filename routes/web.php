<?php

use App\Http\Controllers\OptionalController;
use App\Http\Controllers\PhoneController;
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


    Route::post('/phones', 'createPhone');
});

// OptionalRoute
Route::get('/optional/{name?}', [OptionalController::class, 'optionalRoute'])->whereAlpha('name');