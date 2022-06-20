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
        ], [Attributes::ID]);
        FormServices::createOrUpdate([
            Attributes::ID =>2,
            Attributes::NAME => "Fuel"
        ], [Attributes::ID]);
        FormServices::createOrUpdate([
            Attributes::ID =>3,
            Attributes::NAME => "Catering"
        ], [Attributes::ID]);
        FormServices::createOrUpdate([
            Attributes::ID =>4,
            Attributes::NAME => "Passenger Limo Services"
        ], [Attributes::ID]);
        FormServices::createOrUpdate([
            Attributes::ID =>5,
            Attributes::NAME => "Hotel Reservation"
        ], [Attributes::ID]);
        FormServices::createOrUpdate([
            Attributes::ID =>6,
            Attributes::NAME => "Crew Transport (to and from)"
        ], [Attributes::ID]);
        FormServices::createOrUpdate([
            Attributes::ID =>7,
            Attributes::NAME => "Toilet Service"
        ], [Attributes::ID]);
        FormServices::createOrUpdate([
            Attributes::ID =>8,
            Attributes::NAME => "Water Service"
        ], [Attributes::ID]);
        FormServices::createOrUpdate([
            Attributes::ID =>9,
            Attributes::NAME => "Air Conditioning Unit (ACU)"
        ], [Attributes::ID]);
        FormServices::createOrUpdate([
            Attributes::ID =>10,
            Attributes::NAME => "Air Start Unit (ASU)"
        ], [Attributes::ID]);
        FormServices::createOrUpdate([
            Attributes::ID =>11,
            Attributes::NAME => "Ground Power Unit (GPU)"
        ], [Attributes::ID]);

    }


}
