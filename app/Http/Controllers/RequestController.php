<?php

namespace App\Http\Controllers;

use App\Libraries\Helper;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class RequestController extends Controller
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
     * Save new product request
     *
     * @return $this
     */
    public function postRequestProduct()
    {
       $data = Input::only('name', 'contact', 'description', 'token');
       $tokenValidate = $this->helper->validateToken($data['token']);
        if ($tokenValidate['success']) {

            $validator = Validator::make($data, [
                'name' => 'required|max:255|script_tags_free',
                'contact' => 'required|max:255|script_tags_free',
                'description' => 'required|max:255|script_tags_free',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->helper->response(400, ['message' => $errors]);
            } else {
                DB::table('trn_request_products')->insert([
                    'name' => $data['name'],
                    'contact_no' => $data['contact'],
                    'details' => $data['description'],
                    'status' => 1,
                    'user_id' => $tokenValidate['data']->user_id,
                    'user_type' => $tokenValidate['data']->user_type
                ]);
                return $this->helper->response(200, ['message' => 'Your request successfully recorded.']);
            }
        } else {
            return $this->helper->response(400, ['message' => 'Invalid token']);
        }

    }


}
