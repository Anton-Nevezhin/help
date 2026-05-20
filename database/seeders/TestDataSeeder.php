<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder; 
use App\Models\Place;
use App\Models\Event;
use App\Models\Meeting;
use App\Models\User;


class TestDataSeeder extends Seeder
{
    public function run()
    {


        // 20 мест
        $places = [];
        for ($i = 1; $i <= 20; $i++) {
            $places[] = Place::create([
                'name' => "Место {$i}",
                'address' => "Улица {$i}, дом {$i}",
                'phone' => "+7 (900) 123-{$i}",
            ]);
        }

        // 40 мероприятий
        $events = [];
        for ($i = 1; $i <= 40; $i++) {
            $events[] = Event::create([
                'name' => "Мероприятие {$i}",
                'author' => "Автор {$i}",
                'details' => "Описание {$i}",
                'note' => "Примечание {$i}",
            ]);
        }

        // 40 пользователей
        $users = [];
        for ($i = 1; $i <= 40; $i++) {
            $role = $i % 2 == 0 ? 'admin' : 'user';

            $users[] = User::create([
                'name' => "Пользователь {$i}",
                'email' => "user{$i}@test.ru",
                'phone' => "Телефон {$i}",
                'telegram_id' => "Телеграм {$i}",
                'whatsapp_phone' => "Вацап {$i}",
                'vk_id' => "Вконтакте {$i}",
                'role' => $role,
                'password' => bcrypt('password123'),
            ]);
        }

        // 60 событий
        
        for ($i = 1; $i <= 60; $i++) {
            $place = $places[array_rand($places)];
            $event = $events[array_rand($events)];
            $randomDate = date('Y-m-d', strtotime('+' . rand(-30, 60) . ' days'));
            
            Meeting::create([
                'place_id' => $place->id,
                'event_id' => $event->id,
                'meeting_date' => $randomDate,
                'meeting_time' => rand(10, 20) . ':' . str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT),
                'note' => "Примечание {$i}",
            ]);
        }

        
    }
}
