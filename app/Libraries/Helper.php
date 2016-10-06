<?php

namespace app\Libraries;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

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
}
