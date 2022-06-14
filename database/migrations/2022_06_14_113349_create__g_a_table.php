<?php

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGATable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Tables::GA, function (Blueprint $table) {
            $table->bigIncrements(Attributes::ID);
            $table->string(Attributes::AIRCRAFT_TYPE)->nullable();
            $table->integer(Attributes::REGISTRATION_NUMBER)->nullable();
            $table->string(Attributes::MTOW)->nullable();
            $table->string(Attributes::LEAD_PASSENGER_NAME)->nullable();
            $table->string(Attributes::LANDING_PURPOSE)->nullable();
            $table->string(Attributes::ARRIVAL_CALL_SIGN)->nullable();
            $table->integer(Attributes::ARRIVING_FROM_AIRPORT)->nullable();
            $table->time(Attributes::ESTIMATED_TIME_OF_ARRIVAL)->nullable();
            $table->date(Attributes::ARRIVAL_DATE)->nullable();
            $table->string(Attributes::ARRIVAL_FLIGHT_NATURE)->nullable();
            $table->integer(Attributes::ARRIVAL_PASSENGER_COUNT)->nullable();
            $table->string(Attributes::DEPARTURE_CALL_SIGN)->nullable();
            $table->integer(Attributes::DEPARTURE_TO_AIRPORT)->nullable();
            $table->time(Attributes::ESTIMATED_TIME_OF_DEPARTURE)->nullable();
            $table->date(Attributes::DEPARTURE_DATE)->nullable();
            $table->string(Attributes::DEPARTURE_FLIGHT_NATURE)->nullable();
            $table->integer(Attributes::DEPARTURE_PASSENGER_COUNT)->nullable();
            $table->string(Attributes::OPERATOR_FULL_NAME)->nullable();
            $table->string(Attributes::OPERATOR_COUNTRY)->nullable();
            $table->string(Attributes::OPERATOR_TEL_NUMBER)->nullable();
            $table->string(Attributes::OPERATOR_EMAIL)->nullable();
            $table->string(Attributes::OPERATOR_ADDRESS)->nullable();
            $table->string(Attributes::OPERATOR_BILLING_ADDRESS)->nullable();
            $table->boolean(Attributes::IS_USING_AGENT)->nullable();
            $table->string(Attributes::AGENT_FULLNAME)->nullable();
            $table->string(Attributes::AGENT_COUNTRY)->nullable();
            $table->string(Attributes::AGENT_PHONENUMBER)->nullable();
            $table->string(Attributes::AGENT_EMAIL)->nullable();
            $table->string(Attributes::AGENT_ADDRESS)->nullable();
            $table->string(Attributes::AGENT_BILLING_ADDRESS)->nullable();
            $table->string(Attributes::TRANSPORT_HOTEL_NAME)->nullable();
            $table->time(Attributes::TRANSPORT_TIME)->nullable();
            $table->string(Attributes::REMARKS)->nullable();
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
        Schema::dropIfExists(Tables::GA);
    }
};
