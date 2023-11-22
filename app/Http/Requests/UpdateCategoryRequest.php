<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateCategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => [
                'required', 'string',
            ],
            
        ];
    }

    public function authorize()
    {
        return Gate::allows('category_access');
    }
}
