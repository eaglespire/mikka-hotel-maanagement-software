<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $data['title'] = "Site Setting";
        $data['titleText'] = "Site settings";
        $data['titleContent'] = "Hotel Management System";
        $data['description'] = "";
        $data['keywords'] = "";
        return view('settings.site.index',$data);
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
