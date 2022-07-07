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
        Schema::table(Tables::BOOKERS, function (Blueprint $table) {
            $table->longText(Attributes::COMMENTS)->nullable()->change();
        });
        Schema::table(Tables::ELITE_SERVICES_FEATURES, function (Blueprint $table) {
            $table->longText(Attributes::FEATURE_DETAILS)->nullable()->change();
        });
        Schema::table(Tables::ELITE_SERVICES, function (Blueprint $table) {
            $table->longText(Attributes::REJECTION_REASON)->nullable()->change();
            $table->longText(Attributes::PAYMENT_NOTES)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Tables::BOOKERS, function (Blueprint $table) {
            $table->string(Attributes::COMMENTS)->nullable()->change();
        });
        Schema::table(Tables::ELITE_SERVICES_FEATURES, function (Blueprint $table) {
            $table->string(Attributes::FEATURE_DETAILS)->nullable()->change();
        });
        Schema::table(Tables::ELITE_SERVICES, function (Blueprint $table) {
            $table->string(Attributes::REJECTION_REASON)->nullable()->change();
            $table->string(Attributes::PAYMENT_NOTES)->nullable()->change();
        });
    }
};
