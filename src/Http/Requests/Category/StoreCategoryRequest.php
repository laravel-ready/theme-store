<?php

namespace LaravelReady\ThemeStore\Http\Requests\Category;

use LaravelReady\ThemeStore\Http\Requests\ApiFormRequest;

class StoreCategoryRequest extends ApiFormRequest
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
            'description' => 'required|string|min:1|max:500',
            'featured' => 'nullable|boolean',
        ];
    }
}
