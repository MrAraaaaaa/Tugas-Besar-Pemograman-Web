<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::insert([
            ['name' => 'Ajeng', 'class' => '12', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rizki', 'class' => '12', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Aulia', 'class' => '12', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'M Rizki', 'class' => '12', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gezant', 'class' => '12', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ashabil', 'class' => '12', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

