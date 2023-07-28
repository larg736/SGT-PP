<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreCategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => [
                'required', 'string',
            ],
            'department_id' => [
                'required', 'string',
            ],
        ];
    }

    public function authorize()
    {
        return Gate::allows('category_access');
    }
}
