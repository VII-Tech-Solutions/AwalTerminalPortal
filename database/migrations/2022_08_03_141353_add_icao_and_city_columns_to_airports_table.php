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
        Schema::table(Tables::AIRPORTS, function (Blueprint $table) {
            //
            $table->string(Attributes::ICAO)->nullable();
            $table->string(Attributes::CITY)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Tables::AIRPORTS, function (Blueprint $table) {
            //
            $table->dropColumn(Attributes::ICAO);
            $table->dropColumn(Attributes::CITY);

        });
    }
};
