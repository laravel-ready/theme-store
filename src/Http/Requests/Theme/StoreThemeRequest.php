<?php

namespace LaravelReady\ThemeStore\Http\Requests\Theme;

use LaravelReady\ThemeStore\Http\Requests\ApiFormRequest;

class StoreThemeRequest extends ApiFormRequest
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
            'description' => 'required|string|min:1',
            'vendor' => 'required|string|min:1|max:50',
            'group' => 'required|string|min:1|max:50',
            'status' => 'nullable|boolean',
            'featured' => 'nullable|boolean',
            'preview_link' => 'nullable|string|min:1|max:2000',
            'authors' => 'required|array|min:1|max:10',
            'categories' => 'required|array|min:1|max:10',
        ];
    }
}
