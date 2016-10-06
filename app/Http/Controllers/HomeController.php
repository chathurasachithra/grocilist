<?php

namespace App\Http\Controllers;

use App\Libraries\Helper;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class HomeController extends Controller
{
    private $helper;

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Load home page with required data
     *
     * @return View
     */
    public function getHomePage()
    {
        $items = DB::table('trn_items')
            ->select('unit_value', 'price', 'name', 'image', 'id', 'description')
            ->where('status', 1)
            ->get();

        $user = DB::table('trn_user')
            ->select('id', 'name', 'email')
            ->where('id', 1)
            ->first();

        $order = DB::table('trn_order')
            ->select('id', 'total')
            ->where('id', 1)
            ->first();
        if (isset($order->id)) {
            $orderDetails = DB::table('trn_order_details')
                ->select('id', 'order_id', 'item_id', 'quantity', 'unit_price')
                ->where('order_id', $order->id)
                ->get();
            $order->details = $orderDetails;
        }
        return view('home', [
            'items' => json_encode($items),
            'user_type' => 1,
            'token' => 'F4245DGSG6477SFR35366',
            'user' => json_encode($user),
            'cart' => json_encode($order)]);
    }

    public function getCheckOutPage()
    {
        return view('checkout');
    }

    public function getSuccess()
    {
        return $this->helper->response(200, ['data' => [], 'message' => 'sucess message']);
    }

    public function getValidationError()
    {
        return $this->helper->response(400, ['message' => 'Error message']);
    }

    public function getExceptionError()
    {
        return $this->helper->response(500, ['message' => 'Error message']);
    }
}
