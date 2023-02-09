<?php

namespace Modules\Room\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\CustomPagination;

class BaseController extends Controller
{
    use CustomPagination;
    protected array $data;
    public function __construct()
    {
        $this->data['title'] = 'Dashboard';
        $this->data['titleText'] = "Hi";
        $this->data['titleContent'] = "Hotel Management System";
        $this->data['description'] = "";
        $this->data['keywords'] = "";
    }
}
