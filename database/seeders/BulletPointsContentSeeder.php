<?php

namespace Database\Seeders;

use App\Constants\Attributes;
use App\Models\BulletPointsContent;
use Illuminate\Database\Seeder;

class BulletPointsContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BulletPointsContent::createOrUpdate([
            Attributes::ID => 1,
            Attributes::TEXT => "8 private lounges as well as common lounges",
            Attributes::SECTION_CONTENT_ID => "4",
        ], [Attributes::ID]);



        BulletPointsContent::createOrUpdate([
            Attributes::ID => 2,
            Attributes::TEXT => "Dedicated and luxury transportation services ",
            Attributes::SECTION_CONTENT_ID => "4",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 3,
            Attributes::TEXT => "All travel formalities are handled",
            Attributes::SECTION_CONTENT_ID => "4",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 4,
            Attributes::TEXT => "Passengers' guests are welcome to stay",
            Attributes::SECTION_CONTENT_ID => "4",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 5,
            Attributes::TEXT => "Personal assistant for Duty-Free shopping",
            Attributes::SECTION_CONTENT_ID => "4",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 6,
            Attributes::TEXT => "Prayer rooms for men and women",
            Attributes::SECTION_CONTENT_ID => "4",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 7,
            Attributes::TEXT => "Dedicated immigration and police screening areas",
            Attributes::SECTION_CONTENT_ID => "4",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 8,
            Attributes::TEXT => "Dedicated car service between the Awal Private Terminal and departure gates/ flights",
            Attributes::SECTION_CONTENT_ID => "4",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 9,
            Attributes::TEXT => "The terminal is also open to passengers' guests who are not traveling",
            Attributes::SECTION_CONTENT_ID => "4",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 10,
            Attributes::TEXT => "Convenient VIP parking and drop-off at the curbside for quick access",
            Attributes::SECTION_CONTENT_ID => "4",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 11,
            Attributes::TEXT => "All travel formalities, including check-in, immigration, and baggage are handled by a personal assistant",
            Attributes::SECTION_CONTENT_ID => "4",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 12,
            Attributes::TEXT => "Aircraft type",
            Attributes::SECTION_CONTENT_ID => "3",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 13,
            Attributes::TEXT => "Arrival/Departure Dates",
            Attributes::SECTION_CONTENT_ID => "3",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 14,
            Attributes::TEXT => "Registration Number",
            Attributes::SECTION_CONTENT_ID => "3",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 15,
            Attributes::TEXT => "Operator Info",
            Attributes::SECTION_CONTENT_ID => "3",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 16,
            Attributes::TEXT => "Call Sign",
            Attributes::SECTION_CONTENT_ID => "3",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 17,
            Attributes::TEXT => "Lead Passenger Name",
            Attributes::SECTION_CONTENT_ID => "3",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 18,
            Attributes::TEXT => "Names",
            Attributes::SECTION_CONTENT_ID => "6",
        ], [Attributes::ID]);

        BulletPointsContent::createOrUpdate([
            Attributes::ID => 19,
            Attributes::TEXT => "Passport Expory dates",
            Attributes::SECTION_CONTENT_ID => "6",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 20,
            Attributes::TEXT => "date of birth",
            Attributes::SECTION_CONTENT_ID => "6",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 21,
            Attributes::TEXT => "flight number",
            Attributes::SECTION_CONTENT_ID => "6",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 22,
            Attributes::TEXT => "nationalities",
            Attributes::SECTION_CONTENT_ID => "6",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 23,
            Attributes::TEXT => "guest names",
            Attributes::SECTION_CONTENT_ID => "6",
        ], [Attributes::ID]);


        BulletPointsContent::createOrUpdate([
            Attributes::ID => 24,
            Attributes::TEXT => "passport numbers",
            Attributes::SECTION_CONTENT_ID => "6",
        ], [Attributes::ID]);

    }
}
