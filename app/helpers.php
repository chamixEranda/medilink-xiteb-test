<?php

use Illuminate\Support\Facades\App;
use App\Http\CentralLogics\Helpers;

if (! function_exists('translate')) {
    function translate($key, $replace = [])
    {
        if(strpos($key, 'validation.') === 0 || strpos($key, 'passwords.') === 0 || strpos($key, 'pagination.') === 0 || strpos($key, 'order_texts.') === 0) {
            return trans($key, $replace);
        }
        
        $key = strpos($key, 'messages.') === 0?substr($key,9):$key;
        $local = 'en';
        App::setLocale($local);
        try {
            $lang_array = include(base_path('lang/' . $local . '/messages.php'));
            $processed_key = ucfirst(str_replace('_', ' ', Helpers::remove_invalid_charcaters($key)));
            if (!array_key_exists($key, $lang_array)) {
                $lang_array[$key] = $processed_key;
                $str = "<?php return " . var_export($lang_array, true) . ";";
                file_put_contents(base_path('lang/' . $local . '/messages.php'), $str);
                $result = $processed_key;
            } else {
                $result = trans('messages.' . $key, $replace);
            }
        } catch (\Exception $exception) {
            info($exception);
            $result = trans('messages.' . $key, $replace);
        }

        return $result;
    }
}

if (!function_exists('getPrescriptionImagePath')) {
    function getPrescriptionImagePath($imageName){
        $path = 'storage/prescription/'.$imageName;
        return $path;
    }
}