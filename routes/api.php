<?php

/** MenuController */
Route::prefix('menu')->group(function () {
    Route::get('/', 'Api\MenuController@getAll');
    Route::get('/{menu}', 'Api\MenuController@get');
});

Route::prefix('consultation')->group(function () {
    Route::post('/', 'Api\ConsultationController@store');
    Route::get('/{consultation}', 'Api\ConsultationController@get');
    Route::get('/user/{user}', 'Api\ConsultationController@findAllByUserId');
});

Route::prefix('user')->group(function () {
    Route::post('/login', 'Api\UserController@login');
    Route::post('/signup', 'Api\UserController@signUp');
    Route::post('/reset-password', 'Api\UserController@resetPassword');
    Route::post('/{user}/change-password', 'Api\UserController@changePassword');
    Route::post('/{user}', 'Api\UserController@update');
    Route::post('/{user}/upload-photo', 'Api\UserController@uploadPhoto');
});

Route::prefix('article')->group(function () {
    Route::get('/', 'Api\ArticleController@getAll');
    Route::get('/{article}', 'Api\ArticleController@get');
});