<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactUsRequest extends FormRequest
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
            'frist_name'=> ['required','max:50'],
            'last_name'=> ['required','max:50'],
            'email'=> ['required','email','max:255'],
            'subject'=>['required','in:complain,inquire,request,other'],
            'message'=>['required','min:10','max:255']

        ];
    }
}
