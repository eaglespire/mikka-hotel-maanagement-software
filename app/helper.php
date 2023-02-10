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
if (!function_exists('authenticate_user_ip'))
{
    function authenticate_user_ip(): User | null
    {
        return  User::where('ip',request()->ip())
            ->first();
    }
}
if (!function_exists('build_staff_id'))
{
    function build_staff_id($date,$firstname,$lastname,$id,$mode = 0) : string
    {
        $idChars = null;
        $exploded = explode('-',$date);
        //extract first char from firstname
        $fChar = ucfirst(substr($firstname,0,1));
        //extract first char from lastname
        $lChar = ucfirst(substr($lastname,0,1));
        if (strlen($id) == 1){
            $idChars = '000'.$id;
        }elseif (strlen($id) == 2 ){
            $idChars = '00'.$id;
        }elseif (strlen($id) == 3){
            $idChars = '0'.$id;
        } else{
            $idChars = $id;
        }
        return $exploded[2].$exploded[1].$idChars.$lChar.$fChar;
    }
}
if (!function_exists('generate_password'))
{
    function generate_password() : string
    {
        $string = md5(strtotime('now').strtolower(Str::random(4)));
        return substr($string,0,6);
    }
}
if (!function_exists('specific_role_users_count'))
{
    function specific_role_users_count($roleId) : int
    {
      return  User::with("roles")->whereHas("roles", function($q) use($roleId) {
            $q->whereIn("id", [$roleId]);
        })->count();
    }
}

