<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('home');
});*/

Route::get('/', 'HomeController@getHomePage');

Route::group(
    ['prefix' => 'api'],
    function () {
        Route::get('/json-formats/success', 'HomeController@getSuccess');
        Route::get('/json-formats/validation-error', 'HomeController@getValidationError');
        Route::get('/json-formats/exception-error', 'HomeController@getExceptionError');
    }
);
