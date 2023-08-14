<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::all()->each(function ($user) {
        User::cursor()->each(function ($user) {
            $user->projects()->saveMany(
                Project::factory()
                    ->count(rand(1, 3))
                    ->hasTasks(rand(1, 3))
                    ->make()
            );
        });
    }
}
