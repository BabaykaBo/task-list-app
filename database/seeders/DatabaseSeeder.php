<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //  \App\Models\User::factory(10)->create();

        //  \App\Models\Task::factory(25)->create();
        $user = User::find(1);
        \App\Models\Task::factory(7)->forUser($user->id)->create();
    }
}
