<?php

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(Tables::AIRPORTS)) {
            Schema::create(Tables::AIRPORTS, function (Blueprint $table) {
                $table->bigIncrements(Attributes::ID);
                $table->string(Attributes::NAME)->nullable();
                $table->integer(Attributes::COUNTRY_ID)->nullable();
                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists(Tables::AIRPORTS);
    }
}
