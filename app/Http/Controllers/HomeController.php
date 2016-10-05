<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\View;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class HomeController extends Controller
{

    public function __construct()
    {

    }


    public function getHomePage()
    {
        return view('home');
        //return view('greeting', ['name' => 'James']);
    }

    public function getCheckOutPage()
    {
        return view('checkout');
    }
}
