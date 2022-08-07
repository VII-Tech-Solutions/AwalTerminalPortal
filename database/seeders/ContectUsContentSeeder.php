<?php

namespace Database\Seeders;

use App\Constants\Attributes;
use App\Models\ContactUsContent;
use Illuminate\Database\Seeder;

class ContectUsContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactUsContent::createOrUpdate([
            Attributes::ID => 1,
            Attributes::BACKGROUND_IMAGE_1 => "5iADSuu75JaNidd2X21PUaUcSArKWG-metacmVjdGFuZ2xlQDJ4LmpwZw==-.jpg",
            Attributes::HEADING_TOP_1 => "Contact Us",
            Attributes::HEADING_1 => "We’re here to help",
            Attributes::HEADING_2 => "Share your thoughts",
            Attributes::SUBHEADING_1 => "We work for your traveling experience to be a dream turned into reality.  Let us know how we can help you."
        ], [Attributes::ID]);
    }
}
