<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventsTableSeeder extends Seeder
{
    public function run()
    {
        $events = [
            ['name' => 'Щелкунчик', 'author' => 'Чайковский', 'details' => 'Балет в двух актах', 'note' => 'Детям до 12 лет скидка 30%'],
            ['name' => 'Концерт классической музыки', 'author' => 'Воронежский симфонический оркестр', 'details' => 'Бетховен, Моцарт, Шопен', 'note' => 'Начало в 19:00'],
            ['name' => 'Вечер джаза', 'author' => 'Jazz Band', 'details' => 'Джазовые стандарты и импровизации', 'note' => 'Билеты в кассе'],
            ['name' => 'Мастер-класс по рисованию', 'author' => 'Художественная школа', 'details' => 'Акварель для начинающих', 'note' => 'Все материалы предоставляются'],
            ['name' => 'Спектакль "Ревизор"', 'author' => 'Гоголь', 'details' => 'Комедия в 5 действиях', 'note' => '18+'],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}