<?php

/*
  |--------------------------------------------------------------------------
  | Routes File
  |--------------------------------------------------------------------------
  |
  | Here is where you will register all of the routes in an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', 'WelcomeController@getIndex');

Route::get('/home', 'HomeController@index');
Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | This route group applies the "web" middleware group to every route
  | it contains. The "web" middleware group is defined in your HTTP
  | kernel and includes session state, CSRF protection, and more.
  |
 */

Route::group(['middleware' => 'api', 'namespace' => 'Api', 'prefix' => 'api'], function() {
    Route::resource('/user', 'UserController');
    Route::resource('/login', 'DefaultController');
});

Route::group(['middleware' => ['web'], 'namespace' => 'Customer', 'prefix' => 'customer'], function () {
    Route::get('/', 'DefaultController@index');
    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');
    Route::get('logout', 'AuthController@logout');
    Route::get('register', 'AuthController@getRegister');
    Route::post('register', 'AuthController@postRegister');
    Route::get('oauth', 'DefaultController@oauth');
});

Route::group(['middleware' => ['web'], 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
    
    Route::get('/', 'DefaultController@index');
    
    Route::get('resource', 'ResourceController@getIndex');
    
    Route::get('login', 'AuthController@showLoginForm');
    Route::post('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout');
    
    Route::get('form/design', 'FormController@getDesign');
    Route::post('form/design', 'FormController@postDesign');
    Route::get('form/preview', 'FormController@getPreview');
    Route::get('form/submit', 'FormController@getSubmit');
    Route::post('form/submit', 'FormController@postSubmit');
    
    Route::get('flow/design', 'FlowController@getDesign');
    Route::post('flow/design', 'FlowController@postDesign');
    
    Route::get('flow/draw', 'FlowController@getDraw');
    Route::post('flow/draw', 'FlowController@postDraw');
    Route::post('flow/process', 'FlowController@postProcess');
    Route::get('flow/attribute', 'FlowController@getAttribute');
    Route::get('flow/save_attribute', 'FlowController@postSaveAttribute');
});

