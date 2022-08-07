<?php

namespace Database\Seeders;

use App\Constants\Attributes;
use App\Models\GeneralAviationContent;
use Illuminate\Database\Seeder;

class GeneralAviationContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GeneralAviationContent::createOrUpdate([
            Attributes::ID => 1,
            Attributes::BACKGROUND_IMAGE_1 => "plqIiyqbl2Gdksgcl8zkycDcAViR4R-metac2VydmljZXMgZ2VuZXJhbCBhdmlhdGlvbiBpbWFnZSAxLnBuZw==-.png",
            Attributes::HEADING_TOP_1 => "General aviation",
            Attributes::HEADING_1 => "A journey to remember",
            Attributes::SUBHEADING_1 => "From arrival to transit to departure, we’re here to help you with every aspect of your journey. And setting new standards of luxurious travel experiences.",
            Attributes::PARAGRAPH_1 => "Hala Bahrain's experienced flight coordinators are on standby 24 hours a day to provide exceptional support services to aircraft crew and prepare the aircraft for the turnaround process. A hassle-free and enjoyable experience is what we aim for.",
            Attributes::SQUARE_IMAGE_1 => "NEF2ft1AKSRiR5KxClE9nvgIsnz2hS-metac2VydmljZXMgZ2VuZXJhbCBhdmlhdGlvbiBpbWFnZSAyLnBuZw==-.png",
            Attributes::BIG_IMAGE_1 => "WgVcV58uVgVqssm3xFzKX7rX4G9hhB-metac2VydmljZXMgZ2VuZXJhbCBhdmlhdGlvbiBpbWFnZSAzLnBuZw==-.png",
            Attributes::IMAGE_1 => "Q0lbCFKVT9IB1ptGPj7Ns0SsBSXO1v-metac2VydmljZXMgZ2VuZXJhbCBhdmlhdGlvbiBpbWFnZSA2LnBuZw==-.png",
            Attributes::SECTION_IMAGE_1 => "zzWqUcFMQKUSaLKMbRwiR0EUX728vZ-metac2VydmljZXMgZ2VuZXJhbCBhdmlhdGlvbiBpbWFnZSA4LnBuZw==-.png",
            Attributes::TEXT_1 => '<p>For further assistance, please contact the Bookings Team on <a href="tel:+97339471116">+973 39471116</a> or <a href="mailto:elite@halabahrain.bh">elite@halabahrain.bh</a></p>',
            Attributes::BACKGROUND_IMAGE_2 => "TNQyna3rFMrbxcasCnRxGsx2uStM5E-metac2VydmljZXMgZ2VuZXJhbCBhdmlhdGlvbiBpbWFnZSA3LnBuZw==-.png",
            Attributes::HEADING_TOP_2 => "5-star hospitality services",
            Attributes::HEADING_2 => "Exemplary expert support",
            Attributes::HEADING_3 => "Before you board",
            Attributes::HEADING_4 => "Convenience & Comfort catered to you",
            Attributes::HEADING_5 => "Luxurious moments, total comfort",
            Attributes::HEADING_6 => "Top-tier hospitality",
            Attributes::PARAGRAPH_2 => "<p>Once your booking is received, our team will review the details and an email will be sent back confirming your booking. </p><p><strong>Requests require a minimum of 24 hours to be confirmed.</strong></p>",
            Attributes::PARAGRAPH_3 => "<p>We’ll take it from here. Whether you are arriving at or departing from the Kingdom, <strong>Hala Bahrain</strong> agents will assist you with all travel formalities while you relax in one of our luxurious lounges and enjoy our warm hospitality.</p>",
            Attributes::PARAGRAPH_4 => "Luxurious travel awaits. While we help prepare the aircraft for the take-off, experience the luxurious facilities Awal Terminal provides. Awal Terminal offers you eight elegant private lounges, along with two comfortable common lounges.",
            Attributes::SQUARE_IMAGE_2 => "kpAgUf0auBqfzLPJuWxEpq3ynw9Cu3-metac2VydmljZXMgZ2VuZXJhbCBhdmlhdGlvbiBpbWFnZSA0LnBuZw==-.png",
            Attributes::BULLET_POINT_1 => "Aircraft type",
            Attributes::BULLET_POINT_2 => "Registration Number",
            Attributes::BULLET_POINT_3 => "Call Sign",
            Attributes::BULLET_POINT_4 => "Arrival/Departure Dates",
            Attributes::BULLET_POINT_5 => "Operator Info",
            Attributes::BULLET_POINT_6 => "Lead Passenger Name",
        ], [Attributes::ID]);

    }
}
