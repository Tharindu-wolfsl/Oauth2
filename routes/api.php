<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Oauth2ClientController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/oauth/token', 'Oauth2ClientController@issueToken');
Route::middleware('auth:api')->post('/create-client', 'Oauth2ClientController@registerClient');
Route::middleware('auth:api')->get('/user/get', 'UserController@getUser');
Route::get('/redirect', function () {
    $query = http_build_query([
        'client_id' => '7',
        'redirect_uri' => 'http://localhost:8000/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);
    return redirect('http://localhost:8000/oauth/authorize?'.$query);
})->name('get.token');
