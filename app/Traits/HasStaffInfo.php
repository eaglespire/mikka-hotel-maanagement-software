<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Str;

trait HasStaffInfo
{
    public function staffId($dob,$id) : string
    {
        //get the first three letters of the company name
        $compInitials = strtoupper(substr(config('app.name'),0,3));
        $staffDOB = implode("", explode('-',$this->buildDate($dob)->toDateString()));
        return $compInitials.$staffDOB.$id;
    }
    public function generatePassword() : string
    {
        $compInitials = ucwords(substr(config('app.name'),0,3));
        return $compInitials."_".substr(strtolower(Str::random(20)).rand(0,10000),0,10);
    }
    public function buildDate(string $receiveDate): Carbon
    {
        //split the received date string into an array
        $arr = explode('/',$receiveDate);
        $day = $arr[0];
        $month = $arr[1];
        $yr = $arr[2];
        return Carbon::createFromDate($yr,$month,$day);
    }

}
