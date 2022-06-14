<?php

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEliteServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(Tables::ELITE_SERVICES)){
            Schema::create(Tables::ELITE_SERVICES, function (Blueprint $table) {
                $table->bigIncrements(Attributes::ID);
                $table->string(Attributes::FLIGHT_TYPE)->nullable();
                $table->date(Attributes::DATE)->nullable();
                $table->time(Attributes::TIME)->nullable();
                $table->string(Attributes::FLIGHT_NUMBER)->nullable();
                $table->longText(Attributes::PASSENGER,5000)->nullable();
                $table->integer(Attributes::NUMBER_OF_ADULTS)->nullable();
                $table->integer(Attributes::NUMBER_OF_CHILDREN)->nullable();
                $table->integer(Attributes::NUMBER_OF_INFANTS)->nullable();
                $table->integer(Attributes::SERVICE_TYPE)->nullable();
                $table->date(Attributes::DOB)->nullable();
                $table->string(Attributes::FLIGHT_CLASS)->nullable();
                $table->string(Attributes::NATIONALITY)->nullable();
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
        Schema::dropIfExists(Tables::ELITE_SERVICES);
    }
}
