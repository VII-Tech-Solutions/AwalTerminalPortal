<?php

namespace Database\Seeders;

use App\Constants\Attributes;
use App\Models\ServicesContent;
use Illuminate\Database\Seeder;

class ServicesContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServicesContent::createOrUpdate([
            Attributes::ID => 1,
            Attributes::BACKGROUND_IMAGE_1 => "EswEGoQ5uDzQZelIbodIbmEpeeevst-metac2VydmljZXMgaW1hZ2UgMS5wbmc=-.png",
            Attributes::BACKGROUND_IMAGE_2 => "Xdazyy4PS45DDwucmZh8tIdER0bw8J-metac2VydmljZXMgaW1hZ2UgMi5wbmc=-.png",
            Attributes::BACKGROUND_IMAGE_3 => "kvlurvIhgU6pKlSKKVNUeHrEkP3RsA-metac2VydmljZXMgaW1hZ2UgMy5wbmc=-.png",
            Attributes::HEADING_TOP_1 => "Our Services",
            Attributes::HEADING_TOP_2 => "5-star hospitality services",
            Attributes::HEADING_1 => "Unmatched luxurious facilities",
            Attributes::HEADING_2 => "Smooth, seamless, sublime",
            Attributes::HEADING_3 => "5-star Facilities",
            Attributes::HEADING_4 => "Experience the luxurious",
            Attributes::SUBHEADING_1 => "Enjoy an incredibly smooth, comfortable, and elegant airport experience. Passengers are greeted by our agents who handle all travel formalities.",
            Attributes::PARAGRAPH_1 => "A state-of-the-art facility with 5-star hospitality services. The terminal comprises of eight elegant private lounges and two comfortable common lounges, a meeting room, and Duty-Free offerings designed to meet the needs of any passenger.",
            Attributes::COLUMN_1_HEADING_1 => "Elite Services",
            Attributes::COLUMN_1_PARAGRAPH_1 => "Through our Elite Service, we ensure any traveler, and any Commercially Important Persons (CIPs) that seek luxurious experiences, an exceptionally smooth and pleasant airport experience.",
            Attributes::COLUMN_2_HEADING_1 => "General Aviation",
            Attributes::COLUMN_2_PARAGRAPH_1 => "Hala Bahrain's experienced flight coordinators are on hand 24/7 to provide exceptional support services to aircraft crew and passenger, and prepare the aircraft for the turnaround process.",
            Attributes::BULLET_POINT_1 => "8 private lounges and 2 common lounges",
            Attributes::BULLET_POINT_2 => "Prayer rooms for men and women",
            Attributes::BULLET_POINT_3 => "Dedicated immigration and police screening areas",
            Attributes::BULLET_POINT_4 => "Personal assistant for Duty-Free shopping",
            Attributes::BULLET_POINT_5 => "Dedicated car service between the Awal Private Terminal and departure gates/ flights",
            Attributes::BULLET_POINT_6 => "The terminal is also open to passengers' guests who are not traveling",
            Attributes::BULLET_POINT_7 => "Convenient VIP parking and drop-off at the curbside for quick access",
            Attributes::BULLET_POINT_8 => "All travel formalities, including check-in, immigration, and baggage are handled by a personal assistant",
        ], [Attributes::ID]);
    }
}
