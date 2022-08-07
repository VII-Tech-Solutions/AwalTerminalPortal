<?php

namespace Database\Seeders;

use App\Constants\Attributes;
use App\Models\OurStoryContent;
use Illuminate\Database\Seeder;

class OurStoryContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OurStoryContent::createOrUpdate([
            Attributes::ID => 1,
            Attributes::BACKGROUND_IMAGE_1 => "rYifs29zqLcMeX0nUwmuTQq3aOiz68-metacmVjdGFuZ2xlQDJ4LmpwZw==-.jpg",
            Attributes::BACKGROUND_IMAGE_2 => "ROZWpoJUxehJ7Jy9uB18hK6ZF2V6tC-metacmVjdGFuZ2xlLWNvcHktMTJAMnguanBn-.jpg",
            Attributes::BACKGROUND_IMAGE_3 => "IxZqn0B3BRPMvVW5QsSDoaASZvnf6l-metacmVjdGFuZ2xlLWNvcHlAMnguanBn-.jpg",
            Attributes::HEADING_TOP_1 => "Our Story",
            Attributes::HEADING_TOP_2 => "5-star hospitality services",
            Attributes::HEADING_1 => "The Premium  Awal Private Terminal",
            Attributes::HEADING_2 => "Where history meets luxury",
            Attributes::HEADING_3 => "A journey through time",
            Attributes::HEADING_4 => "The perfect location",
            Attributes::HEADING_5 => "Tailored to suit your needs",
            Attributes::HEADING_6 => "A luxurious journey",
            Attributes::SUBHEADING_1 => "We take pride in and honor our history. The building was the Kingdom’s first international airport, in the 1960s. The terminal now serves anyone from VIP to business passengers.",
            Attributes::SUBHEADING_2 => "Awal Private Terminal through the decades",
            Attributes::PARAGRAPH_1 => "Our welcoming staff are committed to ensure that  your arrival, departure or transit at Bahrain International Airport is convenient and comfortable. Regardless of your airline, travel class, or duration of stay in the Kingdom, we pride ourselves on extending the warm hospitality Bahrain is known for.

Our user-friendly and easily accessible services include, but are not limited to, Meet and Assist, Lounge, Porterage, and Baggage Wrapping. We also provide assistance services that extend from the moment you arrive at the airport until you take your seat aboard the aircraft.",
            Attributes::PARAGRAPH_2 => "The Awal Private Terminal is located in Muharraq and provides services to those travelling by private jet or on commercial flights. The terminal is operated by premium hospitality service provider, Hala Bahrain.",
            Attributes::PARAGRAPH_3 => "Hala Bahrain offers a wide rande of premium hospitality services, packages, and facilities that turn your dream travel experience into a reality. From your arrival to your departure, we ensure an unforgettable experience.",
            Attributes::PARAGRAPH_4 => "Hala Bahrain offers a wide rande of premium hospitality services, packages, and facilities that turn your dream travel experience into a reality.",
            Attributes::QUOTE_1 => "“At Hala Bahrain, we work to turn your dream travel experience into reality.”",
            Attributes::IMAGE_1 => "wMvMCILlhN81565NBCRGqHM66SUhZM-metacmVjdGFuZ2xlQDJ4LmpwZw==-.jpg",
            Attributes::IMAGE_2 => "3cQEZNORyWrURnxuA9P4iBGDEiQWJa-metab3VyIHN0b3J5IGltYWdlIDUucG5n-.png",
            Attributes::COLUMN_1_HEADING_1 => "Elite Services",
            Attributes::COLUMN_1_PARAGRAPH_1 => "Through our Elite Service, we ensure any traveler, and any Commercially Important Persons (CIPs) that seek luxurious experiences, an exceptionally smooth and pleasant airport experience.",
            Attributes::COLUMN_2_HEADING_1 => "General Aviation",
            Attributes::COLUMN_2_PARAGRAPH_1 => "Hala Bahrain's experienced flight coordinators are on hand 24/7 to provide exceptional support services to aircraft crew and passenger, and prepare the aircraft for the turnaround process.",
        ], [Attributes::ID]);
    }
}
