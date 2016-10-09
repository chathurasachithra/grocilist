<?php

namespace app\Libraries;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Helper
{
    public function __construct()
    {

    }

    /**
     * Get response
     *
     * @param $status
     * @param $message
     * @return $this
     */
    public function response($status, $message)
    {
        return (new Response($message, $status))
            ->header('Content-Type', 'application/json');
    }

    /**
     * Generate token
     *
     * @param $userId
     * @return string
     */
    public function generateToken($userId)
    {
        return \sha1($userId . date('Y-m-d h:i:s'));
    }

    public function generateUserToken($userID, $userType)
    {
        $token = $this->generateToken($userID.'-'.$userType);
        DB::table('trn_user_tokens')
            ->insert(['token' => $token, 'user_id' => $userID, 'user_type' => $userType, 'status' => 1]);
        return $token;
    }

    /**
     * @param $string
     * @return mixed
     */
    public function escapeLike($string)
    {
        $search = array('%', '_');
        $replace   = array('\%', '\_');
        return str_replace($search, $replace, $string);
    }

    /**
     * @param $value
     * @param int $decimals
     *
     * @return null|string
     */
    public static function formatToNumber($value, $decimals = 2)
    {
        if (trim($value) != null) {
            return number_format($value, $decimals, '.', '');
        }
        return null;
    }

    /**
     * Check invitation code exist
     *
     * @param $code
     * @return array
     */
    public function checkInvitation($code)
    {
        $data = DB::table('trn_invitations')
            ->select('id', 'name', 'email', 'status')
            ->where('code', $code)
            ->whereIn('status', [config('general.invitation_status.send'), config('general.invitation_status.active')])
            ->first();
        if (isset($data->id)) {
            return ['success' => true, 'data' => $data];
        }
        return ['success' => false];
    }

    /**
     * Validate token
     *
     * @param $token
     * @return array
     */
    public function validateToken($token)
    {
        if ($token == '' || $token == null) {
            return ['success' => false];
        }
        $data = DB::table('trn_user_tokens')
            ->select('id', 'user_type', 'user_id', 'token')
            ->where('token', $token)
            ->where('status', 1)
            ->first();
        if (isset($data->id)) {
            return ['success' => true, 'data' => $data];
        } else {
            return ['success' => false];
        }
    }
}
