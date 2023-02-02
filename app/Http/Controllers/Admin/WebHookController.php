<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebHookController extends Controller
{
    public function GetResponseFromCloudinary()
    {
       return request()->all();
    }
}
