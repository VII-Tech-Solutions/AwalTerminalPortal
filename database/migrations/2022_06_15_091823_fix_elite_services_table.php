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
        //
        if(Schema::hasTable(Tables::ELITE_SERVICES)){
            Schema::table(Tables::ELITE_SERVICES, function (Blueprint $table) {
                $table->string(Attributes::FLIGHT_TYPE)->nullable()->change();
                $table->integer(Attributes::SERVICE_ID)->nullable();
                $table->integer(Attributes::AIRPORT_ID)->nullable();
                $table->integer(Attributes::IS_ARRIVAL_FLIGHT)->nullable();
                $table->date(Attributes::DATE)->nullable()->change();
                $table->time(Attributes::TIME)->nullable()->change();
                $table->string(Attributes::FLIGHT_NUMBER)->nullable()->change();
                $table->integer(Attributes::NUMBER_OF_ADULTS)->nullable()->change();
                $table->integer(Attributes::NUMBER_OF_CHILDREN)->nullable()->change();
                if(Schema::hasColumn(Tables::ELITE_SERVICES, Attributes::DOB)){
                    $table->dropColumn(Attributes::DOB);
                }
                if(Schema::hasColumn(Tables::ELITE_SERVICES, Attributes::SERVICE_TYPE)){
                    $table->dropColumn(Attributes::SERVICE_TYPE);
                }
                if(Schema::hasColumn(Tables::ELITE_SERVICES, Attributes::NATIONALITY)){
                    $table->dropColumn(Attributes::NATIONALITY);
                }
                if(Schema::hasColumn(Tables::ELITE_SERVICES, Attributes::PASSENGER)){
                    $table->dropColumn(Attributes::PASSENGER);
                }
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
        //
//        Schema::dropIfExists(Tables::ELITE_SERVICES);

    }
};
