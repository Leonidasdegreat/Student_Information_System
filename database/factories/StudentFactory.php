<?php
namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password123'), // Default password
            'address' => $this->faker->address,
            'role' => $this->faker->randomElement(['student', 'admin']),
            'age' => $this->faker->numberBetween(18, 25),
            'email_verified_at' => now(), // Auto-verified emails
        ];
    }
}
