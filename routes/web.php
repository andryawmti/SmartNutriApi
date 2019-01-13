<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

/** ProfileController */
Route::prefix('profile')->group(function () {
    Route::get('/', 'ProfileController@index')->name('profile');
    Route::put('/{admin}', 'ProfileController@profileUpdate')->name('profile.update');
    Route::post('/{admin}/change-password', 'ProfileController@changePassword')->name('profile.change-password');
});

/** UserController */
Route::resource('user', 'UserController');

/** Admin Controller */
Route::resource('admin', 'AdminController');
Route::get('admin/{admin}/generate-token', 'AdminController@generateToken')->name('admin.generate-token');

/** UrtController */
Route::resource('urt', 'UrtController');

/** FoodIngredientCategoryController */
Route::resource('food-ingredient-category', 'FoodIngredientCategoryController');

/** FoodIngredientController */
Route::resource('food-ingredient', 'FoodIngredientController');

/** MenuController */
Route::resource('menu', 'MenuController');