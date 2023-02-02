<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewStaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'firstname'=>['required','string','min:3','max:255'],
            'lastname'=>['required','string','min:3','max:255'],
            'email'=>['required','email','min:3','max:255','unique:users'],
            'phone'=>['required','string','min:3','max:255'],
            'join_date'=>['required'],
            'dob'=>['required'],
            'role'=>['required'],
            'photo'=>['nullable','image','mimes:png,PNG,JPG,jpeg,JPEG','max:1024']
        ];
    }
}
