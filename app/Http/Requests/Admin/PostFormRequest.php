<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
        $rules = [
            'category_id'=>[
                'required',
                'integer'
            ],
            'title'=>[
                'required',
                'string'
            ],
            'content'=>[
                'required'
            ],
            'image'=>[
                'nullable',
                'mimes:jpeg,jpg,png'
            ]
        ];

        return $rules;
    }
}
