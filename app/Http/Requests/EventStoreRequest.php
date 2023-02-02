<?php

namespace App\Http\Requests;

use App\Models\Event;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class EventStoreRequest extends FormRequest
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
            'title'=>['required','string','max:20'],
            'start'=>['required','string'],
            'end'=>['required','string'],
            'comment'=>['nullable']
        ];
    }
    public function saveToDB() : bool
    {
        try {
            Event::create([
                'name'=>$this['title'],
                'comments'=>$this['comment'],
                'start_time'=>$this['start'],
                'finish_time'=>$this['end']
            ]);
            return true;
        } catch (\Exception $exception){
            Log::error($exception->getMessage());
            return false;
        }
    }
}
