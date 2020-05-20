<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOfferRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['required','date','after:today'],
            'end_date' => ['required', 'date','after_or_equal:start_date'],
            'agency_price' => ['required', 'string', 'max:25'],
            'user_price' => ['required', 'string', 'max:25'],
            'no_rooms' => ['required', 'integer','max:100'],
            'status'=> 'boolean',
            'photos.*'=> ['required','image'],
            'Departial_time.*'=>['required', 'date','after_or_equal:start_date'],
            'arrival_time.*'=>['required', 'date','before_or_equal:end_date'],
            'to.*' => ['required', 'string', 'max:25'],
            'from.*' => ['required', 'string', 'max:25'],
            'transportation_mode.*'=>'in:bus,train',
            'category.*' => ['required', 'integer'],
            'no_trip.*' => ['required', 'integer'],
            'agency_id' => ['sometimes','integer'],

        ];
    }
}
