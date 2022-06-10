<?php

Route::group(['prefix' => 'v1', 'as' => 'v1.'], function () {
    include_route_files(__DIR__.'/api_actions/');
});

Route::group(['namespace' => 'App\Http\Controllers\Api\V1', 'prefix' => 'v1', 'as' => 'v1.'], function () {
    include_files_in_folder(__DIR__.'/api/');
});
