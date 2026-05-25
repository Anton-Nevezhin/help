<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Place;

class PlacesTableSeeder extends Seeder
{
    public function run()
    {
        $places = [
            ['name' => 'Никитинский театр', 'address' => 'ул. Никитина, 10', 'phone' => '8-495-123-45-67'],
            ['name' => 'Воронежский концертный зал', 'address' => 'пр. Революции, 50', 'phone' => '8-473-123-45-67'],
            ['name' => 'Дом офицеров', 'address' => 'ул. Плехановская, 33', 'phone' => '8-473-123-45-68'],
            ['name' => 'Театр оперы и балета', 'address' => 'пл. Ленина, 7', 'phone' => '8-473-123-45-69'],
            ['name' => 'Кинотеатр "Спартак"', 'address' => 'ул. Кольцовская, 56', 'phone' => '8-473-123-45-70'],
        ];

        foreach ($places as $place) {
            Place::create($place);
        }
    }
}