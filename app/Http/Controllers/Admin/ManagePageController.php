<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagePageController extends Controller
{
    private array $data = [];
    public function __construct()
    {
        $this->data['title'] = "Manage Page";
        $this->data['titleText'] = "Manage Page";
        $this->data['titleContent'] = "Hotel Management System";
        $this->data['description'] = "";
        $this->data['keywords'] = "";
    }
    public function AboutPage()
    {
        return view('dashboard.pages.about', $this->data);
    }
}
