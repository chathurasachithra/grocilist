<?php

namespace App\Http\Controllers;

use App\Libraries\Helper;
use App\Models\OrderModel;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AdminController extends Controller
{
    private $helper;

    /**
     * @param Helper $helper
     * @param Request $request
     */
    public function __construct(Helper $helper, Request $request)
    {
        $this->helper = $helper;
        $this->request = $request;
    }

    /**
     * Load add order details
     *
     * @return View
     */
    public function getAllOrders()
    {
        $orders = OrderModel::with('orderDetails', 'orderDetails.item')
            ->orderBy('created_at', 'DESC')
            ->where('status', '!=', 0)
            ->paginate(5);
        //return $orders;
        return view('all-orders')->with('orders',$orders);
    }


}
