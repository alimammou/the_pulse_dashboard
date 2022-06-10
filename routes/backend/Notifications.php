<?php

use App\Enums\Lcations;

Route::group(['namespace' => 'Changes'], function () {
    Route::resource('notifications', ChangesController::class);

    Route::post('notifications/get', ChangesTableController::class)
        ->name('notifications.get');
});

