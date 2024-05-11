<?php

namespace App\Http\CentralLogics;

class Helpers
{
    public static function error_processor($validator)
    {
        $err_keeper = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            array_push($err_keeper, ['code' => $index, 'message' => $error[0]]);
        }
        return $err_keeper;
    }

    public static function generate_email_otp()
    {
        // 4 numbers
        $token = rand(10,100).''.date('s');
        $result = substr($token, 0, 4);
        return $result;
    }

    public static function remove_invalid_charcaters($str)
    {
        return str_ireplace(['\'', '"', ',', ';', '<', '>', '?'], ' ', $str);
    }
}