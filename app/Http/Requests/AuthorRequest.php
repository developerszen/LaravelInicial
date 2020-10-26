<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthorRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:80',
                'alpha_custom',
//                'alpha',
//                'unique:authors,name',
                Rule::unique('authors', 'name')->where(function ($query) {
                    return $query->where('deleted_at', null);
                })->ignore($this->author),
//                function ($attributo, $value, $fail) {
//                    $regex = preg_match('/^[\pL\.\s]+$/u', $value);
//
//                    if($regex) return;
//
//                    $fail(trans('validation.alpha_custom'));
//                }
            ],
        ];
    }
}
