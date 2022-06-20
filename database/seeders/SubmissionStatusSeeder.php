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
        ], [Attributes::ID]);

        SubmissionStatus::createOrUpdate([
            Attributes::ID => 2,
            Attributes::NAME => "Rejected"
        ], [Attributes::ID]);

        SubmissionStatus::createOrUpdate([
            Attributes::ID => 3,
            Attributes::NAME => "Approved"
        ], [Attributes::ID]);

        SubmissionStatus::createOrUpdate([
            Attributes::ID => 4,
            Attributes::NAME => "Paid"
        ], [Attributes::ID]);

    }
}
