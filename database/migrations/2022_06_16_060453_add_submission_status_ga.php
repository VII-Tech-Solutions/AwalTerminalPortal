<?php

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (Schema::hasTable(Tables::GA)) {
            if (!Schema::hasColumn(Tables::GA, Attributes::SUBMISSION_STATUS_ID)) {
                Schema::table(Tables::GA, function (Blueprint $table) {
                    $table->string(Attributes::SUBMISSION_STATUS_ID)->nullable();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        if (Schema::hasTable(Tables::GA)) {

            if (Schema::hasColumn(Tables::GA, Attributes::SUBMISSION_STATUS_ID)) {
                Schema::table(Tables::GA, function (Blueprint $table) {
                    $table->dropColumn(Attributes::SUBMISSION_STATUS_ID);
                });
            }
        }
    }
};
