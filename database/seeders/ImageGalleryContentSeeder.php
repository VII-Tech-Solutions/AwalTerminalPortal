<?php

namespace Database\Seeders;

use App\Constants\Attributes;
use App\Models\ImageGalleryContent;
use Illuminate\Database\Seeder;

class ImageGalleryContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImageGalleryContent::createOrUpdate([
            Attributes::ID => 1,
            Attributes::IMAGE => "YnDpmV5JqZLDj2Wurau3lrqZTmUUlW-metaMjY4LTIwMHgzMDAuanBlZw==-.jpg",
            Attributes::CAPTION => "External view of the terminal after renovation",
            Attributes::SECTION_CONTENT_ID => "3",
        ], [Attributes::ID]);


        ImageGalleryContent::createOrUpdate([
            Attributes::ID => 2,
            Attributes::IMAGE => "OZFvHxsJHBbuaMaTfkTAaqZ90LClZ3-metaMjY4LTIwMHgzMDAuanBlZw==-.jpg",
            Attributes::CAPTION => "Internal view of the terminal after renovation",
            Attributes::SECTION_CONTENT_ID => "3",
        ], [Attributes::ID]);


        ImageGalleryContent::createOrUpdate([
            Attributes::ID => 3,
            Attributes::IMAGE => "VYgTKAQcnqvqx6fmSAPPf0aIKzpBGo-metaMjY4LTIwMHgzMDAuanBlZw==-.jpg",
            Attributes::CAPTION => "‘Manama’ Private Lounge, can seat up to 10 people",
            Attributes::SECTION_CONTENT_ID => "5",
        ], [Attributes::ID]);


        ImageGalleryContent::createOrUpdate([
            Attributes::ID => 4,
            Attributes::IMAGE => "K1HIrZR0jG22a6m8QzCsVKBWjTNst2-metaMjY4LTIwMHgzMDAuanBlZw==-.jpg",
            Attributes::CAPTION => "‘Muharraq’ Private Lounge, can seat up to 10 people",
            Attributes::SECTION_CONTENT_ID => "5",
        ], [Attributes::ID]);
    }
}
