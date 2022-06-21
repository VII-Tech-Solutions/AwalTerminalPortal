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
            Attributes::FEATURE_DETAILS => "50% of the adult rate for children aged 2 to 12",
            Attributes::SERVICE_ID => 1
        ], [Attributes::ID]);

        EliteServiceFeatures::createOrUpdate([
            Attributes::ID => 2,
            Attributes::FEATURE_DETAILS => "Free entry for infants ( 0 to 2 years old)",
            Attributes::SERVICE_ID => 1
        ], [Attributes::ID]);

        EliteServiceFeatures::createOrUpdate([
            Attributes::ID => 3,
            Attributes::FEATURE_DETAILS => "10% group discount (5 PAX and above)",
            Attributes::SERVICE_ID => 1
        ], [Attributes::ID]);

        EliteServiceFeatures::createOrUpdate([
            Attributes::ID => 4,
            Attributes::FEATURE_DETAILS => "Minimum of 2 adults full fares required to access a Private Lounge",
            Attributes::SERVICE_ID => 2
        ], [Attributes::ID]);

        EliteServiceFeatures::createOrUpdate([
            Attributes::ID => 5,
            Attributes::FEATURE_DETAILS => "50% of the adult rate for children aged 2 to 12",
            Attributes::SERVICE_ID => 2
        ], [Attributes::ID]);

        EliteServiceFeatures::createOrUpdate([
            Attributes::ID => 6,
            Attributes::FEATURE_DETAILS => "Free entry for infants ( 0 to 2 years old)",
            Attributes::SERVICE_ID => 2
        ], [Attributes::ID]);

        EliteServiceFeatures::createOrUpdate([
            Attributes::ID => 7,
            Attributes::FEATURE_DETAILS => "Rates are per passenger capped at a total BHD 600.000 per lounge",
            Attributes::SERVICE_ID => 2
        ], [Attributes::ID]);

        EliteServiceFeatures::createOrUpdate([
            Attributes::ID => 8,
            Attributes::FEATURE_DETAILS => "Rates apply to standard lounge size with a maximum of 6 passengers per lounge",
            Attributes::SERVICE_ID => 2
        ], [Attributes::ID]);

    }
}
