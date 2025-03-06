<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:6|confirmed',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'role' => 'required|in:student,admin',
            'age' => 'required|integer|min:16|max:100', // Ensure a valid age range
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'email.unique' => 'This email is already registered.',
            'password.confirmed' => 'Passwords do not match.',
            'age.min' => 'Age must be at least 16.',
            'age.max' => 'Age cannot exceed 100.',
        ];
    }
}
