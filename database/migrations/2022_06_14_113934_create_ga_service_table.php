<?php

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGAServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Tables::GA_SERVICE, function (Blueprint $table) {

            $table->id();
            $table->integer( Attributes::GENERAL_AVIATION_ID)->nullable();
            $table->integer( Attributes::SERVICE_ID)->nullable();
            $table->string( Attributes::HOTEL_NAME)->nullable();
            $table->string( Attributes::TIME)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Tables::GA_SERVICE);
    }
};
