<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 1/5/19
 * Time: 8:56 PM
 */

namespace App\Classes;


class ApiResponse
{
    public static function success($message, $body = null)
    {
        $return = [
            'success' => true,
            'message' => $message
        ];

        if ($body) {
            $return = array_merge($return, $body);
        }

        return response()->json($return);
    }

    public static function error($message, $body = null)
    {
        $return = [
            'success' => false,
            'message' => $message
        ];

        if ($body) {
            $return = array_merge($return, $body);
        }

        return response()->json($return);
    }

    public static function data(array $data)
    {
        return response()->json($data);
    }
}