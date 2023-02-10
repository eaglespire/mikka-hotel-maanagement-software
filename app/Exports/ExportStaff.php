<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportStaff implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('firstname','lastname','email','dob','staff_identity','join_date','phone')->get();
    }

    public function headings(): array
    {
        return ['firstname','lastname','email','dob','staff_identity','join_date','phone'];
    }
}
