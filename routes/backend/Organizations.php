<?php

use App\Enums\Lcations;

Route::group(['namespace' => 'Organizations'], function () {
    Route::resource('organizations', 'OrganizationsController', ['except' => ['show']]);

    Route::post('organizations/get', 'OrganizationsTableController')
        ->name('organizations.get');
    Route::get('organizations/{id}/coalitions', 'OrganizationsController@coalitions')
        ->name('organizations.get-coalitions');

    Route::get('connection/{id}', 'OrganizationsController@deleteConnection')
        ->name('organizations.delete-coalitions');

    Route::post('organizations/{id}/coalitions', 'OrganizationsController@addCoalition')
        ->name('organizations.create-coalitions');
});
//Route::get('/xlsx',function (){
//    ddd(DB::connection());
//    Excel::import(new \App\Imports\OrganizationImport(), 'file.xlsx');
//ddd('success');
//});
//Route::get('/casa',function (){
//$l=Lcations::asArray();
//$organzations=App\Models\Organization\Organization::all();
//foreach ($organzations as $organzation)
//{
//    $organzation->location=array_rand($l);
//    $organzation->save();
//}
//ddd("success");
//});
