<?php

use App\Http\Controllers\PhoneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(PhoneController::class)->group(function () {
    Route::get('/phones', 'allPhones');
    Route::get('/phones/{id}', 'phone')->whereNumber('id');
    Route::get('/phones/{id}/{fields}', 'fields')->whereIn('fields', ['brand', 'model', 'storage', 'color']);


    Route::post('/phones', 'createPhone');
});

// OptionalRoute
Route::get('/optional/{name?}', [OptionalController::class, 'optionalRoute'])->whereAlpha('name');