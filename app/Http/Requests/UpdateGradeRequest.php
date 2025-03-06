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
            'grade' => 'nullable|numeric|min:0|max:100',
        ];
    }

    public function messages()
    {
        return [
            'grade.numeric' => 'The grade must be a number.',
            'grade.min' => 'The grade cannot be less than 0.',
            'grade.max' => 'The grade cannot be more than 100.',
        ];
    }
}
