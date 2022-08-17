<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Country;
use App\Models\Containent;
use Illuminate\Database\Seeder;
use Database\Factories\CountryFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $containents = [
            [
                'id' => 1,
                'name' => 'Europe'
            ],
            [
                'id' => 2,
                'name' => 'Asia'
            ],
            [
                'id' => 3,
                'name' => 'Africa'
            ],
            [
                'id' => 4,
                'name' => 'South Amercia'
            ],
            [
                'id' => 5,
                'name' => 'North Amercia'
            ],
        ];

        foreach ($containents as $containent) {
            Containent::factory()->create($containent)
                ->each(function($containent) {
                    $containent->countries()->saveMany(Country::factory(20)->make());
                });
        }
    }
}
