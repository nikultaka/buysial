<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    function get_setting($key) {
        return Setting::where('name', $key)->value('value');
    }
}
