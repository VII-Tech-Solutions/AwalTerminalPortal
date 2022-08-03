<?php

namespace Database\Seeders;

use App\Constants\Attributes;
use App\Models\Airport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AirportSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {

        $this->insert([
            Attributes::ID => 1,
            Attributes::NAME => 'Aalborg Airport',
            Attributes::IATA => '',
            Attributes::ICAO => '',
            Attributes::COUNTRY_ID => 61
        ]);
        $this->insert([
            Attributes::ID => 2,
            Attributes::NAME => 'Ålesund Airport',
            Attributes::COUNTRY_ID => 168
        ]);
        $this->insert([
            Attributes::ID => 3,
            Attributes::NAME => 'Abadan International Airport',
            Attributes::COUNTRY_ID => 61
        ]);
        $this->insert([
            Attributes::ID => 4,
            Attributes::NAME => 'Abbotsford International',
            Attributes::COUNTRY_ID => 40
        ]);
        $this->insert([
            Attributes::ID => 5,
            Attributes::NAME => 'Abeche Airport',
            Attributes::COUNTRY_ID => 44
        ]);
        $this->insert([
            Attributes::ID => 6,
            Attributes::NAME => 'Aberdeen International Airport',
            Attributes::COUNTRY_ID => 238
        ]);
        $this->insert([
            Attributes::ID => 7,
            Attributes::NAME => 'Aberdeen Regional Airport',
            Attributes::COUNTRY_ID => 239
        ]);
        $this->insert([
            Attributes::ID => 8,
            Attributes::NAME => 'Félix-Houphouët-Boigny International',
            Attributes::COUNTRY_ID => 55
        ]);
        $this->insert([
            Attributes::ID => 9,
            Attributes::NAME => 'Abilene Regional Airport',
            Attributes::COUNTRY_ID => 239
        ]);
        $this->insert([
            Attributes::ID => 10,
            Attributes::NAME => 'Abu Dhabi International',
            Attributes::COUNTRY_ID => 237
        ]);
        $this->insert([
            Attributes::ID => 11,
            Attributes::NAME => 'Nnamdi Azikiwe International Airport',
            Attributes::COUNTRY_ID => 164
        ]);
        $this->insert([
            Attributes::ID => 12,
            Attributes::NAME => 'Abu Rudeis Airport',
            Attributes::COUNTRY_ID => 66
        ]);
        $this->insert([
            Attributes::ID => 13,
            Attributes::NAME => 'Abu Simbel Airport',
            Attributes::COUNTRY_ID => 66
        ]);
        $this->insert([
            Attributes::ID => 14,
            Attributes::NAME => 'Acapulco International Airport',
            Attributes::COUNTRY_ID => 145
        ]);
        $this->insert([
            Attributes::ID => 15,
            Attributes::NAME => 'Kotoka International Airport',
            Attributes::COUNTRY_ID => 84
        ]);
        $this->insert([
            Attributes::ID => 16,
            Attributes::NAME => 'A Coruña Airport',
            Attributes::COUNTRY_ID => 212
        ]);
        $this->insert([
            Attributes::ID => 17,
            Attributes::NAME => 'Adana Sakirpasa Airport',
            Attributes::COUNTRY_ID => 231
        ]);
        $this->insert([
            Attributes::ID => 18,
            Attributes::NAME => 'Addis Ababa Bole International Airport',
            Attributes::COUNTRY_ID => 71
        ]);
        $this->insert([
            Attributes::ID => 19,
            Attributes::NAME => 'Adelaide Airport',
            Attributes::COUNTRY_ID => 14
        ]);
        $this->insert([
            Attributes::ID => 20,
            Attributes::NAME => 'Aden International Airport',
            Attributes::COUNTRY_ID => 250
        ]);
        $this->insert([
            Attributes::ID => 21,
            Attributes::NAME => 'Adıyaman Airport',
            Attributes::COUNTRY_ID => 231
        ]);
        $this->insert([
            Attributes::ID => 22,
            Attributes::NAME => 'Adler-Sochi International Airport',
            Attributes::COUNTRY_ID => 185
        ]);
        $this->insert([
            Attributes::ID => 23,
            Attributes::NAME => 'Mano Dayak International Airport',
            Attributes::COUNTRY_ID => 163
        ]);
        $this->insert([
            Attributes::ID => 24,
            Attributes::NAME => 'Agadir Massira Airport',
            Attributes::COUNTRY_ID => 152
        ]);
        $this->insert([
            Attributes::ID => 25,
            Attributes::NAME => 'Antonio B. Won Pat International Airport',
            Attributes::COUNTRY_ID => 90
        ]);
        $this->insert([
            Attributes::ID => 26,
            Attributes::NAME => 'Aggeneys Airport',
            Attributes::COUNTRY_ID => 209
        ]);
        $this->insert([
            Attributes::ID => 27,
            Attributes::NAME => 'Agri Airport',
            Attributes::COUNTRY_ID => 90
        ]);
        $this->insert([
            Attributes::ID => 28,
            Attributes::NAME => 'Rafael Hernández Airport',
            Attributes::COUNTRY_ID => 181
        ]);
        $this->insert([
            Attributes::ID => 29,
            Attributes::NAME => 'Aguascalientes International Airport',
            Attributes::COUNTRY_ID => 145
        ]);
        $this->insert([
            Attributes::ID => 30,
            Attributes::NAME => 'Ahmedabad International Airport',
            Attributes::COUNTRY_ID => 103
        ]);
        $this->insert([
            Attributes::ID => 31,
            Attributes::NAME => 'Aiyura Airport',
            Attributes::COUNTRY_ID => 174
        ]);
        $this->insert([
            Attributes::ID => 32,
            Attributes::NAME => 'Ajaccio Napoleon Bonaparte Airport',
            Attributes::COUNTRY_ID => 76
        ]);
        $this->insert([
            Attributes::ID => 33,
            Attributes::NAME => 'Akita Airport',
            Attributes::COUNTRY_ID => 112
        ]);

    }

    function insert($data)
    {
        Airport::createOrUpdate(
            $data, [Attributes::ID]);
    }
}
