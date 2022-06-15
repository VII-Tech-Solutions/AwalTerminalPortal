<?php

namespace Database\Seeders;

use App\Constants\Attributes;
use App\Models\SubmissionStatus;
use Illuminate\Database\Seeder;

class SubmissionStatusSeeder extends Seeder
{
    public function run()
    {
        SubmissionStatus::createOrUpdate([
            Attributes::ID => 1,
            Attributes::NAME => "Pending review"
        ]);

        SubmissionStatus::createOrUpdate([
            Attributes::ID => 2,
            Attributes::NAME => "Rejected"
        ]);

        SubmissionStatus::createOrUpdate([
            Attributes::ID => 3,
            Attributes::NAME => "Approved"
        ]);

        SubmissionStatus::createOrUpdate([
            Attributes::ID => 4,
            Attributes::NAME => "Paid"
        ]);

    }
}
