<?php

use App\Models\User;

if (!function_exists('format_boolean')){
    function format_boolean(bool $columnToFormat) : string{
        if ($columnToFormat){
            return "Yes";
        }
        return "No";
    }
}
//if (!function_exists('authenticate_user_ip'))
//{
//    function authenticate_user_ip()
//    {
//        $user = \App\Models\User::where('ip',request()->ip())
//            ->first();
//        return $user?->fullname;
//    }
//}
if (!function_exists('authenticate_user_ip'))
{
    function authenticate_user_ip(): User
    {
        return  User::where('ip',request()->ip())
            ->first();
    }
}

