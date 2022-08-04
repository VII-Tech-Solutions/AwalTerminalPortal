<?php

namespace Database\Seeders;

use App\Models\ContactUsContent;
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
        $this->call(ContectUsContentSeeder::class);
        $this->call(HomepageContentSeeder::class);
        $this->call(OurStoryContentSeeder::class);
        $this->call(BulletPointsContentSeeder::class);
        $this->call(ImageGalleryContentSeeder::class);
        $this->call(GeneralAviationContentSeeder::class);
        $this->call(TourTheTerminalContentSeeder::class);
        $this->call(ServicesContentSeeder::class);
        $this->call(EliteServicesContentSeeder::class);
        $this->call(CountrySeeder::class);
    }
}
