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
            Attributes::FEATURE_DETAILS =>"50% of the adult rate for children aged 2 to 12",
            Attributes::SERVICE_ID => 1
        ]);

        EliteServiceFeatures::createOrUpdate([
            Attributes::FEATURE_DETAILS =>"Free entry for infants ( 0 to 2 years old)",
            Attributes::SERVICE_ID =>1
        ]);

        EliteServiceFeatures::createOrUpdate([
            Attributes::FEATURE_DETAILS =>"10% group discount (5 PAX and above)",
            Attributes::SERVICE_ID =>1
        ]);

        EliteServiceFeatures::createOrUpdate([
            Attributes::FEATURE_DETAILS =>"Minimum of 2 adults full fares required to access a Private Lounge",
            Attributes::SERVICE_ID =>2
        ]);

        EliteServiceFeatures::createOrUpdate([
            Attributes::FEATURE_DETAILS =>"50% of the adult rate for children aged 2 to 12",
            Attributes::SERVICE_ID =>2
        ]);

        EliteServiceFeatures::createOrUpdate([
            Attributes::FEATURE_DETAILS =>"Free entry for infants ( 0 to 2 years old)",
            Attributes::SERVICE_ID =>2
        ]);

        EliteServiceFeatures::createOrUpdate([
            Attributes::FEATURE_DETAILS =>"Rates are per passenger capped at a total BHD 600.000 per lounge",
            Attributes::SERVICE_ID =>2
        ]);

        EliteServiceFeatures::createOrUpdate([
            Attributes::FEATURE_DETAILS =>"Rates apply to standard lounge size with a maximum of 6 passengers per lounge",
            Attributes::SERVICE_ID =>2
        ]);

    }
}
