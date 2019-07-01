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

Route::get('/', function (Request $request) { return response()->json([ 'ok' => 200 ]); });

Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');

Route::middleware('auth:api')->group(function () {
    Route::delete('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('directories', 'API\Mobil\UserController@index');
    Route::apiResource('balance','API\Mobil\BalanceController')->only([ 'index', 'store']);
    Route::group(['where'  => ['transfer' => '[0-9]+']], function () {
	    Route::apiResource('transfer', 'API\Mobil\TransferController')->only(['index','store', 'show']);
	    Route::get('transfer/validate-code', 'API\Mobil\TransferController@validateCode');
    });
    Route::apiResource('transactions', 'API\Mobil\TransferController')->only([ 'index', 'show']);
    Route::apiResource('payments', 'API\Mobil\PaymentController')->only([ 'index', 'show', 'delete', 'update']);
    Route::get('people', 'API\Mobil\PeopleController@index');
});


