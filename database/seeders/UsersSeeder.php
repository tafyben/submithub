<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some students
        $students = [
            ['name' => 'John Student', 'email' => 'student1@example.com', 'password' => bcrypt('password')],
            ['name' => 'Jane Student', 'email' => 'student2@example.com', 'password' => bcrypt('password')],
        ];

        foreach ($students as $student) {
            $user = User::create($student);
            $user->assignRole('student');
        }

        // Create some admins
        $admins = [
            ['name' => 'Alice Admin', 'email' => 'admin@submithub.com', 'password' => bcrypt('password')],
            ['name' => 'Bob Admin', 'email' => 'admin2@example.com', 'password' => bcrypt('password')],
        ];

        foreach ($admins as $admin) {
            $user = User::create($admin);
            $user->assignRole('admin');
        }
    }

}
