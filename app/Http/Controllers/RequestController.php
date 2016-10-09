<?php

namespace App\Http\Controllers;

use App\Libraries\Helper;
use App\Models\OrderDetailsModel;
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

    /**
     * Update user shopping cart
     *
     * @return $this
     */
    public function postUpdateCart()
    {
        $data = Input::only('order_id', 'details', 'token');
        $tokenValidate = $this->helper->validateToken($data['token']);
        if ($tokenValidate['success']) {

            /*
             * Validate order details
             */
            if (is_array($data['details']) && count($data['details']) > 0) {

                foreach ($data['details'] as $item) {
                    $validator = Validator::make($item, [
                        'item_id' => 'required|exists:trn_items,id,status,1',
                        'quantity' => 'required|numeric|max:100'
                    ]);
                    if ($validator->fails()) {
                        $errors = $validator->errors();
                        return $this->helper->response(400, ['message' => $errors]);
                    }
                }
            } else {
                return $this->helper->response(400, ['message' => 'Invalid order details.']);
            }

            /**
             * Validate main order
             */
            if ($data['order_id'] == '' || $data['order_id'] == null) {
                $order = new OrderModel();
                $order->status = 0;
                $order->user_id = $tokenValidate['data']->user_id;
                $order->user_type = $tokenValidate['data']->user_type;
                $order->save();

                $orderId = $order->id;
            } else {
                $order = OrderModel::select('id')
                    ->where('id', $data['order_id'])
                    ->where('user_id', $tokenValidate['data']->user_id)
                    ->where('user_type', $tokenValidate['data']->user_type)
                    ->where('status', 0)
                    ->first();
                if (isset($order->id)) {
                    $orderId = $order->id;
                } else {
                    return $this->helper->response(400, ['message' => 'Update request for a invalid order.']);
                }
            }

            /**
             * Update token and save order
             */
            DB::table('trn_user_tokens')->where('token', $data['token'])->update(['order_id' => $orderId]);
            $response = $this->saveOrder($orderId, $data['details']);
            if ($response['success']) {
                return $this->helper->response(200, ['message' => 'Order update successfully.', 'order' => $response['order']]);
            } else {
                return $this->helper->response(400, ['message' => $response['message']]);
            }
        } else {
            return $this->helper->response(400, ['message' => 'Invalid token']);
        }
    }

    /**
     * Save order
     *
     * @param $orderId
     * @param $details
     * @return array
     */
    private function saveOrder($orderId, $details)
    {
        try {
            DB::beginTransaction();
            $total = 0;
            DB::table('trn_order_details')->where('order_id', $orderId)->delete();
            foreach ($details as $detail) {
                if ($detail['quantity'] > 0) {
                    $item = DB::table('trn_items')->select('price')->where('id', $detail['item_id'])->first();
                    $unitPrice = 0;
                    if (isset($item->price)) {
                        $unitPrice = $item->price;
                    }
                    $orderDetail = new OrderDetailsModel();
                    $orderDetail->order_id = $orderId;
                    $orderDetail->item_id = $detail['item_id'];
                    $orderDetail->quantity = $detail['quantity'];
                    $orderDetail->unit_price = $unitPrice;
                    $orderDetail->save();
                    $total = $total + ($detail['quantity'] * $unitPrice);
                }
            }
            $order = OrderModel::find($orderId);
            $order->total = $total;
            $order->save();
            DB::commit();
            return ['success' => true, 'order' => $this->getOrder($orderId)];
        } catch (\Exception $ex) {
            DB::rollBack();
            return ['success' => false, 'message' => $ex->getMessage()];
        }
    }

    /**
     * Get order details
     *
     * @param $orderId
     * @return object
     */
    private function getOrder($orderId)
    {
        $order = DB::table('trn_order')
            ->select('id', 'total', 'status')
            ->where('id', $orderId)
            ->first();
        if (isset($order->id)) {
            $orderDetails = DB::table('trn_order_details')
                ->select('id', 'order_id', 'item_id', 'quantity', 'unit_price')
                ->where('order_id', $order->id)
                ->get();
            $order->details = $orderDetails;
        }
        return $order;
    }

}
