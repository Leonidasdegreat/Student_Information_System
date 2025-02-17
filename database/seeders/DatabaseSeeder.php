<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\StudentsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call the StudentsTableSeeder to seed the students table
        $this->call(StudentsTableSeeder::class);
    }
}
