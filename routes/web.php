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

Route::get('/', function () {
    return view('welcome');
});

/**
 * Backend route here
 */
Route::group([ 'prefix' => "backend"], function(){

	Route::get('/login', 'Auth\LoginController@showLoginForm')->name('backend.login');
	Route::post('/login', 'Auth\LoginController@login');
	Route::post('/logout', 'Auth\LoginController@logout')->name('backend.logout');
	Route::get('/logout', 'Auth\LoginController@logout');

	Route::group(['middleware' => 'auth'], function(){

		Route::get('/', 'Admin\TemplateController@dashboard')->name('template.dashboard');

		/*templates*/
		Route::get('/template/form', 'Admin\TemplateController@form')->name('template.form');
		Route::get('/template/form-collective', 'Admin\TemplateController@formCollective')->name('template.form_collective');
		Route::get('/template/table', 'Admin\TemplateController@table')->name('template.table');

		/*configurations*/
		Route::get('/theming', 'Admin\ThemingController@index')->name('backend.theming');
		Route::get('/group', 'Admin\ConfigurationController@group')->name('backend.group');
		Route::get('/user', 'Admin\ConfigurationController@user')->name('backend.user');
		Route::get('/menu', 'Admin\ConfigurationController@menu')->name('backend.menu');
		Route::get('/permission', 'Admin\ConfigurationController@permission')->name('backend.permission');
		Route::get('/profile', 'Admin\ConfigurationController@profile')->name('backend.profile');
		Route::get('/download/{metafile}', 'Admin\AdminSevenController@download')->name('backend.download');
	});

});
