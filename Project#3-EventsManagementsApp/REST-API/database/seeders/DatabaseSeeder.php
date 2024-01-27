<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        \App\Models\User::factory(1000)->create(); // first we create 1000 users
        // then we call the respective seeders for events and attendees. For doing this, we previously need to have users
        $this->call(EventSeeder::class);
        $this->call(AttendeeSeeder::class);

    }
}
