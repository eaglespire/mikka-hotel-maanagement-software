<?php

namespace App\Services;

use App\Models\User;
use App\Traits\HasStaffInfo;
use App\Traits\UserImage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class StaffService
{
    use HasStaffInfo, UserImage;
    public function createNewStaff(string $firstname, string $lastname, string $email,string $phone, string $role, $joinDate, $dob) : bool
    {
        try {
            $user = User::create([
                'firstname'=>$firstname,
                'lastname'=>$lastname,
                'email' => $email,
                'phone'=>$phone,
                'join_date'=>$this->buildDate($joinDate),
                'dob'=>$this->buildDate($dob),
                'photo'=>$this->store('users',150,150,'photo')
            ]);
            $user->update([
                'password' => Hash::make($this->generatePassword()),
                'password_text'=>$this->generatePassword(),
                'staff_identity'=>$this->staffId($dob,$user->id)
            ]);
            $user->assignRole($role);
            return true;
        } catch (\Exception $exception){
            Log::error($exception->getMessage());
            return false;
        }
    }
    public function updateStaff(int $id,array $values) : bool
    {
        try {
            $staff = User::findOrFail($id);
            $staff->update([
                'dob'=>$values['dob'] === null ? $staff->dob : $this->buildDate($values['dob']),
                'join_date'=>$values['join_date'] === null ? $staff->join_date : $this->buildDate($values['join_date']),
                'firstname'=>$values['firstname'],
                'lastname'=>$values['lastname'],
                'email'=>$values['email'],
                'phone'=>$values['phone'],
                'password' => Hash::make($values['password_text']),
                'password_text' => $values['password_text'],
                'status'=>$values['status']
            ]);
            $staff->assignRole($values['role']);

            if (request()->hasFile('photo'))
            {
                //remove the previuosly uploaded photo
                if (is_file(public_path('storage/users/'.$staff->photo)))
                {
                    unlink(public_path('storage/users/'.$staff->photo));
                }
                $staff->update([
                    'photo'=>$this->store('users',150,150,'photo')
                ]);
            }

            if ($values['dob'] !== null)
            {
                $staff->update([
                    'staff_identity'=>$this->staffId($values['dob'],$staff->id),
                ]);
            }
            return true;
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            return false;
        }
    }
}
