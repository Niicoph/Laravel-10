<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Event;
use \App\Models\Attendee;

class AttendeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $users = User::all(); 
        $events = Event::all();

        foreach ($users as $user) {   // iteramos sobre todos los usuarios
            $eventsToAttend = $events->random(rand(1,3));   // seleccionamos entre 1 y 3 eventos aleatorios, para almacenarlos en una variable (seran los eventos a ser atendidos) 
            foreach ($eventsToAttend as $event) {   // iteramos sobre los eventos a ser atendidos
                Attendee::create([                  // creamos un asistente con el usuario y el evento
                    'user_id' => $user->id,
                    'event_id' => $event->id,
                ]);
            }
        }
    }
}
