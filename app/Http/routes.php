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
Route::get('/checkout', 'HomeController@getCheckOutPage');
Route::get('/login', 'HomeController@getLogin');

Route::group(
    ['prefix' => 'api'],
    function () {

        /**
         * Application API calls
         */
        Route::post('/request/product', 'RequestController@postRequestProduct');
        Route::post('/request/invite-friend', 'RequestController@postInviteFriends');
        Route::post('/cart/manage-cart', 'RequestController@postUpdateCart');



        /**
         * Helper methods
         */
        Route::get('/create-invitations', 'HelperController@getGenerateInvitations');
    }
);
