<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotFoundController;
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

Route::get('/', [HomeController::class, 'index']);
Route::post('/', [HomeController::class, 'createUrl']);
Route::get('/notfound', [NotFoundController::class, 'index']);
Route::get('/url/clear', [HomeController::class, 'clearUrl']);


Route::get('/{alias}', [HomeController::class, 'redirect']);

