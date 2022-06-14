<?php

namespace Database\Seeders;

use App\Constants\Attributes;
use App\Models\EliteServiceTypes;
use Illuminate\Database\Seeder;

class EliteServiceTypeSeeder extends Seeder
{
    public function run()
    {
        EliteServiceTypes::createOrUpdate([
            Attributes::NAME=> "Common Lounge",
            Attributes::PRICE_PER_ADULT => 100
        ]);

        EliteServiceTypes::createOrUpdate([
            Attributes::NAME=> "Private Lounge",
            Attributes::PRICE_PER_ADULT => 150
        ]);
    }
}
