<?php

use Illuminate\Http\Request;

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
Route::get('/', function (Request $request) {
    return response()->json([ 'ok' => 200 ]);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');

Route::middleware('auth:api')->group(function () {
    Route::delete('logout', 'Auth\LoginController@logout')->name('logout');

    Route::apiResource('balance','API\Mobil\BalanceController@index')->only([ 'index', 'store']);
    Route::apiResource('transfer', 'API\Mobil\TransferController')->only(['index','store', 'show']);
    Route::apiResource('transactions', 'API\Mobil\TransferController')->only([ 'index', 'show']);
    Route::apiResource('payment', 'API/Mobil/PaymentController')->only([ 'index', 'show', 'delete', 'update']);

    Route::get('people', 'API\Mobil\PeopleController@index');

});

