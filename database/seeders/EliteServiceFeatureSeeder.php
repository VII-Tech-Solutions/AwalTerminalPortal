<?php

namespace Database\Seeders;

use App\Constants\Attributes;
use App\Models\EliteServiceFeatures;
use Illuminate\Database\Seeder;

class EliteServiceFeatureSeeder extends Seeder
{
    public function run()
    {

        EliteServiceFeatures::createOrUpdate([
            Attributes::ID => 1,
            Attributes::FEATURE_DETAILS => "BHD 20 for each additional passenger above group of 4 passengers.",
            Attributes::SERVICE_ID => 1
        ], [Attributes::ID]);

        EliteServiceFeatures::createOrUpdate([
            Attributes::ID => 2,
            Attributes::FEATURE_DETAILS => "Free entry for infants (0 to 2 years old).",
            Attributes::SERVICE_ID => 1
        ], [Attributes::ID]);

        EliteServiceFeatures::createOrUpdate([
            Attributes::ID => 3,
            Attributes::FEATURE_DETAILS => "BHD 25 for each additional passenger above group of 4 passengers",
            Attributes::SERVICE_ID => 2
        ], [Attributes::ID]);

        EliteServiceFeatures::createOrUpdate([
            Attributes::ID => 4,
            Attributes::FEATURE_DETAILS => "Free entry for infants (0 to 2 years old).",
            Attributes::SERVICE_ID => 2
        ], [Attributes::ID]);

        EliteServiceFeatures::createOrUpdate([
            Attributes::ID => 5,
            Attributes::FEATURE_DETAILS => "Rates apply to standard lounge size with a maximum of 6 passengers per lounge.",
            Attributes::SERVICE_ID => 2
        ], [Attributes::ID]);

    }
}
