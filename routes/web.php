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
    Route::get('/generate-token', 'ProfileController@generateToken')->name('profile.generate-token');
    Route::post('/upload-photo', 'AdminController@uploadPhoto')->name('profile.upload-photo');
});

/** UserController */
Route::resource('user', 'UserController');
Route::post('user/upload-photo', 'UserController@uploadPhoto')->name('user.upload-photo');

/** Admin Controller */
Route::resource('admin', 'AdminController');
Route::get('admin/{admin}/generate-token', 'AdminController@generateToken')->name('admin.generate-token');
Route::post('admin/upload-photo', 'AdminController@uploadPhoto')->name('admin.upload-photo');

/** UrtController */
Route::resource('urt', 'UrtController');

/** FoodIngredientCategoryController */
Route::resource('food-ingredient-category', 'FoodIngredientCategoryController');

/** FoodIngredientController */
Route::resource('food-ingredient', 'FoodIngredientController');

/** MenuController */
Route::resource('menu', 'MenuController');

/** ArticleController */
Route::resource('article', 'ArticleController');
Route::post('article/upload-photo', 'ArticleController@uploadPhoto')->name('article.upload-photo');

/** ConsultationController */
Route::resource('consultation', 'ConsultationController');