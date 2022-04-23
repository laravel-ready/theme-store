<?php

namespace LaravelReady\ThemeStore\Http\Requests\Theme\Release;

use LaravelReady\ThemeStore\Http\Requests\ApiFormRequest;

class StoreReleaseRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'theme_id' => 'required|integer',
            'version' => 'required|string|min:1|max:20',
            'notes' => 'required|string|min:1',
        ];
    }
}
