<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStaffRequest extends FormRequest
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
            'email'=>['required','email','min:3','max:255',Rule::unique('users')->ignore($this->id)],
            'phone'=>['required','string','min:3','max:255'],
            'password_text'=>['required','string','min:8','max:255'],
            'join_date'=>['nullable'],
            'dob'=>['nullable'],
            'photo'=>['nullable','image','mimes:png,PNG,JPG,jpeg,JPEG','max:1024']
        ];
    }
}
