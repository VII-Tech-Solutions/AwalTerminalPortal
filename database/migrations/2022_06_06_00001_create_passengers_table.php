<?php

use App\Constants\Attributes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string(Attributes::FIRST_NAME)->nullable();
            $table->string(Attributes::LAST_NAME)->nullable();
            $table->integer(Attributes::GENDER)->nullable();
            $table->date(Attributes::BIRTH_DATE)->nullable();
            $table->string(Attributes::NATIONALITY_ID)->nullable();
            $table->string(Attributes::FLIGHT_CLASS)->nullable();
            $table->integer(Attributes::SERVICE_ID)->nullable();
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
        Schema::dropIfExists('passengers');
    }
}
