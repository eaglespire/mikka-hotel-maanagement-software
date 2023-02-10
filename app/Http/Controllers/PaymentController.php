<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends BaseController
{
    public function StaffSalaries()
    {
        $this->data['title'] = 'Payroll';
        $this->data['titleText'] = 'Payroll';
        return view('dashboard.payroll.salaries',$this->data);
    }
}
