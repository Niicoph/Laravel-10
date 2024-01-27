<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
       $users = User::all(); // recuperamos todos los usuarios, dado que cada evento pertenece a un usuario

       for ($i = 0 ; $i < 200 ; $i++) {
            $user = $users->random(); // seleccionamos un usuario aleatorio
            Event::factory()->create([  // creamos un evento con el usuario aleatorio
                'user_id' => $user->id,
            ]);
       } 



    }
}
