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
        try {
            $data = Input::only('name', 'contact', 'description', 'token');
            $tokenValidate = $this->helper->validateToken($data['token']);
            if ($tokenValidate['success']) {

                $messages = [
                    'script_tags_free' => 'The :attribute contain invalid tags.',
                ];
                $validator = Validator::make($data, [
                    'name' => 'required|max:255|script_tags_free',
                    'contact' => 'required|max:255|script_tags_free',
                    'description' => 'required|max:255|script_tags_free'
                ], $messages);
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
                    return $this->helper->response(200, ['message' => 'Thank you for feedback. Your request successfully recorded.']);
                }
            } else {
                return $this->helper->response(400, ['message' => 'Invalid token']);
            }
        } catch (\Exception $ex) {
            return $this->helper->response(500, ['message' => $ex->getMessage()]);
        }
    }

    /**
     * Invite friends or request invitation
     *
     * @return $this
     */
    public function postInviteFriends()
    {
        try {
            $data = Input::only('invitations', 'type', 'token');
            $tokenValidate = $this->helper->validateToken($data['token']);
            if ($tokenValidate['success']) {
                if ($data['type'] != config('general.invitation_request.invite_friend') && $data['type'] != config('general.invitation_request.invite_me')) {
                    return $this->helper->response(400, ['message' => 'Invalid invitation request type.']);
                }
                if (is_array($data['invitations']) && count($data['invitations']) > 0) {

                    /*
                     * Validate invitation data
                     */
                    $messages = [
                        'script_tags_free' => 'The :attribute contain invalid tags.',
                    ];
                    foreach ($data['invitations'] as $invitation) {
                        $validator = Validator::make($invitation, [
                            'name' => 'required|max:255|script_tags_free',
                            'email' => 'email|required|max:255|script_tags_free'
                        ], $messages);
                        if ($validator->fails()) {
                            $errors = $validator->errors();
                            return $this->helper->response(400, ['message' => $errors]);
                        }
                    }

                    /*
                     * Store invitations
                     */
                    foreach ($data['invitations'] as $invitation) {
                        DB::table('trn_invite_friends')->insert([
                            'name' => $invitation['name'],
                            'email' => $invitation['email'],
                            'status' => 1,
                            'user_id' => $tokenValidate['data']->user_id,
                            'user_type' => $tokenValidate['data']->user_type,
                            'type' => $data['type']
                        ]);
                    }
                    return $this->helper->response(200, ['message' => 'Thank you for feedback. Your request successfully recorded.']);

                } else {
                    return $this->helper->response(400, ['message' => 'Invalid invitation request details.']);
                }
            } else {
                return $this->helper->response(400, ['message' => 'Invalid token']);
            }
        } catch (\Exception $ex) {
            return $this->helper->response(500, ['message' => $ex->getMessage()]);
        }
    }
}
