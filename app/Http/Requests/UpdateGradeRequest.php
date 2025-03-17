<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGradeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Allow all users or modify logic as needed
    }

    public function rules(): array
    {
        return [
            'grade' => [
                'required',
                'in:1.0,1.25,1.5,1.75,2.0,2.25,2.5,2.75,3.0,3.25,3.5,3.75,4.0,4.25,4.5,4.75,5.0'
            ],
        ];
    }

    public function messages()
    {
        return [
            'grade.required' => 'The grade is required.',
            'grade.in' => 'The grade must be one of the following: 1.0, 1.25, 1.5, 1.75, 2.0, 2.25, 2.5, 2.75, 3.0, 3.25, 3.5, 3.75, 4.0, 4.25, 4.5, 4.75, 5.0.',
        ];
    }
}
