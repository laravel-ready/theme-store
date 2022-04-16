<?php

namespace LaravelReady\ThemeStore\Http\Requests\Author;

use LaravelReady\ThemeStore\Http\Requests\ApiFormRequest;

class UpdateAuthorRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|min:1|max:50',
            'contact' => 'string|min:1|max:50',
        ];
    }
}
