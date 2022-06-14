<?php
namespace Database\Seeders;

use App\Constants\Attributes;
use App\Constants\Tables;
use App\Models\Country;
use App\Models\FormServices;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

        db::insert("INSERT INTO `countries` (`id`, `name`) VALUES
(61, 'Denmark'),
(62, 'Djibouti'),
(63, 'Dominica'),
(64, 'Dominican Republic'),
(65, 'Ecuador'),
(66, 'Egypt'),
(67, 'El Salvador'),
(68, 'Equatorial Guinea'),
(69, 'Eritrea'),
(70, 'Estonia'),
(71, 'Ethiopia'),
(72, 'Falkland Islands (Malvinas)'),
(73, 'Faroe Islands'),
(74, 'Fiji'),
(75, 'Finland'),
(76, 'France'),
(77, 'French Guiana'),
(78, 'French Polynesia'),
(79, 'French Southern Territories'),
(80, 'Gabon'),
(81, 'Gambia'),
(82, 'Georgia'),
(83, 'Germany'),
(84, 'Ghana'),
(85, 'Gibraltar'),
(86, 'Greece'),
(87, 'Greenland'),
(88, 'Grenada'),
(89, 'Guadeloupe'),
(90, 'Guam'),
(91, 'Guatemala'),
(92, 'Guernsey'),
(93, 'Guinea'),
(94, 'Guinea-Bissau'),
(95, 'Guyana'),
(96, 'Haiti'),
(97, 'Heard Island and Mcdonald Islands'),
(98, 'Holy See (Vatican City State)'),
(99, 'Honduras'),
(100, 'Hong Kong'),
(101, 'Hungary'),
(102, 'Iceland'),
(103, 'India'),
(104, 'Indonesia'),
(105, 'Iran, Islamic Republic of'),
(106, 'Iraq'),
(107, 'Ireland'),
(108, 'Isle of Man'),
(109, 'Israel'),
(110, 'Italy'),
(111, 'Jamaica'),
(112, 'Japan'),
(113, 'Jersey'),
(114, 'Jordan'),
(115, 'Kazakhstan'),
(116, 'Kenya'),
(117, 'Kiribati'),
(118, 'Korea, Democratic Peoples Republic of'),
(119, 'Korea Republic of'),
(120, 'Kosovo'),
(121, 'Kuwait'),
(122, 'Kyrgyzstan'),
(123, 'Lao Peoples Democratic Republic'),
(124, 'Latvia'),
(125, 'Lebanon'),
(126, 'Lesotho'),
(127, 'Liberia'),
(128, 'Libyan Arab Jamahiriya'),
(129, 'Liechtenstein'),
(130, 'Lithuania'),
(131, 'Luxembourg'),
(132, 'Macao'),
(133, 'Macedonia, the Former Yugoslav Republic of'),
(134, 'Madagascar'),
(135, 'Malawi'),
(136, 'Malaysia'),
(137, 'Maldives'),
(138, 'Mali'),
(139, 'Malta'),
(140, 'Marshall Islands'),
(141, 'Martinique'),
(142, 'Mauritania'),
(143, 'Mauritius'),
(144, 'Mayotte'),
(145, 'Mexico'),
(146, 'Micronesia, Federated States of'),
(147, 'Moldova, Republic of'),
(148, 'Monaco'),
(149, 'Mongolia'),
(150, 'Montenegro'),
(151, 'Montserrat'),
(152, 'Morocco'),
(153, 'Mozambique'),
(154, 'Myanmar'),
(155, 'Namibia'),
(156, 'Nauru'),
(157, 'Nepal'),
(158, 'Netherlands'),
(159, 'Netherlands Antilles'),
(160, 'New Caledonia'),
(161, 'New Zealand'),
(162, 'Nicaragua'),
(163, 'Niger'),
(164, 'Nigeria'),
(165, 'Niue'),
(166, 'Norfolk Island'),
(167, 'Northern Mariana Islands'),
(168, 'Norway'),
(169, 'Oman'),
(170, 'Pakistan'),
(171, 'Palau'),
(172, 'Palestinian Territory, Occupied'),
(173, 'Panama'),
(174, 'Papua New Guinea'),
(175, 'Paraguay'),
(176, 'Peru'),
(177, 'Philippines'),
(178, 'Pitcairn'),
(179, 'Poland'),
(180, 'Portugal'),
(181, 'Puerto Rico'),
(182, 'Qatar'),
(183, 'Reunion'),
(184, 'Romania'),
(185, 'Russian Federation'),
(186, 'Rwanda'),
(187, 'Saint Barthelemy'),
(188, 'Saint Helena'),
(189, 'Saint Kitts and Nevis'),
(190, 'Saint Lucia'),
(191, 'Saint Martin'),
(192, 'Saint Pierre and Miquelon'),
(193, 'Saint Vincent and the Grenadines'),
(194, 'Samoa'),
(195, 'San Marino'),
(196, 'Sao Tome and Principe'),
(197, 'Saudi Arabia'),
(198, 'Senegal'),
(199, 'Serbia'),
(200, 'Serbia and Montenegro'),
(201, 'Seychelles'),
(202, 'Sierra Leone'),
(203, 'Singapore'),
(204, 'Sint Maarten'),
(205, 'Slovakia'),
(206, 'Slovenia'),
(207, 'Solomon Islands'),
(208, 'Somalia'),
(209, 'South Africa'),
(210, 'South Georgia and the South Sandwich Islands'),
(211, 'South Sudan'),
(212, 'Spain'),
(213, 'Sri Lanka'),
(214, 'Sudan'),
(215, 'Suriname'),
(216, 'Svalbard and Jan Mayen'),
(217, 'Swaziland'),
(218, 'Sweden'),
(219, 'Switzerland'),
(220, 'Syrian Arab Republic'),
(221, 'Taiwan, Province of China'),
(222, 'Tajikistan'),
(223, 'Tanzania, United Republic of'),
(224, 'Thailand'),
(225, 'Timor-Leste'),
(226, 'Togo'),
(227, 'Tokelau'),
(228, 'Tonga'),
(229, 'Trinidad and Tobago'),
(230, 'Tunisia'),
(231, 'Turkey'),
(232, 'Turkmenistan'),
(233, 'Turks and Caicos Islands'),
(234, 'Tuvalu'),
(235, 'Uganda'),
(236, 'Ukraine'),
(237, 'United Arab Emirates'),
(238, 'United Kingdom'),
(239, 'United States'),
(240, 'United States Minor Outlying Islands'),
(241, 'Uruguay'),
(242, 'Uzbekistan'),
(243, 'Vanuatu'),
(244, 'Venezuela'),
(245, 'Viet Nam'),
(246, 'Virgin Islands, British'),
(247, 'Virgin Islands, U.s.'),
(248, 'Wallis and Futuna'),
(249, 'Western Sahara'),
(250, 'Yemen'),
(251, 'Zambia'),
(252, 'Zimbabwe')"
        );

        Country::createOrUpdate([
            Attributes::ID => 1,
            Attributes::NAME => "Afghanistan"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 2,
            Attributes::NAME => "Aland Islands"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 3,
            Attributes::NAME => "Albania"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 4,
            Attributes::NAME => "Algeria"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 5,
            Attributes::NAME => "American Samoa"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 6,
            Attributes::NAME => "Andorra"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 7,
            Attributes::NAME => "Angola"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 8,
            Attributes::NAME => "Anguilla"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 9,
            Attributes::NAME => "Antarctica"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 10,
            Attributes::NAME => "Antigua and Barbuda"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 11,
            Attributes::NAME => "Argentina"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 12,
            Attributes::NAME => "Armenia"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 13,
            Attributes::NAME => "Aruba"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 14,
            Attributes::NAME => "Australia"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 15,
            Attributes::NAME => "Austria"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 16,
            Attributes::NAME => "Azerbaijan"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 17,
            Attributes::NAME => "Bahamas"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 18,
            Attributes::NAME => "Bahrain"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 19,
            Attributes::NAME => "Bangladesh"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 20,
            Attributes::NAME => "Barbados"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 21,
            Attributes::NAME => "Belarus"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 22,
            Attributes::NAME => "Belgium"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 23,
            Attributes::NAME => "Belize"
        ]);

        Country::createOrUpdate([
            Attributes::ID => 24,
            Attributes::NAME => "Benin"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 25,
            Attributes::NAME => "Bermuda"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 26,
            Attributes::NAME => "Bhutan"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 27,
            Attributes::NAME => "Bolivia"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 28,
            Attributes::NAME => "Bonaire, Sint Eustatius and Saba"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 29,
            Attributes::NAME => "Bosnia and Herzegovina"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 30,
            Attributes::NAME => "Botswana"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 31,
            Attributes::NAME => "Bouvet Island"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 32,
            Attributes::NAME => "Brazil"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 33,
            Attributes::NAME => "British Indian Ocean Territory"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 34,
            Attributes::NAME => "Brunei Darussalam"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 35,
            Attributes::NAME => "Bulgaria"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 36,
            Attributes::NAME => "Burkina Faso"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 37,
            Attributes::NAME => "Burundi"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 38,
            Attributes::NAME => "Cambodia"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 39,
            Attributes::NAME => "Cameroon"
        ]);

        Country::createOrUpdate([
            Attributes::ID => 40,
            Attributes::NAME => "Canada"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 41,
            Attributes::NAME => "Cape Verde"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 42,
            Attributes::NAME => "Cayman Islands"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 43,
            Attributes::NAME => "Central African Republic"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 44,
            Attributes::NAME => "Chad"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 45,
            Attributes::NAME => "Chile"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 46,
            Attributes::NAME => "China"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 47,
            Attributes::NAME => "Christmas Island"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 48,
            Attributes::NAME => "Cocos (Keeling) Islands"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 49,
            Attributes::NAME => "Colombia"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 50,
            Attributes::NAME => "Comoros"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 51,
            Attributes::NAME => "Congo"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 52,
            Attributes::NAME => "Congo, Democratic Republic of the Congo"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 53,
            Attributes::NAME => "Cook Islands"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 54,
            Attributes::NAME => "Costa Rica"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 55,
            Attributes::NAME => "Cote D Ivoire"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 56,
            Attributes::NAME => "Croatia"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 57,
            Attributes::NAME => "Cuba"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 58,
            Attributes::NAME => "Curacao"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 59,
            Attributes::NAME => "Cyprus"
        ]);
        Country::createOrUpdate([
            Attributes::ID => 60,
            Attributes::NAME => "Czech Republic"
        ]);

    }
}
