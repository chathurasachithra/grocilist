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

/**
 * Admin methods
 */
Route::get('/wc-admin/all-orders', 'AdminController@getAllOrders');

Route::group(
    ['prefix' => 'api'],
    function () {

        /**
         * Application API calls
         */
        Route::post('/login', 'HomeController@postLogin');
        Route::post('/request/product', 'RequestController@postRequestProduct');
        Route::post('/request/invite-friend', 'RequestController@postInviteFriends');
        Route::post('/cart/manage-cart', 'RequestController@postUpdateCart');
        Route::post('/cart/check-out', 'RequestController@postCheckOut');

        Route::get('/test', 'RequestController@getTest');


        /**
         * Helper methods
         */
        Route::get('/create-invitations', 'HelperController@getGenerateInvitations');
    }
);
