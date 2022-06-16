<?php

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (Schema::hasTable(Tables::ELITE_SERVICES)) {

            if (Schema::hasColumn(Tables::ELITE_SERVICES, Attributes::DOB)) {
                Schema::table(Tables::ELITE_SERVICES, function (Blueprint $table) {
                    $table->dropColumn(Attributes::DOB);
                });
            }
            if (Schema::hasColumn(Tables::ELITE_SERVICES, Attributes::FLIGHT_CLASS)) {
                Schema::table(Tables::ELITE_SERVICES, function (Blueprint $table) {
                    $table->dropColumn(Attributes::FLIGHT_CLASS);
                });
            }

            if (Schema::hasColumn(Tables::ELITE_SERVICES, Attributes::NATIONALITY)) {
                Schema::table(Tables::ELITE_SERVICES, function (Blueprint $table) {
                    $table->dropColumn(Attributes::NATIONALITY);
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
        if (Schema::hasTable(Tables::ELITE_SERVICES)) {
            if (!Schema::hasColumn(Tables::ELITE_SERVICES, Attributes::DOB)) {
                Schema::table(Tables::ELITE_SERVICES, function (Blueprint $table) {
                    $table->string(Attributes::DOB)->nullable();
                });
            }

            if (!Schema::hasColumn(Tables::ELITE_SERVICES, Attributes::FLIGHT_CLASS)) {
                Schema::table(Tables::ELITE_SERVICES, function (Blueprint $table) {
                    $table->string(Attributes::FLIGHT_CLASS)->nullable();
                });
            }

            if (!Schema::hasColumn(Tables::ELITE_SERVICES, Attributes::NATIONALITY)) {
                Schema::table(Tables::ELITE_SERVICES, function (Blueprint $table) {
                    $table->string(Attributes::NATIONALITY)->nullable();
                });
            }
        }
    }
};
