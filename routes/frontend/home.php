<?php

use App\Http\Controllers\Frontend\User\ResetPasswordController;
use Illuminate\Support\Facades\Route;
Route::get('/cccc', [\App\Http\Controllers\Frontend\HomeController::class,'coals'])
    ->name('dashboard1.distribution-data1111');



Route::get('/dashboard1/distribution-data', [\App\Http\Controllers\Frontend\HomeController::class,'distributionData'])
    ->name('dashboard1.distribution-data');
Route::get('/dashboard1/registration-status', [\App\Http\Controllers\Frontend\HomeController::class,'registrationStatus'])
    ->name('dashboard1.registration-status');
Route::get('/dashboard1/website-count', [\App\Http\Controllers\Frontend\HomeController::class,'websiteCount'])
    ->name('dashboard1.website-count');
Route::get('/dashboard1/financing', [\App\Http\Controllers\Frontend\HomeController::class,'financing'])
    ->name('dashboard1.financing');
Route::get('/dashboard1/starting-date', [\App\Http\Controllers\Frontend\HomeController::class,'startingDate'])
    ->name('dashboard1.starting-date');
Route::get('/dashboard3/weapons-opinion', [\App\Http\Controllers\Frontend\HomeController::class,'weaponsOpinion'])
    ->name('dashboard3.weapons-opinion');
Route::get('dashboard3/neutrality', [\App\Http\Controllers\Frontend\HomeController::class,'neutrality'])
    ->name('dashboard3.neutrality');
Route::get('dashboard3/civil-state', [\App\Http\Controllers\Frontend\HomeController::class,'civilState'])
    ->name('dashboard3.civil-state');
Route::get('dashboard3/economic-plan', [\App\Http\Controllers\Frontend\HomeController::class,'economicPlan'])
    ->name('dashboard3.economic-plan');
Route::get('/dashboard3/same-opinion/{slug}', [\App\Http\Controllers\Frontend\HomeController::class,'sameOpinion'])
    ->name('dashboard3.same-opinion');
Route::get('/dashboard3/weapons/{slug}', [\App\Http\Controllers\Frontend\HomeController::class,'individualWeapons'])
    ->name('dashboard3.weapons');
Route::get('/dashboard3/neutrality/{slug}', [\App\Http\Controllers\Frontend\HomeController::class,'IndividualNeutrality'])
    ->name('dashboard3.neutrality');
Route::get('/general-information', [\App\Http\Controllers\Frontend\HomeController::class,'index'])->name('index');
Route::get('/social-media', [\App\Http\Controllers\Frontend\HomeController::class,'social'])->name('social-media');
Route::get('/social-media/online-presence', [\App\Http\Controllers\Frontend\HomeController::class,'socialSecondPage'])
    ->name('social-media-2');








Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class,'home'])->name('home');
Route::get('/download', [\App\Http\Controllers\Frontend\HomeController::class,'download'])->name('download');

Route::get('dashboard3/decentralization', [\App\Http\Controllers\Frontend\HomeController::class,'decentralizationChart'])
    ->name('dashboard3.decentralization');

Route::get('/coalitions', [\App\Http\Controllers\Frontend\HomeController::class,'coalitions'])
    ->name('coalitions');
Route::get('/coalitions-list', [\App\Http\Controllers\Frontend\HomeController::class,'coalitionsList'])
    ->name('coalitions-list');
Route::get('/get-coalitions', [\App\Http\Controllers\Frontend\HomeController::class,'getCoalitions'])
    ->name('get-coalitions');
Route::get('/general-information/{slug}', [\App\Http\Controllers\Frontend\HomeController::class,'individual'])
    ->name('individual');
Route::get('/general-information/{slug}', [\App\Http\Controllers\Frontend\HomeController::class,'individual'])
    ->name('individual');
Route::get('/{slug}/update', [\App\Http\Controllers\Frontend\HomeController::class,'updateCso'])
    ->name('updateCso');
Route::post('/{slug}/update', [\App\Http\Controllers\Frontend\HomeController::class,'storeCso'])
    ->name('storeCso');
Route::get('/political-opinions/overall', [\App\Http\Controllers\Frontend\HomeController::class,'thirdOverall'])
    ->name('dashboard3.overall');
Route::get('/political-opinions/{slug}', [\App\Http\Controllers\Frontend\HomeController::class,'thirdIndividual'])
    ->name('dashboard3.individual');

Route::get('/fb-likes', [\App\Http\Controllers\Frontend\HomeController::class,'fblikes'])
    ->name('dashboard4.fb-likes');
Route::get('/insta-followers', [\App\Http\Controllers\Frontend\HomeController::class,'instaFollowers'])
    ->name('dashboard4.insta-followers');
Route::get('/twitter-followers', [\App\Http\Controllers\Frontend\HomeController::class,'twitterFollowers'])
    ->name('dashboard4.twitter-followers');


Route::get('/social-media-frequency', [\App\Http\Controllers\Frontend\HomeController::class,'socialMediaFrequency'])
    ->name('social-media-frequency');
Route::get('/social-media-presence', [\App\Http\Controllers\Frontend\HomeController::class,'socialMediaPresence'])
    ->name('social-media-presence');
Route::get('/social-media-score', [\App\Http\Controllers\Frontend\HomeController::class,'socialMediaScore'])
    ->name('dashboard4.social-media-score');
