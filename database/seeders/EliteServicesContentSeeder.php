<?php

namespace Database\Seeders;

use App\Constants\Attributes;
use App\Models\EliteServicesContent;
use Illuminate\Database\Seeder;

class EliteServicesContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EliteServicesContent::createOrUpdate([
            Attributes::ID => 1,
            Attributes::BACKGROUND_IMAGE_1 => "Zr6XqLyArrqb5ZuzbiKQSplmZauopq-metaZWxpdGUgc2VydmljZXMgbmV3IGhlYWRlciBpbWFnZS5wbmc=-.png",
            Attributes::BACKGROUND_IMAGE_2 => "08KycZB6lfevKv7OqzkEOAsLR1c5CA-metacmVjdGFuZ2xlLWNvcHktMTJAMnguanBn-.jpg",
            Attributes::BACKGROUND_IMAGE_3 => "wUTQNEvoFmyEHKQRnvwbS2eluoWSU0-metac2VydmljZXMgZWxpdGUgaW1hZ2UgNy5wbmc=-.png",
            Attributes::HEADING_TOP_1 => "Elite Services",
            Attributes::HEADING_TOP_2 => "5-star hospitality services",
            Attributes::HEADING_1 => "The only way to travel",
            Attributes::HEADING_2 => "5-star hospitality services",
            Attributes::HEADING_3 => "A luxurious lounge",
            Attributes::HEADING_4 => "Plan for comfort",
            Attributes::HEADING_5 => "Experience the terminal",
            Attributes::HEADING_6 => "The VIP treatment",
            Attributes::SUBHEADING_1 => "We ensure all travelers looking for luxury enjoy an exceptionally smooth, comfortable, and elegant airport experience.",
            Attributes::PARAGRAPH_1 => "<p>Whether you are arriving at or departing from the Kingdom, <strong>Hala Bahrain</strong> agents will assist you with all travel formalities while you relax in one of our luxurious lounges and enjoy our warm hospitality.</p>",
            Attributes::PARAGRAPH_2 => "For total comfort and sublime luxury, try our elite services. From your arrival or departure, we will take care of everything. We pride ourselves on extending the warm hospitality Bahrain is known for.",
            Attributes::PARAGRAPH_3 => "<p>Once your booking is received, our team will review the details and an email will be sent back confirming the booking.&nbsp;</p><p><strong>Requests require a minimum of 24 hours to be confirmed.</strong></p>",
            Attributes::PARAGRAPH_4 => "Following careful renovation to maintain its historical identity, the terminal serves any passenger, whether VIP or business passengers.",
            Attributes::SQUARE_IMAGE_1 => "EInQYkEH51K9ZVVY0OVK1z8AfBq6wR-metacmVjdGFuZ2xlLWNvcHktOUAyeC5qcGc=-.jpg",
            Attributes::TEXT_1 => '<p>For further assistance, please contact the Bookings Team on <a href="tel:+97339471116">+973 39471116</a> or <a href="mailto:elite@halabahrain.bh">elite@halabahrain.bh</a></p>',
            Attributes::BIG_IMAGE_1 => "KUN7h6jsbTImY2cKakFVQyLyg29CC7-metac2VydmljZXMgZWxpdGUgaW1hZ2UgNS5wbmc=-.png",
            Attributes::BULLET_POINT_1 => "Names",
            Attributes::BULLET_POINT_2 => "Dates of Birth",
            Attributes::BULLET_POINT_3 => "Nationalities",
            Attributes::BULLET_POINT_4 => "Passport Numbers",
            Attributes::BULLET_POINT_5 => "Passport Expiry Dates",
            Attributes::BULLET_POINT_6 => "Flight Number",
            Attributes::BULLET_POINT_7 => "Guest Names",
            Attributes::SQUARE_IMAGE_2 => "OwIY6kGppNBZ4fGkvyULzRTeNTsSgH-metacmVjdGFuZ2xlQDJ4LmpwZw==-.jpg",
        ], [Attributes::ID]);
    }
}
