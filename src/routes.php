<?php 
	
Route::group(['middleware' => ['web']], function() {
	
	Route::get('/', function () {
	    if(Auth::check()) {
	    	return redirect()->route('dashboard');
	    }
	    return redirect()->route('login.show');
	});

	Route::get('login', [
		'uses' => 'Esheinc\AuthPackage\Controllers\AdminController@showLoginForm',
		'as' => 'login.show'
	]);

	Route::post('login', [
		'uses' => 'Esheinc\AuthPackage\Controllers\AdminController@login',
		'as' => 'login.post'
	]);

	Route::get('logout', [
		'uses' => 'Esheinc\AuthPackage\Controllers\AdminController@logout',
		'as' => 'logout'
	]);

	Route::get('register', [
		'uses' => 'Esheinc\AuthPackage\Controllers\AdminController@showRegisterForm',
		'as' => 'register.show'
	]);

	Route::get('dashboard', [
		'uses' => 'Esheinc\AuthPackage\Controllers\PageController@index',
		'as' => 'dashboard'
	]);

});





