<?php

namespace LaravelReady\ThemeStore\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:1|max:50',
            'description' => 'required|string',
            'vendor' => 'required|string|min:1|max:50',
            'group' => 'required|string|min:1|max:50'
        ];
    }
}
