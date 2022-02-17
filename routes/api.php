<?php

use App\Http\Controllers\Api\UserQuoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', RegisterController::class);
Route::post('login', LoginController::class);

Route::middleware('auth:api')->group(function () {
  Route::get('user/{user}/exportquotes', [UserQuoteController::class, 'export']);

  Route::resource('quotes', QuoteController::class);
  Route::resource('user.quotes', UserQuoteController::class);

});


