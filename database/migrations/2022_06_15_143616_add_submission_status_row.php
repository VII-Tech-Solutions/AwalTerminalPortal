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
        if (Schema::hasTable(Tables::ELITE_SERVICES)) {


            if (!Schema::hasColumn(Tables::ELITE_SERVICES, Attributes::SUBMISSION_STATUS_ID)) {
                Schema::table(Tables::ELITE_SERVICES, function (Blueprint $table) {
                    $table->string(Attributes::SUBMISSION_STATUS_ID)->nullable();
                });
            }
            Schema::table(Tables::ELITE_SERVICES, function (Blueprint $table) {
                if (Schema::hasColumn(Tables::ELITE_SERVICES, Attributes::PASSENGER)) {
                    $table->dropColumn(Attributes::PASSENGER);
                }
            });
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
        if (Schema::hasTable(Tables::ELITE_SERVICES)) {

            if (Schema::hasColumn(Tables::ELITE_SERVICES, Attributes::SUBMISSION_STATUS_ID)) {
                Schema::table(Tables::ELITE_SERVICES, function (Blueprint $table) {
                    $table->dropColumn(Attributes::SUBMISSION_STATUS_ID);
                });
            }

            if (!Schema::hasColumn(Tables::ELITE_SERVICES, Attributes::PASSENGER)) {
                Schema::table(Tables::ELITE_SERVICES, function (Blueprint $table) {
                    $table->string(Attributes::PASSENGER);
                });
            }
        }
    }
};
