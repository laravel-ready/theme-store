<?php

namespace LaravelReady\ThemeStore\Http\Requests\Common;

use LaravelReady\ThemeStore\Http\Requests\ApiFormRequest;

class UploadFilepondRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'filepond' => 'nullable|file|max:2048',
        ];
    }
}
