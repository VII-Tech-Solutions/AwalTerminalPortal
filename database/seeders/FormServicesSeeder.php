<?php

namespace Database\Seeders;

use App\Constants\Attributes;
use App\Models\FormServices;
use Illuminate\Database\Seeder;

class FormServicesSeeder  extends Seeder
{
    public function run()
    {
        FormServices::createOrUpdate([
            Attributes::NAME => "Landing Permit"
        ]);
        FormServices::createOrUpdate([
            Attributes::NAME => "Fuel"
        ]);
        FormServices::createOrUpdate([
            Attributes::NAME => "Catering"
        ]);
        FormServices::createOrUpdate([
            Attributes::NAME => "Passenger Limo Services"
        ]);
        FormServices::createOrUpdate([
            Attributes::NAME => "Hotel Reservation"
        ]);
        FormServices::createOrUpdate([
            Attributes::NAME => "Crew Transport (to and from)"
        ]);
        FormServices::createOrUpdate([
            Attributes::NAME => "Toilet Service"
        ]);
        FormServices::createOrUpdate([
            Attributes::NAME => "Water Service"
        ]);
        FormServices::createOrUpdate([
            Attributes::NAME => "Air Conditioning Unit (ACU)"
        ]);
        FormServices::createOrUpdate([
            Attributes::NAME => "Air Start Unit (ASU)"
        ]);
        FormServices::createOrUpdate([
            Attributes::NAME => "Ground Power Unit (GPU)"
        ]);

    }


}
