<?php

use App\Event;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::truncate();
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 10; $i++){
            Event::create([
                'label' => $faker->lastName,
                'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'location' => 'salle '.rand(101, 109),
                'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'price' => '10.00',
                'recurring' => rand(0, 1),
                'meta_event_id' => rand(1, 10),
            ]);
        }
    }
}
