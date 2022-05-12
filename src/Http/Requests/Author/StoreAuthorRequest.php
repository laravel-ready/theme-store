<?php

namespace LaravelReady\ThemeStore\Http\Requests\Author;

use LaravelReady\ThemeStore\Http\Requests\ApiFormRequest;

class StoreAuthorRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:1|max:50',
            'contact' => 'required|string|min:1|max:50',
            'title' => 'nullable|string|min:1|max:20',
        ];
    }
}
