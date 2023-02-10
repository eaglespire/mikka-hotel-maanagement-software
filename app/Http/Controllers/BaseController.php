<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    protected array $data = [];
    public function __construct()
    {
        $this->data['titleContent'] = "Hotel Management System";
        $this->data['description'] = "";
        $this->data['keywords'] = "";
    }
}
