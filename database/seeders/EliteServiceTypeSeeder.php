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
            Attributes::ID => 1,
            Attributes::NAME => "Common Lounge",
            Attributes::PRICE_PER_ADULT => 100
        ], [Attributes::NAME]);

        EliteServiceTypes::createOrUpdate([
            Attributes::ID => 2,
            Attributes::NAME => "Private Lounge",
            Attributes::PRICE_PER_ADULT => 200
        ], [Attributes::NAME]);
    }
}
