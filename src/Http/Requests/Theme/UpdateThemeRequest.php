<?php

namespace LaravelReady\ThemeStore\Http\Requests\Theme;

use LaravelReady\ThemeStore\Http\Requests\ApiFormRequest;

class UpdateThemeRequest extends ApiFormRequest
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
            'description' => 'string|min:1',
            'vendor' => 'string|min:1|max:50',
            'group' => 'string|min:1|max:50',
            'status' => 'boolean',
            'featured' => 'boolean',
            'preview_link' => 'nullable|string|min:1|max:2000',
            'authors' => 'array|min:1|max:10',
            'categories' => 'array|min:1|max:10',
        ];
    }
}
