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
            //
            Schema::table(Tables::ELITE_SERVICES, function (Blueprint $table) {
                $table->string(Attributes::OFFLINE_PAYMENT_METHOD)->nullable();
                $table->string(Attributes::PAYMENT_NOTES)->nullable();
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
            //
            Schema::table(Tables::ELITE_SERVICES, function (Blueprint $table) {
                $table->dropColumn(Attributes::OFFLINE_PAYMENT_METHOD);
                $table->dropColumn(Attributes::PAYMENT_NOTES);
            });
        }
    }
};
