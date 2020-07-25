<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function(){
	return redirect()->route('site.home');
});

Route::get('/shop/{type?}/{value?}','SiteController@index')->name('site.home');
Route::post('/shop/save_order','SiteController@save_order')->name('site.save_order');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::middleware(['auth'])->prefix('admin')->group(function(){

	Route::resource('users', 'UsersController');
	Route::get('/profile', 'UsersController@profile')->name('profile');
	Route::post('change-profile','UsersController@change_profile')->name('change_profile');
	Route::post('change-password','UsersController@change_password')->name('change_password');

	Route::resource('categories','CategoriesController');
	Route::resource('tags','TagsController');
	Route::resource('uoms','UomsController');
	Route::resource('products','ProductsController');
	Route::resource('orders','OrdersController');

});
