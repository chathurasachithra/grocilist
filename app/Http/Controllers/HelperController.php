<?php

namespace App\Http\Controllers;

use App\Libraries\Helper;
use App\User;
use Faker\Provider\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class HelperController extends Controller
{
    private $helper;

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Generate tokens
     *
     * @return string
     */
    public function getGenerateInvitations()
    {
        for ($i=0; $i<100; $i++) {
            $token = $this->generateRandomString();
            $count = DB::table('trn_invitations')->where('code', $token)->count();
            if ($count == 0) {
                DB::table('trn_invitations')->insert(
                    ['code' => $token, 'status' => 1]
                );
            }
        }
        return 'completed';
    }

    /**
     * Generate random string
     *
     * @param int $length
     * @return string
     */
    private function generateRandomString($length = 12) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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
