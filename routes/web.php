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

Route::get('/', 'Frontend\HomeController@index')->name('home');
Route::get('/documentation', function () {
    abort('404');
});
Route::post('/documentation', 'Frontend\HomeController@getDocumentation')->name('documentation');

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
		Route::get('/configuration', 'Admin\ConfigurationController@config')->name('backend.config');
		Route::get('/group', 'Admin\ConfigurationController@group')->name('backend.group');
		Route::get('/user', 'Admin\ConfigurationController@user')->name('backend.user');
		Route::get('/menu', 'Admin\ConfigurationController@menu')->name('backend.menu');
		Route::get('/permission', 'Admin\ConfigurationController@permission')->name('backend.permission');
		Route::get('/profile', 'Admin\ConfigurationController@profile')->name('backend.profile');
		Route::get('/download/{metafile}', 'Admin\AdminSevenController@download')->name('backend.download');

		/*creator*/
		Route::get('/creator', 'Admin\AdminSevenController@creator')->name('backend.creator');
		Route::get('/creator/new', 'Admin\AdminSevenController@newCreator')->name('backend.new.creator');
		Route::get('/creator/edit/{id}', 'Admin\AdminSevenController@editCreator')->name('backend.edit.creator');

		/*show creator*/
		Route::get('{crud_slug}/creator', 'Admin\AdminSevenController@makeCreator')->name('backend.creator.make');

		/*documentation*/
		Route::get('/documentation', 'Admin\AdminSevenController@documentation')->name('backend.documentation');
		Route::get('/documentation/{documentation}/editor', 'Admin\AdminSevenController@editDocumentation')->name('backend.documentation.editor');
		Route::post('/documentation/{documentation}/save', 'Admin\AdminSevenController@saveDocumentation')->name('backend.documentation.save');
	});

});
