<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow request execution
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $this->route('student'),
            'password' => 'nullable|string|min:6|confirmed',
            'address' => 'required|string|max:255',
            'role' => 'required|in:student,admin',
            'age' => 'required|integer|min:16|max:100',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'email.unique' => 'This email is already taken.',
            'password.confirmed' => 'Passwords do not match.',
            'age.min' => 'Age must be at least 16.',
            'age.max' => 'Age cannot exceed 100.',
        ];
    }
}
