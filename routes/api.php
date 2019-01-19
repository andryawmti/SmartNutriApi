<?php

/** MenuController */
Route::prefix('menu')->group(function () {
    Route::get('/', 'Api\MenuController@getAll');
    Route::get('/{menu}', 'Api\MenuController@get');
});

Route::prefix('consultation')->group(function () {
    Route::post('/calculate', 'Api\ConsultationController@calculateWithCooper');
    Route::get('/user/{user}', 'Api\ConsultationController@findAllByUserId');
});