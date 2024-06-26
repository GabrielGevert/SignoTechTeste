<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreatePollRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {

        $this->merge([
            'start_at' => Carbon::parse($this->start_date . $this->start_time)->toDateTimeString(),
            'end_at' => Carbon::parse($this->end_date . $this->end_time)->toDateTimeString(),
        ]);
        
    }


    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date' ,'after:start_at'],
            'option' => ['required', 'array', 'min:3']
        ];
    }
}