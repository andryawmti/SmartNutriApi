<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 1/5/19
 * Time: 8:57 PM
 */

namespace App\Classes;


class MyHttpResponse
{
    public static function storeResponse(bool $success, $message, $route)
    {
        $return = [
            'success' => $success,
            'title' => 'Created',
            'message' => $message
        ];

        return redirect()->route($route)->with($return);
    }

    public static function updateResponse(bool $success, $message, $route, $id = null)
    {
        $return = [
            'success' => $success,
            'title' => 'Updated',
            'message' => $message
        ];

        if ($id) {
            return redirect()->route($route, ['id' => $id])->with($return);
        } else {
            return redirect()->route($route)->with($return);
        }
    }

    public static function deleteResponse(bool $success, $message, $route)
    {
        $return = [
            'success' => $success,
            'title' => 'Deleted',
            'message' => $message
        ];

        return redirect()->route($route)->with($return);
    }
}