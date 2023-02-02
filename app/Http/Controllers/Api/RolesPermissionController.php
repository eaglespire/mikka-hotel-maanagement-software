<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesPermissionController extends Controller
{
    public function createRole(Request $request)
    {
        $request->validate(['name'=>['required','unique:roles']]);
        Role::create([
            'guard_name'=>'web',
            'name'=>$request['name']
        ]);
        return response()->json([
            'status'=>true
        ],201);
    }
}
