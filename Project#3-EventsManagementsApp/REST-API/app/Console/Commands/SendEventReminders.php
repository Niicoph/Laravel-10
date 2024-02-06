<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Notifications\EventReminderNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SendEventReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    public function handle() {
        $events = Event::with('attendees.user')
            ->whereBetween('start_time' , [now() , now()->addDay()])
            ->get();


        $eventsCount = $events->count();
 

        $this->info("Found {$eventsCount}");

        $events->each( 
            fn ($event) => $event->attendees->each( 
                fn ($attendee) => $attendee->user->notify(
                new EventReminderNotification($event)
                    )
                )
            );

        $this->info('Reminder notifications sent successfully!');
    }
}
