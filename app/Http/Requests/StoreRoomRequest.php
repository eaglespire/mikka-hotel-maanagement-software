<?php

namespace App\Http\Requests;

use App\Models\Room;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreRoomRequest extends FormRequest
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
            'title'=>['required','string','min:5','max:255'],
            'category'=>['required','string','min:5','max:255'],
            'desc'=>['required','string','min:5'],
            'roomNumber'=>['required','numeric','unique:rooms'],
            'price'=>['required','min:1','numeric'],
            'adesc'=>['nullable'],
            'firstImage'=>['required','max:1024','mimes:png,PNG,JPG,jpeg,JPEG,svg,jpg'],
            'secondImage'=>['nullable','max:1024','mimes:png,PNG,JPG,jpeg,JPEG,svg,jpg'],
            'thirdImage'=>['nullable','max:1024','mimes:png,PNG,JPG,jpeg,JPEG,svg,jpg'],
            'fourthImage'=>['nullable','max:1024','mimes:png,PNG,JPG,jpeg,JPEG,svg,jpg'],
            'fifthImage'=>['nullable','max:1024','mimes:png,PNG,JPG,jpeg,JPEG,svg,jpg'],
            'sixthImage'=>['nullable','max:1024','mimes:png,PNG,JPG,jpeg,JPEG,svg,jpg'],
        ];
    }
}
