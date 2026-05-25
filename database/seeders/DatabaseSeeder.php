<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder; 

class DatabaseSeeder extends Seeder
{
//    public function run(): void
//    {
//        $this->call(TestDataSeeder::class);
//    }

    public function run()
    {
        $this->call([
            PlacesTableSeeder::class,
            EventsTableSeeder::class,
            MeetingsTableSeeder::class,
        ]);
    }
}
