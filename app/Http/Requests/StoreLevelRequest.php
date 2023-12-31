<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreLevelRequest extends FormRequest
{
    public function rules()
    {
        return [
            'department_id' => [
                'required', 'string',
            ],
            'name' => [
                'required', 'string',
            ],
        ];
    }

    public function authorize()
    {
        return Gate::allows('level_access');
    }
}
