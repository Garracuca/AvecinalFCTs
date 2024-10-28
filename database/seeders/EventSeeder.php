<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $events = [
            [
                'event' => 'Turno #1',
                'start_date' => '2024-11-16 08:00',
                'end_date' => '2024-11-16 11:00',
            ],
            [
                'event' => 'Turno #2',
                'start_date' => '2024-11-17 10:00',
                'end_date' => '2024-11-17 11:00',
            ],
            [
                'event' => 'Turno #3',
                'start_date' => '2024-11-19 08:00',
                'end_date' => '2024-11-19 11:00',
            ],
            [
                'event' => 'Turno #4',
                'start_date' => '2024-11-20 09:00',
                'end_date' => '2024-11-20 11:00',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
