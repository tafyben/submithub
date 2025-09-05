<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class SubmithubTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create 10 students
        for ($i = 1; $i <= 10; $i++) {
            $student = User::create([
                'name' => $faker->name,
                'email' => "student{$i}@submithub.test",
                'password' => Hash::make('password'), // default password
            ]);

            $student->assignRole('student');

            // Assign 3-5 assignments per student
            $assignmentsCount = rand(3, 5);

            for ($j = 1; $j <= $assignmentsCount; $j++) {
                Assignment::create([
                    'user_id' => $student->id,
                    'title' => $faker->sentence(3, true), // 3-word title
                    'description' => $faker->paragraph(2, true), // 2-sentence description
                    'status' => $faker->randomElement(['pending', 'submitted', 'completed']),
                    'submitted_at' => null,
                    'feedback' => null,
                ]);
            }
        }

        // Optionally, create 1 admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@submithub.test',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');
    }
}
