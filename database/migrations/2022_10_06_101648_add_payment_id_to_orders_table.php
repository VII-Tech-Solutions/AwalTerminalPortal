<?php

use App\Constants\Tables;
use App\Constants\Attributes;
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
        Schema::table(Tables::ORDERS, function (Blueprint $table) {
            if(!Schema::hasColumn(Tables::ORDERS, Attributes::PAYMENT_ID)){
                $table->longText(Attributes::PAYMENT_ID)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Tables::ORDERS, function (Blueprint $table) {
            Schema::table(Tables::ORDERS, function (Blueprint $table) {
                $table->dropColumn(Attributes::PAYMENT_ID);
            });
        });
    }
};
