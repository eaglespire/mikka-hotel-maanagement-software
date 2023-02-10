<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportStaffFromExcel implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $emailExists = User::where('email',$row[2])->exists();
        $email = Str::lower(Str::random(8)).'@mail.com';
        return new User([
            'firstname' => $row[0],
            'lastname' => $row[1],
            'email' => $emailExists ? $email : $row[2],
            'phone' => $row[3],
//            'join_date' => $row[4],
            'password' => Hash::make(generate_password()),
            'password_text' => generate_password(),
//            'dob' => $row[5]
        ]);
    }
}
