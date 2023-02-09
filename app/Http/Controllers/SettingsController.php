<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SettingsController extends Controller
{
    private array $data;
    public function __construct()
    {
        $this->middleware(['permission:'. Permissions::CAN_MANAGE_SETTINGS]);
        $this->data['titleContent'] = "Hotel Management System";
        $this->data['description'] = "";
        $this->data['keywords'] = "";
    }
    public function index()
    {
        $this->data['title'] = "General Settings";
        $this->data['titleText'] = "General Settings";
        return view('settings.index',$this->data);
    }
    public function SocialMediaSettings()
    {
        $this->data['title'] = "Social Media Settings";
        $this->data['titleText'] = "Social Media Settings";
        return view('settings.social-media',$this->data);
    }
    public function UploadSettings()
    {
        $this->data['title'] = "Upload Settings";
        $this->data['titleText'] = "Upload Settings";
        return view('settings.uploads', $this->data);
    }
    public function ContactSettings()
    {
        $this->data['title'] = "Contact Settings";
        $this->data['titleText'] = "Contact settings";
        return view('settings.contact',$this->data);
    }
    public function SalarySettings()
    {
        $this->data['title'] = "Tax Settings";
        $this->data['titleText'] = "tax settings";
        return view('settings.salary', $this->data);
    }

}
