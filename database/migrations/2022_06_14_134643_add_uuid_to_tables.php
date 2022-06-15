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
        if(!Schema::hasColumn(Tables::ELITE_SERVICES, Attributes::UUID)){
            Schema::table(Tables::ELITE_SERVICES, function (Blueprint $table) {
                $table->string(Attributes::UUID)->nullable();
            });
        }
        if(!Schema::hasColumn(Tables::GA, Attributes::UUID)){
            Schema::table(Tables::GA, function (Blueprint $table) {
                $table->string(Attributes::UUID)->nullable();
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
        if (Schema::hasTable(Tables::ELITE_SERVICES)) {

            if (Schema::hasColumn(Tables::ELITE_SERVICES, Attributes::UUID)) {
                Schema::table(Tables::ELITE_SERVICES, function (Blueprint $table) {
                    $table->dropColumn(Attributes::UUID);
                });
            }
            if (Schema::hasColumn(Tables::GA, Attributes::UUID)) {
                Schema::table(Tables::GA, function (Blueprint $table) {
                    $table->dropColumn(Attributes::UUID);
                });
            }
        }
    }
};
