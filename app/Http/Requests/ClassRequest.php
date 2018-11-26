<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassRequest extends FormRequest
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
            'name'=>'required|min:2|max:10',
            'password'=>'max:6',
            'verification'=>'required|Integer|',
            'avatar'=>'mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200',
            'type_id'=>'exists:class_types,id'
        ];
    }
}
