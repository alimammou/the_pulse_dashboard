<?php


Route::group(['namespace' => 'Coalitions'], function () {
    Route::resource('coalitions', 'CoalitionsController', ['except' => ['show']]);

    Route::post('coalitions/get', 'CoalitionsTableController')
        ->name('coalitions.get');
});
