<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveProjectRequest extends FormRequest
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
            'title' => 'required',
            'url' => [
                'required',
                Rule::unique('projects')->ignore($this->route('project'))
            ],
            'image' => [
                $this->route('project') ? 'nullable' : 'required',
                'mimes:jpg,jpeg,png'
            ],
            'category_id' => [
                'required',
                'exist:categories,id'
            ],
            'description' => 'required',
        ];
    }

    /**
     * Set custom validation messages for each fiel
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'El proyecto necesita un título'
        ];
    }
}
