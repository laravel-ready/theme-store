<?php

namespace LaravelReady\ThemeStore\Http\Requests\Category;

use LaravelReady\ThemeStore\Http\Requests\ApiFormRequest;

class UpdateCategoryRequest extends ApiFormRequest
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
            'description' => 'string|min:1|max:500',
            'featured' => 'boolean',
        ];
    }
}
