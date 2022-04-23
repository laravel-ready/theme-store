<?php

namespace LaravelReady\ThemeStore\Http\Requests\Theme\Release;

use LaravelReady\ThemeStore\Http\Requests\ApiFormRequest;

class UpdateReleaseRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'version' => 'string|min:1|max:20',
            'notes' => 'string|min:1',
            'status' => 'boolean',
        ];
    }
}
