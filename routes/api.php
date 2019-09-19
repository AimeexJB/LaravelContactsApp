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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/contacts', 'ContactController@apiIndex');
Route::get('/contacts/{id}', 'ContactController@apiShow');
Route::post('/contacts', 'ContactController@apiStore');
Route::put('/contacts/{id}', 'ContactController@apiUpdate');
Route::delete('/contacts/{id}', 'ContactController@apiDelete');

// Route::get('/contacts', 'API\ContactController@Index');
// Route::get('/contacts/{id}', 'API\ContactController@Show');
// Route::post('/contacts', 'API\ContactController@Store');
// Route::put('/contacts/{id}', 'API\ContactController@Update');
// Route::delete('/contacts/{id}', 'API/ContactController@Delete');