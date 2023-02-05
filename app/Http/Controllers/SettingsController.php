<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SettingsController extends Controller
{
    public function index()
    {
        if (Auth::user()->can(Permissions::CAN_MANAGE_SETTINGS)){
            $data['title'] = "Site Setting";
            $data['titleText'] = "Site settings";
            $data['titleContent'] = "Hotel Management System";
            $data['description'] = "";
            $data['keywords'] = "";
            return view('settings.site.index',$data);
        }
        Alert::warning('Error','You don"t have sufficient privilege');
        return back();

    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Setting $setting)
    {
    }

    public function edit(Setting $setting)
    {
    }

    public function update(Request $request, Setting $setting)
    {
    }

    public function destroy(Setting $setting)
    {
    }
}
