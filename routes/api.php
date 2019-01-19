<?php

/** MenuController */
Route::prefix('menu')->group(function () {
    Route::get('/', 'Api\MenuController@getAll');
    Route::get('/{menu}', 'Api\MenuController@get');
});

Route::prefix('consultation')->group(function () {
    Route::post('/', 'Api\ConsultationController@store');
    Route::post('/calculate', 'Api\ConsultationController@calculateWithCooper');
    Route::get('/user/{user}', 'Api\ConsultationController@findAllByUserId');
});

Route::prefix('user')->group(function () {
    Route::post('/login', 'Api\UserController@login');
    Route::post('/{user}', 'Api\UserController@update');
    Route::post('/{user}/upload-photo', 'Api\UserController@uploadPhoto');
});