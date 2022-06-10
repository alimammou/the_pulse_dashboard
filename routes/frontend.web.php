<?php


use App\Http\Controllers\Frontend\User\ResetPasswordController;

Route::middleware('auth')->get('/approval', [\App\Http\Controllers\Frontend\HomeController::class,'approval'])->name('frontend.approval');
//Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {
//    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset.form');
//    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');
//});

Route::group(['as' => 'frontend.', 'middleware' => ['web']], function () {
    include_route_files(__DIR__.'/frontend/');
});
