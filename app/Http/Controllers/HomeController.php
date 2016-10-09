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

class HomeController extends Controller
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
     * Load home page with required data
     *
     * @return View
     */
    public function getHomePage()
    {
        $messageData = ['status' => false];

        /*
         * Logout user
         */
        if (Input::has('logout') && Input::get('logout') == 'true') {
            if ($this->request->session()->has('logged-user')) {
                $userSessionData = $this->request->session()->get('logged-user');
                if ($userSessionData['userType'] == 2) {
                    $this->request->session()->forget('logged-user');
                    $this->request->session()->save();
                    $messageData = ['status' => true, 'type' => 'success', 'message' => 'User logout successfully.'];
                }
            }
        }

        /*
         * List all items
         */
        $items = DB::table('trn_items')
            ->select('unit_value', 'price', 'name', 'image', 'id', 'description')
            ->where('status', 1)
            ->get();

        /*
         * Validate invitation code
         */
        $data = Input::only('my-invite');
        $invite = $data['my-invite'];
        if ($invite != null || $invite != '') {
            $inviteStatus = $this->helper->checkInvitation($invite);
            if ($inviteStatus['success']) {
                $codeDetails = $inviteStatus['data'];
                if ($codeDetails->status == config('general.invitation_status.send')) {
                    DB::table('trn_invitations')
                        ->where('code', $invite)
                        ->update(['status' => config('general.invitation_status.active')]);
                }
                $messageData = [
                    'status' => true,
                    'type' => 'success',
                    'message' => 'Welcome '.$codeDetails->name.'. We have updated you as invited user.'
                ];

                if ($this->request->session()->has('logged-user')) {
                    $oldSessionData = $this->request->session()->get('logged-user');
                    if($oldSessionData['userType'] == 3) {
                        $this->createNewInviteUserSession($invite, $codeDetails);
                    } else if ($oldSessionData['userType'] == 1) {
                        $sessionInviteCode = $oldSessionData['invitation']['code'];
                        if ($sessionInviteCode != $invite) {
                            $this->createNewInviteUserSession($invite, $codeDetails);
                        }
                    }
                } else {
                    $this->createNewInviteUserSession($invite, $codeDetails);
                }
            } else {
                $messageData = ['status' => true, 'type' => 'error', 'message' => 'Invalid invitation URL.'];
            }
        }

        /*
         * Get details store in session
         */
        $sessionData = [];
        if ($this->request->session()->has('logged-user')) {
            $sessionData = $this->request->session()->get('logged-user');
        } else {
            $sessionData['userType'] = 3;
            $sessionData['token'] = $this->helper->generateUserToken('guest', 3);
            $this->request->session()->put('logged-user', $sessionData);
            $this->request->session()->save();
        }

        /*
         * Get order details
         */
        $order = null;
        $loggedUserOrderDetails = DB::table('trn_user_tokens')
            ->select('token', 'order_id', 'user_id', 'user_type')
            ->where('token', $sessionData['token'])
            ->where('status', 1)
            ->first();
        if (isset($loggedUserOrderDetails->order_id) && $loggedUserOrderDetails->order_id != '' && $loggedUserOrderDetails->order_id != null) {
            $order = DB::table('trn_order')
                ->select('id', 'total')
                ->where('id', $loggedUserOrderDetails->order_id)
                ->first();
            if (isset($order->id)) {
                $orderDetails = DB::table('trn_order_details')
                    ->select('id', 'order_id', 'item_id', 'quantity', 'unit_price')
                    ->where('order_id', $order->id)
                    ->get();
                $order->details = $orderDetails;
            }
        }

        /**
         * Get user details
         */
        if ($sessionData['userType'] == 1) {
            $user = $sessionData['invitation'];
        } else if ($sessionData['userType'] == 2) {
            $user = DB::table('trn_user')
                ->select('id', 'name', 'email')
                ->where('id', $sessionData['userId'])
                ->first();
        } else {
            $user = ['name' => 'Guest'];
        }

        return [
            'flash_area' => $messageData,
            'items' => json_encode($items),
            'user_type' => $sessionData['userType'],
            'cart' => json_encode($order),
            'token' => $sessionData['token'],
            'user' => json_encode($user),
        'csrf_token' => csrf_field()];

        return view('home', [
            'flash_area' => $messageData,
            'items' => json_encode($items),
            'user_type' => $sessionData['userType'],
            'cart' => json_encode($order),
            'token' => $sessionData['token'],
            'user' => json_encode($user)]);
    }

    public function getCheckOutPage()
    {
        /*
         * List all items
         */
        $items = DB::table('trn_items')
            ->select('unit_value', 'price', 'name', 'image', 'id', 'description')
            ->where('status', 1)
            ->get();

        /*
         * Get details store in session
         */
        $sessionData = [];
        if ($this->request->session()->has('logged-user')) {
            $sessionData = $this->request->session()->get('logged-user');
        } else {
            $sessionData['userType'] = 3;
            $sessionData['token'] = $this->helper->generateUserToken('guest', 3);
            $this->request->session()->put('logged-user', $sessionData);
            $this->request->session()->save();
        }

        /*
         * Get order details
         */
        $order = null;
        $loggedUserOrderDetails = DB::table('trn_user_tokens')
            ->select('token', 'order_id', 'user_id', 'user_type')
            ->where('token', $sessionData['token'])
            ->where('status', 1)
            ->first();
        if (isset($loggedUserOrderDetails->order_id) && $loggedUserOrderDetails->order_id != '' && $loggedUserOrderDetails->order_id != null) {
            $order = DB::table('trn_order')
                ->select('id', 'total')
                ->where('id', $loggedUserOrderDetails->order_id)
                ->first();
            if (isset($order->id)) {
                $orderDetails = DB::table('trn_order_details')
                    ->select('id', 'order_id', 'item_id', 'quantity', 'unit_price')
                    ->where('order_id', $order->id)
                    ->get();
                $order->details = $orderDetails;
            }
        }

        /**
         * Get user details
         */
        if ($sessionData['userType'] == 1) {
            $user = $sessionData['invitation'];
        } else if ($sessionData['userType'] == 2) {
            $user = DB::table('trn_user')
                ->select('id', 'name', 'email')
                ->where('id', $sessionData['userId'])
                ->first();
        } else {
            $user = ['name' => 'Guest'];
        }

        return [
            'items' => json_encode($items),
            'user_type' => $sessionData['userType'],
            'cart' => json_encode($order),
            'token' => $sessionData['token'],
            'user' => json_encode($user)];

        return view('checkout', [
            'items' => json_encode($items),
            'user_type' => $sessionData['userType'],
            'cart' => json_encode($order),
            'token' => $sessionData['token'],
            'user' => json_encode($user)]);
    }

    /**
     * Create new session for invitee
     *
     * @param $invite
     * @param $codeDetails
     * @return bool
     */
    private function createNewInviteUserSession($invite, $codeDetails)
    {
        $newSessionData = [];
        $newSessionData['userType'] = 1;
        $newSessionData['invitation'] = ['code' => $invite, 'name' => $codeDetails->name, 'email' => $codeDetails->email];
        $newSessionData['token'] = $this->helper->generateUserToken($codeDetails->id, 1);
        $this->request->session()->forget('logged-user');
        $this->request->session()->put('logged-user', $newSessionData);
        $this->request->session()->save();
        return true;
    }

    /**
     * User login
     *
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function getLogin()
    {
        // TODO not completed yet
        $data = Input::only('email', 'password');
        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
            return 'invalid email';
        }
        if (empty($data['password'])) {
            return 'invalid password';
        }
        $user = DB::table('trn_user')
            ->select('id', 'name', 'password')
            ->where('email', $data['email'])
            ->where('status', 1)
            ->first();
        if (isset($user->password) && $user->password == \sha1($data['password'])) {
            $newSessionData = [];
            $newSessionData['userType'] = 2;
            $newSessionData['userId'] = $user->id;
            $newSessionData['token'] = $this->helper->generateUserToken($user->id, 2);
            $this->request->session()->forget('logged-user');
            $this->request->session()->put('logged-user', $newSessionData);
            $this->request->session()->save();
            return redirect()->action('HomeController@getHomePage');
        } else {
            return 'invalid login details';
        }
    }
}
