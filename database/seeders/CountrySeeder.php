<?php

namespace Database\Seeders;

use App\Constants\Attributes;
use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
//        INSERT INTO `countries` (`id`, `name`) VALUES
//    (1, 'Afghanistan'),
//(2, 'Aland Islands'),
//(3, 'Albania'),
//(4, 'Algeria'),
//(5, 'American Samoa'),
//(6, 'Andorra'),
//(7, 'Angola'),
//(8, 'Anguilla'),
//(9, 'Antarctica'),
//(10, 'Antigua and Barbuda'),
//(11, 'Argentina'),
//(12, 'Armenia'),
//(13, 'Aruba'),
//(14, 'Australia'),
//(15, 'Austria'),
//(16, 'Azerbaijan'),
//(17, 'Bahamas'),
//(18, 'Bahrain'),
//(19, 'Bangladesh'),
//(20, 'Barbados'),
//(21, 'Belarus'),
//(22, 'Belgium'),
//(23, 'Belize'),
//(24, 'Benin'),
//(25, 'Bermuda'),
//(26, 'Bhutan'),
//(27, 'Bolivia'),
//(28, 'Bonaire, Sint Eustatius and Saba'),
//(29, 'Bosnia and Herzegovina'),
//(30, 'Botswana'),
//(31, 'Bouvet Island'),
//(32, 'Brazil'),
//(33, 'British Indian Ocean Territory'),
//(34, 'Brunei Darussalam'),
//(35, 'Bulgaria'),
//(36, 'Burkina Faso'),
//(37, 'Burundi'),
//(38, 'Cambodia'),
//(39, 'Cameroon'),
//(40, 'Canada'),
//(41, 'Cape Verde'),
//(42, 'Cayman Islands'),
//(43, 'Central African Republic'),
//(44, 'Chad'),
//(45, 'Chile'),
//(46, 'China'),
//(47, 'Christmas Island'),
//(48, 'Cocos (Keeling) Islands'),
//(49, 'Colombia'),
//(50, 'Comoros'),
//(51, 'Congo'),
//(52, 'Congo, Democratic Republic of the Congo'),
//(53, 'Cook Islands'),
//(54, 'Costa Rica'),
//(55, 'Cote D\'Ivoire'),
//(56, 'Croatia'),
//(57, 'Cuba'),
//(58, 'Curacao'),
//(59, 'Cyprus'),
//(60, 'Czech Republic'),
//(61, 'Denmark'),
//(62, 'Djibouti'),
//(63, 'Dominica'),
//(64, 'Dominican Republic'),
//(65, 'Ecuador'),
//(66, 'Egypt'),
//(67, 'El Salvador'),
//(68, 'Equatorial Guinea'),
//(69, 'Eritrea'),
//(70, 'Estonia'),
//(71, 'Ethiopia'),
//(72, 'Falkland Islands (Malvinas)'),
//(73, 'Faroe Islands'),
//(74, 'Fiji'),
//(75, 'Finland'),
//(76, 'France'),
//(77, 'French Guiana'),
//(78, 'French Polynesia'),
//(79, 'French Southern Territories'),
//(80, 'Gabon'),
//(81, 'Gambia'),
//(82, 'Georgia'),
//(83, 'Germany'),
//(84, 'Ghana'),
//(85, 'Gibraltar'),
//(86, 'Greece'),
//(87, 'Greenland'),
//(88, 'Grenada'),
//(89, 'Guadeloupe'),
//(90, 'Guam'),
//(91, 'Guatemala'),
//(92, 'Guernsey'),
//(93, 'Guinea'),
//(94, 'Guinea-Bissau'),
//(95, 'Guyana'),
//(96, 'Haiti'),
//(97, 'Heard Island and Mcdonald Islands'),
//(98, 'Holy See (Vatican City State)'),
//(99, 'Honduras'),
//(100, 'Hong Kong'),
//(101, 'Hungary'),
//(102, 'Iceland'),
//(103, 'India'),
//(104, 'Indonesia'),
//(105, 'Iran, Islamic Republic of'),
//(106, 'Iraq'),
//(107, 'Ireland'),
//(108, 'Isle of Man'),
//(109, 'Israel'),
//(110, 'Italy'),
//(111, 'Jamaica'),
//(112, 'Japan'),
//(113, 'Jersey'),
//(114, 'Jordan'),
//(115, 'Kazakhstan'),
//(116, 'Kenya'),
//(117, 'Kiribati'),
//(118, 'Korea, Democratic People\'s Republic of'),
//(119, 'Korea, Republic of'),
//(120, 'Kosovo'),
//(121, 'Kuwait'),
//(122, 'Kyrgyzstan'),
//(123, 'Lao People\'s Democratic Republic'),
//(124, 'Latvia'),
//(125, 'Lebanon'),
//(126, 'Lesotho'),
//(127, 'Liberia'),
//(128, 'Libyan Arab Jamahiriya'),
//(129, 'Liechtenstein'),
//(130, 'Lithuania'),
//(131, 'Luxembourg'),
//(132, 'Macao'),
//(133, 'Macedonia, the Former Yugoslav Republic of'),
//(134, 'Madagascar'),
//(135, 'Malawi'),
//(136, 'Malaysia'),
//(137, 'Maldives'),
//(138, 'Mali'),
//(139, 'Malta'),
//(140, 'Marshall Islands'),
//(141, 'Martinique'),
//(142, 'Mauritania'),
//(143, 'Mauritius'),
//(144, 'Mayotte'),
//(145, 'Mexico'),
//(146, 'Micronesia, Federated States of'),
//(147, 'Moldova, Republic of'),
//(148, 'Monaco'),
//(149, 'Mongolia'),
//(150, 'Montenegro'),
//(151, 'Montserrat'),
//(152, 'Morocco'),
//(153, 'Mozambique'),
//(154, 'Myanmar'),
//(155, 'Namibia'),
//(156, 'Nauru'),
//(157, 'Nepal'),
//(158, 'Netherlands'),
//(159, 'Netherlands Antilles'),
//(160, 'New Caledonia'),
//(161, 'New Zealand'),
//(162, 'Nicaragua'),
//(163, 'Niger'),
//(164, 'Nigeria'),
//(165, 'Niue'),
//(166, 'Norfolk Island'),
//(167, 'Northern Mariana Islands'),
//(168, 'Norway'),
//(169, 'Oman'),
//(170, 'Pakistan'),
//(171, 'Palau'),
//(172, 'Palestinian Territory, Occupied'),
//(173, 'Panama'),
//(174, 'Papua New Guinea'),
//(175, 'Paraguay'),
//(176, 'Peru'),
//(177, 'Philippines'),
//(178, 'Pitcairn'),
//(179, 'Poland'),
//(180, 'Portugal'),
//(181, 'Puerto Rico'),
//(182, 'Qatar'),
//(183, 'Reunion'),
//(184, 'Romania'),
//(185, 'Russian Federation'),
//(186, 'Rwanda'),
//(187, 'Saint Barthelemy'),
//(188, 'Saint Helena'),
//(189, 'Saint Kitts and Nevis'),
//(190, 'Saint Lucia'),
//(191, 'Saint Martin'),
//(192, 'Saint Pierre and Miquelon'),
//(193, 'Saint Vincent and the Grenadines'),
//(194, 'Samoa'),
//(195, 'San Marino'),
//(196, 'Sao Tome and Principe'),
//(197, 'Saudi Arabia'),
//(198, 'Senegal'),
//(199, 'Serbia'),
//(200, 'Serbia and Montenegro'),
//(201, 'Seychelles'),
//(202, 'Sierra Leone'),
//(203, 'Singapore'),
//(204, 'Sint Maarten'),
//(205, 'Slovakia'),
//(206, 'Slovenia'),
//(207, 'Solomon Islands'),
//(208, 'Somalia'),
//(209, 'South Africa'),
//(210, 'South Georgia and the South Sandwich Islands'),
//(211, 'South Sudan'),
//(212, 'Spain'),
//(213, 'Sri Lanka'),
//(214, 'Sudan'),
//(215, 'Suriname'),
//(216, 'Svalbard and Jan Mayen'),
//(217, 'Swaziland'),
//(218, 'Sweden'),
//(219, 'Switzerland'),
//(220, 'Syrian Arab Republic'),
//(221, 'Taiwan, Province of China'),
//(222, 'Tajikistan'),
//(223, 'Tanzania, United Republic of'),
//(224, 'Thailand'),
//(225, 'Timor-Leste'),
//(226, 'Togo'),
//(227, 'Tokelau'),
//(228, 'Tonga'),
//(229, 'Trinidad and Tobago'),
//(230, 'Tunisia'),
//(231, 'Turkey'),
//(232, 'Turkmenistan'),
//(233, 'Turks and Caicos Islands'),
//(234, 'Tuvalu'),
//(235, 'Uganda'),
//(236, 'Ukraine'),
//(237, 'United Arab Emirates'),
//(238, 'United Kingdom'),
//(239, 'United States'),
//(240, 'United States Minor Outlying Islands'),
//(241, 'Uruguay'),
//(242, 'Uzbekistan'),
//(243, 'Vanuatu'),
//(244, 'Venezuela'),
//(245, 'Viet Nam'),
//(246, 'Virgin Islands, British'),
//(247, 'Virgin Islands, U.s.'),
//(248, 'Wallis and Futuna'),
//(249, 'Western Sahara'),
//(250, 'Yemen'),
//(251, 'Zambia'),
//(252, 'Zimbabwe');
        $this->insert([
            Attributes::ID => 1,
            Attributes::NAME => "Afghanistan"
        ]);
        $this->insert([
            Attributes::ID => 2,
            Attributes::NAME => "Aland Islands"
        ]);
        $this->insert([
            Attributes::ID => 3,
            Attributes::NAME => "Albania"
        ]);
        $this->insert([
            Attributes::ID => 4,
            Attributes::NAME => "Algeria"
        ]);
        $this->insert([
            Attributes::ID => 5,
            Attributes::NAME => "American Samoa"
        ]);
        $this->insert([
            Attributes::ID => 6,
            Attributes::NAME => "Andorra"
        ]);
        $this->insert([
            Attributes::ID => 7,
            Attributes::NAME => "Angola"
        ]);
        $this->insert([
            Attributes::ID => 8,
            Attributes::NAME => "Anguilla"
        ]);
        $this->insert([
            Attributes::ID => 9,
            Attributes::NAME => "Antarctica"
        ]);
        $this->insert([
            Attributes::ID => 10,
            Attributes::NAME => "Antigua and Barbuda"
        ]);
        $this->insert([
            Attributes::ID => 11,
            Attributes::NAME => "Argentina"
        ]);
        $this->insert([
            Attributes::ID => 12,
            Attributes::NAME => 'Armenia'
        ]);
        $this->insert([
            Attributes::ID => 13,
            Attributes::NAME => "Aruba"
        ]);
        $this->insert([
            Attributes::ID => 14,
            Attributes::NAME => "Australia"
        ]);
        $this->insert([
            Attributes::ID => 15,
            Attributes::NAME => "Austria"
        ]);
        $this->insert([
            Attributes::ID => 16,
            Attributes::NAME => "Azerbaijan"
        ]);
        $this->insert([
            Attributes::ID => 17,
            Attributes::NAME => "Bahamas"
        ]);
        $this->insert([
            Attributes::ID => 18,
            Attributes::NAME => "Bahrain"
        ]);
        $this->insert([
            Attributes::ID => 19,
            Attributes::NAME => "Bangladesh"
        ]);
        $this->insert([
            Attributes::ID => 20,
            Attributes::NAME => "Barbados"
        ]);
        $this->insert([
            Attributes::ID => 21,
            Attributes::NAME => "Belarus"
        ]);
        $this->insert([
            Attributes::ID => 22,
            Attributes::NAME => 'Belgium'
        ]);
        $this->insert([
            Attributes::ID => 23,
            Attributes::NAME => 'Belize'
        ]);

        $this->insert([
            Attributes::ID => 24,
            Attributes::NAME => "Benin"
        ]);
        $this->insert([
            Attributes::ID => 25,
            Attributes::NAME => "Bermuda"
        ]);
        $this->insert([
            Attributes::ID => 26,
            Attributes::NAME => "Bhutan"
        ]);
        $this->insert([
            Attributes::ID => 27,
            Attributes::NAME => 'Bolivia'
        ]);
        $this->insert([
            Attributes::ID => 28,
            Attributes::NAME => "Bonaire, Sint Eustatius and Saba"
        ]);
        $this->insert([
            Attributes::ID => 29,
            Attributes::NAME => "Bosnia and Herzegovina"
        ]);
        $this->insert([
            Attributes::ID => 30,
            Attributes::NAME => 'Botswana'
        ]);
        $this->insert([
            Attributes::ID => 31,
            Attributes::NAME => 'Bouvet Island'
        ]);
        $this->insert([
            Attributes::ID => 32,
            Attributes::NAME => "Brazil"
        ]);
        $this->insert([
            Attributes::ID => 33,
            Attributes::NAME => "British Indian Ocean Territory"
        ]);
        $this->insert([
            Attributes::ID => 34,
            Attributes::NAME => "Brunei Darussalam"
        ]);
        $this->insert([
            Attributes::ID => 35,
            Attributes::NAME => "Bulgaria"
        ]);
        $this->insert([
            Attributes::ID => 36,
            Attributes::NAME => "Burkina Faso"
        ]);
        $this->insert([
            Attributes::ID => 37,
            Attributes::NAME => "Burundi"
        ]);
        $this->insert([
            Attributes::ID => 38,
            Attributes::NAME => "Cambodia"
        ]);
        $this->insert([
            Attributes::ID => 39,
            Attributes::NAME => "Cameroon"
        ]);
        $this->insert([
            Attributes::ID => 40,
            Attributes::NAME => "Canada"
        ]);
        $this->insert([
            Attributes::ID => 41,
            Attributes::NAME => "Cape Verde"
        ]);
        $this->insert([
            Attributes::ID => 42,
            Attributes::NAME => 'Cayman Islands'
        ]);
        $this->insert([
            Attributes::ID => 43,
            Attributes::NAME => 'Central African Republic'
        ]);
        $this->insert([
            Attributes::ID => 44,
            Attributes::NAME => "Chad"
        ]);
        $this->insert([
            Attributes::ID => 45,
            Attributes::NAME => "Chile"
        ]);
        $this->insert([
            Attributes::ID => 46,
            Attributes::NAME => "China"
        ]);
        $this->insert([
            Attributes::ID => 47,
            Attributes::NAME => "Christmas Island"
        ]);
        $this->insert([
            Attributes::ID => 48,
            Attributes::NAME => "Cocos (Keeling) Islands"
        ]);
        $this->insert([
            Attributes::ID => 49,
            Attributes::NAME => "Colombia"
        ]);
        $this->insert([
            Attributes::ID => 50,
            Attributes::NAME => "Comoros"
        ]);
        $this->insert([
            Attributes::ID => 51,
            Attributes::NAME => 'Congo'
        ]);
        $this->insert([
            Attributes::ID => 52,
            Attributes::NAME => 'The Democratic Republic of The Congo'
        ]);
        $this->insert([
            Attributes::ID => 53,
            Attributes::NAME => 'Cook Islands'
        ]);
        $this->insert([
            Attributes::ID => 54,
            Attributes::NAME => 'Costa Rica'
        ]);
        $this->insert([
            Attributes::ID => 55,
            Attributes::NAME => "Cote D Ivoire"
        ]);
        $this->insert([
            Attributes::ID => 56,
            Attributes::NAME => "Croatia"
        ]);
        $this->insert([
            Attributes::ID => 57,
            Attributes::NAME => 'Cuba'
        ]);
        $this->insert([
            Attributes::ID => 58,
            Attributes::NAME => 'Curaçao'
        ]);
        $this->insert([
            Attributes::ID => 59,
            Attributes::NAME => "Cyprus"
        ]);
        $this->insert([
            Attributes::ID => 60,
            Attributes::NAME => "Czech Republic"
        ]);
        $this->insert([
            Attributes::ID => 61,
            Attributes::NAME => 'Denmark',
        ]);
        $this->insert([
            Attributes::ID => 62,
            Attributes::NAME => 'Djibouti',
        ]);
        $this->insert([
            Attributes::ID => 63,
            Attributes::NAME => 'Dominica',
        ]);
        $this->insert([
            Attributes::ID => 64,
            Attributes::NAME => 'Dominican Republic',
        ]);
        $this->insert([
            Attributes::ID => 65,
            Attributes::NAME => 'Ecuador',
        ]);
        $this->insert([
            Attributes::ID => 66,
            Attributes::NAME => 'Egypt',
        ]);
        $this->insert([
            Attributes::ID => 67,
            Attributes::NAME => 'El Salvador',
        ]);

        $this->insert([
            Attributes::ID => 68,
            Attributes::NAME => 'Equatorial Guinea',
        ]);

        $this->insert([
            Attributes::ID => 69,
            Attributes::NAME => 'Eritrea',
        ]);

        $this->insert([
            Attributes::ID => 70,
            Attributes::NAME => 'Estonia',
        ]);
        $this->insert([
            Attributes::ID => 71,
            Attributes::NAME => 'Ethiopia',
        ]);
        $this->insert([
            Attributes::ID => 72,
            Attributes::NAME => 'Falkland Islands (Malvinas)',
        ]);

        $this->insert([
            Attributes::ID => 73,
            Attributes::NAME => 'Faroe Islands',
        ]);

        $this->insert([
            Attributes::ID => 74,
            Attributes::NAME => 'Fiji',
        ]);

        $this->insert([
            Attributes::ID => 75,
            Attributes::NAME => 'Finland',
        ]);

        $this->insert([
            Attributes::ID => 76,
            Attributes::NAME => 'France',
        ]);

        $this->insert([
            Attributes::ID => 77,
            Attributes::NAME => 'French Guiana',
        ]);

        $this->insert([
            Attributes::ID => 78,
            Attributes::NAME => 'French Polynesia',
        ]);

        $this->insert([
            Attributes::ID => 79,
            Attributes::NAME => 'French Southern Territories',
        ]);
        $this->insert([
            Attributes::ID => 80,
            Attributes::NAME => 'Gabon',
        ]);
        $this->insert([
            Attributes::ID => 81,
            Attributes::NAME => 'Gambia',
        ]);
        $this->insert([
            Attributes::ID => 82,
            Attributes::NAME => 'Georgia',
        ]);
        $this->insert([
            Attributes::ID => 83,
            Attributes::NAME => 'Germany',
        ]);
        $this->insert([
            Attributes::ID => 84,
            Attributes::NAME => 'Ghana',
        ]);
        $this->insert([
            Attributes::ID => 85,
            Attributes::NAME => 'Gibraltar',
        ]);
        $this->insert([
            Attributes::ID => 86,
            Attributes::NAME => 'Greece',
        ]);
        $this->insert([
            Attributes::ID => 87,
            Attributes::NAME => 'Greenland',
        ]);
        $this->insert([
            Attributes::ID => 88,
            Attributes::NAME => 'Grenada',
        ]);
        $this->insert([
            Attributes::ID => 89,
            Attributes::NAME => 'Guadeloupe',
        ]);
        $this->insert([
            Attributes::ID => 90,
            Attributes::NAME => 'Guam',
        ]);
        $this->insert([
            Attributes::ID => 91,
            Attributes::NAME => 'Guatemala',
        ]);
        $this->insert([
            Attributes::ID => 92,
            Attributes::NAME => 'Guernsey',
        ]);
        $this->insert([
            Attributes::ID => 93,
            Attributes::NAME => 'Guinea',
        ]);
        $this->insert([
            Attributes::ID => 94,
            Attributes::NAME => 'Guinea-Bissau',
        ]);
        $this->insert([
            Attributes::ID => 95,
            Attributes::NAME => 'Guyana',
        ]);
        $this->insert([
            Attributes::ID => 96,
            Attributes::NAME => 'Haiti',
        ]);
        $this->insert([
            Attributes::ID => 97,
            Attributes::NAME => 'Heard Island and Mcdonald Islands',
        ]);
        $this->insert([
            Attributes::ID => 98,
            Attributes::NAME => 'Holy See (Vatican City State)',
        ]);
        $this->insert([
            Attributes::ID => 99,
            Attributes::NAME => 'Honduras',
        ]);
        $this->insert([
            Attributes::ID => 100,
            Attributes::NAME => 'Hong Kong SAR',
        ]);
        $this->insert([
            Attributes::ID => 101,
            Attributes::NAME => 'Hungary',
        ]);
        $this->insert([
            Attributes::ID => 102,
            Attributes::NAME => 'Iceland',
        ]);
        $this->insert([
            Attributes::ID => 103,
            Attributes::NAME => 'India',
        ]);
        $this->insert([
            Attributes::ID => 104,
            Attributes::NAME => 'Indonesia',
        ]);
        $this->insert([
            Attributes::ID => 105,
            Attributes::NAME => 'Iran',
        ]);
        $this->insert([
            Attributes::ID => 106,
            Attributes::NAME => 'Iraq',
        ]);
        $this->insert([
            Attributes::ID => 107,
            Attributes::NAME => 'Ireland',
        ]);
        $this->insert([
            Attributes::ID => 108,
            Attributes::NAME => 'Isle of Man',
        ]);
        $this->insert([
            Attributes::ID => 109,
            Attributes::NAME => 'Israel',
        ]);
        $this->insert([
            Attributes::ID => 110,
            Attributes::NAME => 'Italy',
        ]);
        $this->insert([
            Attributes::ID => 111,
            Attributes::NAME => 'Jamaica',
        ]);
        $this->insert([
            Attributes::ID => 112,
            Attributes::NAME => 'Japan',
        ]);
        $this->insert([
            Attributes::ID => 113,
            Attributes::NAME => 'Jersey',
        ]);
        $this->insert([
            Attributes::ID => 114,
            Attributes::NAME => 'Jordan',
        ]);
        $this->insert([
            Attributes::ID => 115,
            Attributes::NAME => 'Kazakhstan',
        ]);
        $this->insert([
            Attributes::ID => 116,
            Attributes::NAME => 'Kenya',
        ]);
        $this->insert([
            Attributes::ID => 117,
            Attributes::NAME => 'Kiribati',
        ]);
        $this->insert([
            Attributes::ID => 118,
            Attributes::NAME => "Democratic People's Republic of Korea",
        ]);
        $this->insert([
            Attributes::ID => 119,
            Attributes::NAME => 'Republic of Korea',
        ]);
        $this->insert([
            Attributes::ID => 120,
            Attributes::NAME => 'Kosovo',
        ]);
        $this->insert([
            Attributes::ID => 121,
            Attributes::NAME => 'Kuwait',
        ]);
        $this->insert([
            Attributes::ID => 122,
            Attributes::NAME => 'Kyrgyzstan'
        ]);
        $this->insert([
            Attributes::ID => 123,
            Attributes::NAME => 'Lao Peoples Democratic Republic',
        ]);
        $this->insert([
            Attributes::ID => 124,
            Attributes::NAME => 'Latvia',
        ]);
        $this->insert([
            Attributes::ID => 125,
            Attributes::NAME => 'Lebanon',
        ]);
        $this->insert([
            Attributes::ID => 126,
            Attributes::NAME => 'Lesotho',
        ]);
        $this->insert([
            Attributes::ID => 127,
            Attributes::NAME => 'Liberia',
        ]);
        $this->insert([
            Attributes::ID => 128,
            Attributes::NAME => 'Libya',
        ]);
        $this->insert([
            Attributes::ID => 129,
            Attributes::NAME => 'Liechtenstein'
        ]);
        $this->insert([
            Attributes::ID => 130,
            Attributes::NAME => 'Lithuania',
        ]);
        $this->insert([
            Attributes::ID => 131,
            Attributes::NAME => 'Luxembourg',
        ]);
        $this->insert([
            Attributes::ID => 132,
            Attributes::NAME => 'Macau SAR',
        ]);
        $this->insert([
            Attributes::ID => 133,
            Attributes::NAME => 'Macedonia (FYROM)',
        ]);
        $this->insert([
            Attributes::ID => 134,
            Attributes::NAME => 'Madagascar',
        ]);
        $this->insert([
            Attributes::ID => 135,
            Attributes::NAME => 'Malawi',
        ]);
        $this->insert([
            Attributes::ID => 136,
            Attributes::NAME => 'Malaysia'
        ]);
        $this->insert([
            Attributes::ID => 137,
            Attributes::NAME => 'Maldives',
        ]);
        $this->insert([
            Attributes::ID => 138,
            Attributes::NAME => 'Mali',
        ]);
        $this->insert([
            Attributes::ID => 139,
            Attributes::NAME => 'Malta',
        ]);
        $this->insert([
            Attributes::ID => 140,
            Attributes::NAME => 'Marshall Islands',
        ]);
        $this->insert([
            Attributes::ID => 141,
            Attributes::NAME => 'Martinique',
        ]);
        $this->insert([
            Attributes::ID => 142,
            Attributes::NAME => 'Mauritania',
        ]);
        $this->insert([
            Attributes::ID => 143,
            Attributes::NAME => 'Mauritius',
        ]);
        $this->insert([
            Attributes::ID => 144,
            Attributes::NAME => 'Mayotte',
        ]);
        $this->insert([
            Attributes::ID => 145,
            Attributes::NAME => 'Mexico',
        ]);
        $this->insert([
            Attributes::ID => 146,
            Attributes::NAME => 'Micronesia',
        ]);
        $this->insert([
            Attributes::ID => 147,
            Attributes::NAME => 'Republic of Moldova',
        ]);
        $this->insert([
            Attributes::ID => 148,
            Attributes::NAME => 'Monaco',
        ]);
        $this->insert([
            Attributes::ID => 149,
            Attributes::NAME => 'Mongolia',
        ]);
        $this->insert([
            Attributes::ID => 150,
            Attributes::NAME => 'Montenegro'
        ]);
        $this->insert([
            Attributes::ID => 151,
            Attributes::NAME => 'Montserrat',
        ]);
        $this->insert([
            Attributes::ID => 152,
            Attributes::NAME => 'Morocco',
        ]);
        $this->insert([
            Attributes::ID => 153,
            Attributes::NAME => 'Mozambique',
        ]);
        $this->insert([
            Attributes::ID => 154,
            Attributes::NAME => 'Myanmar',
        ]);
        $this->insert([
            Attributes::ID => 155,
            Attributes::NAME => 'Namibia'
        ]);
        $this->insert([
            Attributes::ID => 156,
            Attributes::NAME => 'Nauru'
        ]);
        $this->insert([
            Attributes::ID => 157,
            Attributes::NAME => 'Nepal',
        ]);
        $this->insert([
            Attributes::ID => 158,
            Attributes::NAME => 'Netherlands',
        ]);
        $this->insert([
            Attributes::ID => 159,
            Attributes::NAME => 'Caribbean Netherlands',
        ]);
        $this->insert([
            Attributes::ID => 160,
            Attributes::NAME => 'New Caledonia',
        ]);

        $this->insert([
            Attributes::ID => 161,
            Attributes::NAME => 'New Zealand',
        ]);

        $this->insert([
            Attributes::ID => 162,
            Attributes::NAME => 'Nicaragua',
        ]);

        $this->insert([
            Attributes::ID => 163,
            Attributes::NAME => 'Niger',
        ]);

        $this->insert([
            Attributes::ID => 164,
            Attributes::NAME => 'Nigeria',
        ]);
        $this->insert([
            Attributes::ID => 165,
            Attributes::NAME => 'Niue',
        ]);
        $this->insert([
            Attributes::ID => 166,
            Attributes::NAME => 'Norfolk Island',
        ]);
        $this->insert([
            Attributes::ID => 167,
            Attributes::NAME => 'Northern Mariana Islands',
        ]);
        $this->insert([
            Attributes::ID => 168,
            Attributes::NAME => 'Norway',
        ]);
        $this->insert([
            Attributes::ID => 169,
            Attributes::NAME => 'Oman',
        ]);
        $this->insert([
            Attributes::ID => 170,
            Attributes::NAME => 'Pakistan',
        ]);
        $this->insert([
            Attributes::ID => 171,
            Attributes::NAME => 'Palau',
        ]);
        $this->insert([
            Attributes::ID => 172,
            Attributes::NAME => 'Palestinian Territory, Occupied',
        ]);
        $this->insert([
            Attributes::ID => 173,
            Attributes::NAME => 'Panama',
        ]);
        $this->insert([
            Attributes::ID => 174,
            Attributes::NAME => 'Papua New Guinea',
        ]);

        $this->insert([
            Attributes::ID => 175,
            Attributes::NAME => 'Paraguay',
        ]);

        $this->insert([
            Attributes::ID => 176,
            Attributes::NAME => 'Peru',
        ]);

        $this->insert([
            Attributes::ID => 177,
            Attributes::NAME => 'Philippines',
        ]);

        $this->insert([
            Attributes::ID => 178,
            Attributes::NAME => 'Pitcairn',
        ]);
        $this->insert([
            Attributes::ID => 179,
            Attributes::NAME => 'Poland',
        ]);
        $this->insert([
            Attributes::ID => 180,
            Attributes::NAME => 'Portugal',
        ]);
        $this->insert([
            Attributes::ID => 181,
            Attributes::NAME => 'Puerto Rico',
        ]);
        $this->insert([
            Attributes::ID => 182,
            Attributes::NAME => 'Qatar',
        ]);
        $this->insert([
            Attributes::ID => 183,
            Attributes::NAME => 'Reunion',
        ]);
        $this->insert([
            Attributes::ID => 184,
            Attributes::NAME => 'Romania',
        ]);

        $this->insert([
            Attributes::ID => 185,
            Attributes::NAME => 'Russian Federation',
        ]);

        $this->insert([
            Attributes::ID => 186,
            Attributes::NAME => 'Rwanda',
        ]);

        $this->insert([
            Attributes::ID => 187,
            Attributes::NAME => 'Saint Barthelemy',
        ]);

        $this->insert([
            Attributes::ID => 188,
            Attributes::NAME => 'St. Helena',
        ]);

        $this->insert([
            Attributes::ID => 189,
            Attributes::NAME => 'St. Kitts and Nevis',
        ]);

        $this->insert([
            Attributes::ID => 190,
            Attributes::NAME => 'Saint Lucia',
        ]);

        $this->insert([
            Attributes::ID => 191,
            Attributes::NAME => 'Saint Martin',
        ]);

        $this->insert([
            Attributes::ID => 192,
            Attributes::NAME => 'St. Pierre and Miquelon',
        ]);
        $this->insert([
            Attributes::ID => 193,
            Attributes::NAME => 'Saint Vincent and the Grenadines',
        ]);
        $this->insert([
            Attributes::ID => 194,
            Attributes::NAME => 'Samoa',
        ]);
        $this->insert([
            Attributes::ID => 195,
            Attributes::NAME => 'San Marino',
        ]);
        $this->insert([
            Attributes::ID => 196,
            Attributes::NAME => 'Sao Tome and Principe',
        ]);
        $this->insert([
            Attributes::ID => 197,
            Attributes::NAME => 'Saudi Arabia',
        ]);
        $this->insert([
            Attributes::ID => 198,
            Attributes::NAME => 'Senegal',
        ]);
        $this->insert([
            Attributes::ID => 199,
            Attributes::NAME => 'Republic of Serbia',
        ]);
        $this->insert([
            Attributes::ID => 200,
            Attributes::NAME => 'Serbia and Montenegro',
        ]);
        $this->insert([
            Attributes::ID => 201,
            Attributes::NAME => 'Seychelles',
        ]);
        $this->insert([
            Attributes::ID => 202,
            Attributes::NAME => 'Sierra Leone',
        ]);
        $this->insert([
            Attributes::ID => 203,
            Attributes::NAME => 'Singapore',
        ]);
        $this->insert([
            Attributes::ID => 204,
            Attributes::NAME => 'Sint Maarten',
        ]);
        $this->insert([
            Attributes::ID => 205,
            Attributes::NAME => 'Slovakia'
        ]);

        $this->insert([
            Attributes::ID => 206,
            Attributes::NAME => 'Slovenia',
        ]);

        $this->insert([
            Attributes::ID => 207,
            Attributes::NAME => 'Solomon Islands',
        ]);

        $this->insert([
            Attributes::ID => 208,
            Attributes::NAME => 'Somalia',
        ]);

        $this->insert([
            Attributes::ID => 209,
            Attributes::NAME => 'South Africa',
        ]);

        $this->insert([
            Attributes::ID => 210,
            Attributes::NAME => 'South Georgia and the South Sandwich Islands',
        ]);

        $this->insert([
            Attributes::ID => 211,
            Attributes::NAME => 'South Sudan',
        ]);

        $this->insert([
            Attributes::ID => 212,
            Attributes::NAME => 'Spain and Canary Islands',
        ]);

        $this->insert([
            Attributes::ID => 213,
            Attributes::NAME => 'Sri Lanka',
        ]);

        $this->insert([
            Attributes::ID => 214,
            Attributes::NAME => 'Sudan',
        ]);
        $this->insert([
            Attributes::ID => 215,
            Attributes::NAME => 'Suriname',
        ]);
        $this->insert([
            Attributes::ID => 216,
            Attributes::NAME => 'Svalbard & Jan Mayen Island',
        ]);
        $this->insert([
            Attributes::ID => 217,
            Attributes::NAME => 'Eswatini',
        ]);
        $this->insert([
            Attributes::ID => 218,
            Attributes::NAME => 'Sweden',
        ]);
        $this->insert([
            Attributes::ID => 219,
            Attributes::NAME => 'Switzerland',
        ]);
        $this->insert([
            Attributes::ID => 220,
            Attributes::NAME => 'Syrian Arab Republic',
        ]);
        $this->insert([
            Attributes::ID => 221,
            Attributes::NAME => 'Taiwan',
        ]);
        $this->insert([
            Attributes::ID => 222,
            Attributes::NAME => 'Tajikistan',
        ]);
        $this->insert([
            Attributes::ID => 223,
            Attributes::NAME => 'United Republic of Tanzania',
        ]);
        $this->insert([
            Attributes::ID => 224,
            Attributes::NAME => 'Thailand',
        ]);
        $this->insert([
            Attributes::ID => 225,
            Attributes::NAME => 'East Timor',
        ]);
        $this->insert([
            Attributes::ID => 226,
            Attributes::NAME => 'Togo',
        ]);
        $this->insert([
            Attributes::ID => 227,
            Attributes::NAME => 'Tokelau',
        ]);
        $this->insert([
            Attributes::ID => 228,
            Attributes::NAME => 'Tonga',
        ]);
        $this->insert([
            Attributes::ID => 229,
            Attributes::NAME => 'Trinidad and Tobago',
        ]);
        $this->insert([
            Attributes::ID => 230,
            Attributes::NAME => 'Tunisia',
        ]);
        $this->insert([
            Attributes::ID => 231,
            Attributes::NAME => 'Turkey',
        ]);
        $this->insert([
            Attributes::ID => 232,
            Attributes::NAME => 'Turkmenistan',
        ]);
        $this->insert([
            Attributes::ID => 233,
            Attributes::NAME => 'Turks and Caicos Islands',
        ]);
        $this->insert([
            Attributes::ID => 234,
            Attributes::NAME => 'Tuvalu',
        ]);
        $this->insert([
            Attributes::ID => 235,
            Attributes::NAME => 'Uganda',
        ]);
        $this->insert([
            Attributes::ID => 236,
            Attributes::NAME => 'Ukraine',
        ]);
        $this->insert([
            Attributes::ID => 237,
            Attributes::NAME => 'United Arab Emirates',
        ]);
        $this->insert([
            Attributes::ID => 238,
            Attributes::NAME => 'United Kingdom',
        ]);
        $this->insert([
            Attributes::ID => 239,
            Attributes::NAME => 'United States',
        ]);
        $this->insert([
            Attributes::ID => 240,
            Attributes::NAME => 'US Minor Outlying Islands',
        ]);
        $this->insert([
            Attributes::ID => 241,
            Attributes::NAME => 'Uruguay',
        ]);
        $this->insert([
            Attributes::ID => 242,
            Attributes::NAME => 'Uzbekistan',
        ]);
        $this->insert([
            Attributes::ID => 243,
            Attributes::NAME => 'Vanuatu',
        ]);
        $this->insert([
            Attributes::ID => 244,
            Attributes::NAME => 'Venezuela',
        ]);
        $this->insert([
            Attributes::ID => 245,
            Attributes::NAME => 'Viet Nam',
        ]);
        $this->insert([
            Attributes::ID => 246,
            Attributes::NAME => 'British Virgin Islands',
        ]);
        $this->insert([
            Attributes::ID => 247,
            Attributes::NAME => 'U.S. Virgin Islands',
        ]);
        $this->insert([
            Attributes::ID => 248,
            Attributes::NAME => 'Wallis and Futuna',
        ]);
        $this->insert([
            Attributes::ID => 249,
            Attributes::NAME => 'Western Sahara',
        ]);
        $this->insert([
            Attributes::ID => 250,
            Attributes::NAME => 'Republic of Yemen'
        ]);
        $this->insert([
            Attributes::ID => 251,
            Attributes::NAME => 'Zambia'
        ]);
        $this->insert([
            Attributes::ID => 252,
            Attributes::NAME => 'Zimbabwe'
        ]);

    }

    function insert($data)
    {
        Country::createOrUpdate(
            $data, [Attributes::ID]);
    }
}
