<?php

use App\Constants\Tables;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        db::insert("INSERT INTO `airports` (`id`, `name`,`country_id`) VALUES
(1,'Aalborg Airport', 61),
(2,'Ålesund Airport', 168),
(3,'Abadan International Airport', 61),
(4,'Abbotsford International', 40),
(5,'Abeche Airport', 44),
(6,'Aberdeen International Airport', 238),
(7,'Aberdeen Regional Airport', 239),
(8,'Félix-Houphouët-Boigny International', 55),
(9,'Abilene Regional Airport', 239),
(10,'Abu Dhabi International', 237),
(11,'Nnamdi Azikiwe International Airport', 164),
(12,'Abu Rudeis Airport', 66),
(13,'Abu Simbel Airport', 66),
(14,'Acapulco International Airport', 145),
(15,'Kotoka International Airport', 84),
(16,'A Coruña Airport', 212),
(17,'Adana Sakirpasa Airport', 231),
(18,'Addis Ababa Bole International Airport', 71),
(19,'Adelaide Airport', 14),
(20,'Aden International Airport', 250),
(21,'Adıyaman Airport', 231),
(22,'Adler-Sochi International Airport', 185),
(23,'Mano Dayak International Airport', 163),
(24,'Agadir Massira Airport', 152),
(25,'Antonio B. Won Pat International Airport', 90),
(26,'Aggeneys Airport', 209),
(27,'Agri Airport', 231),
(28,'Rafael Hernández Airport', 181),
(29,'Aguascalientes International Airport', 145),
(30,'Ahmedabad International Airport', 103),
(31,'Aiyura Airport', 174),
(32,'Ajaccio Napoleon Bonaparte Airport', 76),
(33,'Akita Airport', 112)");

    }
}
