<?php

Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('logout', 'AuthController@logout');
        Route::get('me', 'AuthController@me');
    });
});
