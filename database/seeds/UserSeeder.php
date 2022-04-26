<?php

use App\Constants\Attributes;
use App\Constants\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::createOrUpdate([
            Attributes::NAME => "VII Tech",
            Attributes::EMAIL => "webmaster@viitech.net",
            Attributes::PASSWORD => "123abC--",
            Attributes::STATUS => Status::ACTIVE,
            Attributes::EMAIL_VERIFIED_AT => Carbon::now()
        ]);

        User::createOrUpdate([
            Attributes::NAME => "Mohd Turki",
            Attributes::EMAIL => "mohd.turki@viitech.net",
            Attributes::PASSWORD => "123abC--",
            Attributes::STATUS => Status::ACTIVE,
            Attributes::EMAIL_VERIFIED_AT => Carbon::now()
        ]);

        User::createOrUpdate([
            Attributes::NAME => "Hussain Sabba",
            Attributes::EMAIL => "hussain.sabba@viitech.net",
            Attributes::PASSWORD => "123abC--",
            Attributes::STATUS => Status::ACTIVE,
            Attributes::EMAIL_VERIFIED_AT => Carbon::now()
        ]);
    }
}
