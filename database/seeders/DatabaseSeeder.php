<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(AirportSeeder::class);
        $this->call(FormServicesSeeder::class);
        $this->call(EliteServiceTypeSeeder::class);
        $this->call(EliteServiceFeatureSeeder::class);
        $this->call(SubmissionStatusSeeder::class);
    }
}
