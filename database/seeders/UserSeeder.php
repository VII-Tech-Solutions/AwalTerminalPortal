<?php

namespace Database\Seeders;

use App\Constants\Attributes;
use App\Constants\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $this->insert([
            Attributes::NAME => "VII Tech",
            Attributes::EMAIL => "webmaster@viitech.net",
            Attributes::PASSWORD => "123abC--",
            Attributes::STATUS => Status::ACTIVE,
            Attributes::EMAIL_VERIFIED_AT => Carbon::now(),
            Attributes::USER_TYPE=>\App\Constants\AdminUserType::SUPER_ADMIN,
        ]);

        $this->insert([
            Attributes::NAME => "Mohd Turki",
            Attributes::EMAIL => "mohd.turki@viitech.net",
            Attributes::PASSWORD => "123abC--",
            Attributes::STATUS => Status::ACTIVE,
            Attributes::EMAIL_VERIFIED_AT => Carbon::now(),
            Attributes::USER_TYPE=>\App\Constants\AdminUserType::GA,
        ]);

        $this->insert([
            Attributes::NAME => "Hussain Sabba",
            Attributes::EMAIL => "hussain.sabba@viitech.net",
            Attributes::PASSWORD => "123abC--",
            Attributes::STATUS => Status::ACTIVE,
            Attributes::EMAIL_VERIFIED_AT => Carbon::now(),
            Attributes::USER_TYPE=>\App\Constants\AdminUserType::ELITE_ONLY,
        ]);
    }


    function insert($data){
        User::createOrUpdate($data, [
            Attributes::EMAIL
        ]);
    }

}
