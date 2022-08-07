<?php

namespace Database\Seeders;

use App\Constants\Attributes;
use App\Models\HomepageContent;
use Illuminate\Database\Seeder;

class HomepageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HomepageContent::createOrUpdate([
            Attributes::ID => 1,
            Attributes::BACKGROUND_IMAGE_1 => "j8tcAXKopiGaL12To739gBPgHC2u4R-metaaG9tZSBpbWFnZSAxLnBuZw==-.png",
            Attributes::BACKGROUND_IMAGE_2 => "8RJYiYnADLPMhM4GP3k1EBzPt38hXA-metacmVjdGFuZ2xlQDN4LmpwZw==-.jpg",
            Attributes::BACKGROUND_IMAGE_3 => "plkvSN9R5SUPNyBVOh5Dug8nyhllHI-metacmVjdGFuZ2xlLWNvcHktNkAyeC5qcGc=-.jpg",
            Attributes::BACKGROUND_IMAGE_4 => "YzROHeB5gpHHW5hOUqupKQgUTpyUnj-metacmVjdGFuZ2xlLWNvcHktOEAyeC5qcGc=-.jpg",
            Attributes::HEADING_TOP_1 => "Welcome to Awal Private Terminal",
            Attributes::HEADING_TOP_2 => "5-star hospitality services",
            Attributes::HEADING_1 => "An unforgettable journey",
            Attributes::HEADING_2 => "Total Comfort.  A Life of Luxury.",
            Attributes::HEADING_3 => "Tailored to suit your travel needs.",
            Attributes::HEADING_4 => "Where safety meets luxury",
            Attributes::SUBHEADING_1 => "An exclusive travel experience. Awal Private Terminal, operated by Hala Bahrain, is setting new standards of luxury for private aircraft users and elite guests on commercial flights.",
            Attributes::PARAGRAPH_1 => "<p><strong>We’ll take it from here.</strong> Whether you are arriving at or departing from the Kingdom of Bahrain, Hala Bahrain, the service provider of Awal Private Terminal, will assist you with all your travel needs and formalities. Your guests are our guests. The terminal is also open to passengers' guests who are not traveling with convenient VIP parking and drop-off.</p>",
            Attributes::PARAGRAPH_2 => "We take pride in our history. The building was the Kingdom’s first international airport, operating in the 1960s and 1970s. Following careful renovation to maintain its historical identity, the terminal serves anyone, from VIP to business private passengers.",
            Attributes::PARAGRAPH_3 => "Hala Bahrain agents will assist you with all travel formalities while you relax and unwind in one of our luxurious lounges and enjoy our warm hospitality.",
            Attributes::PARAGRAPH_4 => "Awal Private Terminal brings you eight elegant private lounges, along with two common lounges. Each lounge follows a specific theme and color palette, expertly designed to merge the traditional, the modern, and the luxurious – as a reflection of our kingdom.",
            Attributes::SQUARE_IMAGE_1 => "tLopuKMHDdtM3NjhNG2CictBsPB4sd-metacmVjdGFuZ2xlQDJ4LmpwZw==-.jpg",
            Attributes::IMAGE_1 => "6J1EuxkKoWtT5BrnARfxefkNOiz6vx-metacmVjdGFuZ2xlQDJ4LmpwZw==-.jpg",
            Attributes::IMAGE_2 => "fdpGJyBxwmECiS30rpzb6PbXNMmVpO-metaaG9tZSBpbWFnZSA3LnBuZw==-.png",
            Attributes::SECTION_IMAGE_1 => "5q9YigpbTbdN8p3uKTSZbGlkVl63fl-metaaG9tZSBpbWFnZSA1LnBuZw==-.png",
            Attributes::BULLET_POINT_1 => "8 private lounges and 2 common lounges",
            Attributes::BULLET_POINT_2 => "Dedicated and luxury transportation services ",
            Attributes::BULLET_POINT_3 => "All travel formalities are handled",
            Attributes::BULLET_POINT_4 => "On-site and accessible meeting room",
            Attributes::BULLET_POINT_5 => "Personal assistant for Duty-Free shopping"
        ], [Attributes::ID]);
    }
}
