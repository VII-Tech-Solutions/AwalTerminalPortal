<?php

namespace Database\Seeders;

use App\Constants\Attributes;
use App\Models\TourTheTerminalContent;
use Illuminate\Database\Seeder;

class TourTheTerminalContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TourTheTerminalContent::createOrUpdate([
            Attributes::ID => 1,
            Attributes::BACKGROUND_IMAGE_1 => "kUxFmBRrHVFRBy1E7cdOTLvb8vYFYV-metadG91ciBpbWFnZSAxLnBuZw==-.png",
            Attributes::HEADING_TOP_1 => "TOUR THE TERMINAL",
            Attributes::HEADING_1 => "Experience a new way of travel",
            Attributes::HEADING_2 => "Arrive in Style",
            Attributes::HEADING_3 => "Walk through the terminal",
            Attributes::HEADING_4 => "Private and Personal",
            Attributes::HEADING_5 => "Tailored to your travel needs",
            Attributes::SUBHEADING_1 => "Enjoy an elite, elegant safe haven for all travelers looking for a luxurious experience. Welcome private planes, then transit and depart in style. ",
            Attributes::PARAGRAPH_1 => "With our prime location, getting to Awal Private Terminal is easy. You’re greeted by our friendly and professional staff immediately, catering to all your travel needs.",
            Attributes::PARAGRAPH_2 => "Following careful renovations, our interiors are the reflection of comfort and luxury. Feel at ease while relaxing at our common lounge with friends and family until your departure.",
            Attributes::PARAGRAPH_3 => "The Awal Private Terminal has ten elegant and luxurious lounges. Each lounge is named after a city in Bahrain and fully designed for comfort and an unforgettable experience.",
            Attributes::IMAGE_1 => "AVlIygkcXYWCloKUYpKRLY6SdzCQDm-metaZ3JvdXBAMnguanBn-.jpg",
            Attributes::VISIBLE_1 => "1",
            Attributes::VIDEO_1 => "https://www.youtube.com/embed/W7moteMUN7A?rel=0?controls=0",
            Attributes::BACKGROUND_IMAGE_2 => "4yU2NnZrzKtw7TW27K16r4PUV90wvO-metadG91ciBpbWFnZSA1LnBuZw==-.png",
            Attributes::HEADING_TOP_2 => "5-star hospitality services",
        ], [Attributes::ID]);
    }
}
