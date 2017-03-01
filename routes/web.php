<?php

Route::get('/', 'WebsiteController@index')->name('home');
Route::get('/test', 'WebsiteController@test_form')->name('test.create');
Route::post('/test', 'WebsiteController@test')->name('test.store');

Route::get('category/{slug}', 'WebsiteController@category_detail')->name('category.detail');
Route::get('post/{slug}', 'WebsiteController@post_detail')->name('post.detail');
Route::get('tag/{slug}', 'WebsiteController@tag_detail')->name('tag.detail');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'authorized_users']], function () {
  Route::get('/', 'AdminController@index')->name('admin_home');
  // change password
  Route::get('change_password', 'UserController@change_password_form');
  Route::put('change_password', 'UserController@change_password')->name('change_password');
  Route::delete('user/delete', 'UserController@delete')->name('user.delete');
  Route::group(['middleware' => 'role', 'roles' => ['core', 'main']], function (){
    Route::resource('user', 'UserController');
    Route::resource('company', 'CompanyController');
  });

  Route::resource('post', 'PostController');
  Route::resource('category', 'CategoryController');
  Route::resource('tag', 'TagController');
  Route::delete('navigation/delete', 'NavigationController@delete')->name('navigation.delete');
  Route::resource('navigation', 'NavigationController');
});

// Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('mero_reg_ho', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('mero_reg_ho', 'Auth\RegisterController@register');
