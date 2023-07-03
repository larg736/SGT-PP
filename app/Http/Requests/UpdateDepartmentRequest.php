<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateDepartmentRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'name' => [
                'required', 'string',
            ],
            'description' => [
                'required', 'string',
            ]
        ];
    }
    public function authorize()
    {
        return Gate::allows('department_access');
    }
    
}
