<?php

use Illuminate\Http\Request;

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/sign-up', 'AuthController@signUp');
        Route::post('/sign-in', 'AuthController@signIn');
    });
    Route::group(['prefix' => 'users', 'middleware' => 'jwt.auth'], function () {
        Route::get('/all-members', 'UserController@getAllOtherUsers');
    });
    Route::group(['prefix' => 'chat', 'middleware' => 'jwt.auth'], function () {
        Route::post('/', 'ChatController@sendMessage');
        Route::get('/messages/{sender_id}', 'ChatController@getAllMessagesFrom');
    });
});
