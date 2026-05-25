<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meeting;

class MeetingsTableSeeder extends Seeder
{
    public function run()
    {
        $meetings = [
            ['place_id' => 1, 'event_id' => 1, 'meeting_date' => '2026-06-15', 'meeting_time' => '19:00:00', 'note' => 'Ложа свободна'],
            ['place_id' => 2, 'event_id' => 2, 'meeting_date' => '2026-06-20', 'meeting_time' => '18:30:00', 'note' => 'Парковка при входе'],
            ['place_id' => 3, 'event_id' => 3, 'meeting_date' => '2026-06-25', 'meeting_time' => '20:00:00', 'note' => 'Билеты в фойе'],
            ['place_id' => 4, 'event_id' => 4, 'meeting_date' => '2026-07-01', 'meeting_time' => '15:00:00', 'note' => 'Для людей с инвалидностью вход свободный'],
            ['place_id' => 5, 'event_id' => 5, 'meeting_date' => '2026-07-05', 'meeting_time' => '19:30:00', 'note' => 'Бронирование по телефону'],
        ];

        foreach ($meetings as $meeting) {
            Meeting::create($meeting);
        }
    }
}