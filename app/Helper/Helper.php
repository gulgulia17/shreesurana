<?php

namespace App\Helper;

use Illuminate\Support\Facades\URL;

class Helper
{
    public static function routeName()
    {
        return request()->route()->getName();
    }

    public static function routeNameArray()
    {
        if (!static::routeName()) {
            return null;
        }
        return explode('.', static::routeName());
    }

    public static function goBack()
    {
        $routeNameArray = static::routeNameArray();
        if (!$routeNameArray) {
            return null;
        }

        $routNameArrayCount = count($routeNameArray);

        if ($routNameArrayCount <= 1) {
            return null;
        }

        if ($routeNameArray[$routNameArrayCount - 1] == 'index') {
            return route('home');
        }

        return URL::previous();
    }
}
