<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Route;

function activeRoute($routeNames, $param = null) {
    if(is_array($routeNames)) {
        foreach ($routeNames as $routeName) {
            if(Route::currentRouteName() == $routeName) {
                return true;
            }
        }
    } else {
        if(Route::currentRouteName() == $routeNames) {
            return true;
        }
    }
}


function get_setting($type) {
    $setting = Setting::where('type', $type)->first();
    if($setting) {
        return $setting->value;
    } else {
        return null;
    }
}
