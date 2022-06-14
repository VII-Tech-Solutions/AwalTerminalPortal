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
            Attributes::ID =>1,
            Attributes::NAME => "Landing Permit"
        ]);
        FormServices::createOrUpdate([
            Attributes::ID =>2,
            Attributes::NAME => "Fuel"
        ]);
        FormServices::createOrUpdate([
            Attributes::ID =>3,
            Attributes::NAME => "Catering"
        ]);
        FormServices::createOrUpdate([
            Attributes::ID =>4,
            Attributes::NAME => "Passenger Limo Services"
        ]);
        FormServices::createOrUpdate([
            Attributes::ID =>5,
            Attributes::NAME => "Hotel Reservation"
        ]);
        FormServices::createOrUpdate([
            Attributes::ID =>6,
            Attributes::NAME => "Crew Transport (to and from)"
        ]);
        FormServices::createOrUpdate([
            Attributes::ID =>7,
            Attributes::NAME => "Toilet Service"
        ]);
        FormServices::createOrUpdate([
            Attributes::ID =>8,
            Attributes::NAME => "Water Service"
        ]);
        FormServices::createOrUpdate([
            Attributes::ID =>8,
            Attributes::NAME => "Air Conditioning Unit (ACU)"
        ]);
        FormServices::createOrUpdate([
            Attributes::ID =>9,
            Attributes::NAME => "Air Start Unit (ASU)"
        ]);
        FormServices::createOrUpdate([
            Attributes::ID =>10,
            Attributes::NAME => "Ground Power Unit (GPU)"
        ]);

    }


}
