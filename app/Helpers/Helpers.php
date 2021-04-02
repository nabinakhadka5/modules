<?php
/**
 * Created by cuongnd
 */

namespace App\Helpers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Helpers
{
    public static function pre($data = array())
    {
        echo '<pre>';
        print_r($data);
        die;
    }

    public static function formatDate($date = '')
    {
        $plusTime = 0;
        if (App::getLocale() == 'vi') {
            $plusTime = (7 * 60 * 60);
            return date('Y/m/d H:i', (strtotime($date) + $plusTime));
        } else {
            return date('Y/m/d H:i', (strtotime($date) + $plusTime));
        }
    }

    public static function getUserID($guard)
    {
        return Auth::guard($guard)->id();
    }

    public static function getDataUser($guard)
    {
        return Auth::guard($guard)->user();
    }

    public static function getUserEmail($guard)
    {
        return Auth::guard($guard)->user()->email;
    }

    public static function titleAction($data)
    {
        return array(
            'title' => !empty($data[0]) ? $data[0] : '',
            'flag' => !empty($data[1]) ? $data[1] : ''
        );
    }

}
