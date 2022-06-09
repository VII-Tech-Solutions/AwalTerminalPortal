<?php

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(Tables::SERVICES)){
            Schema::create(Tables::SERVICES, function (Blueprint $table) {
                $table->bigIncrements(Attributes::ID);
                $table->string(Attributes::TITLE)->nullable();
                $table->longText(Attributes::DESCRIPTION)->nullable();
                $table->string(Attributes::SERVICE_TYPE)->nullable();
                $table->double(Attributes::PRICE)->nullable();
                $table->longText(Attributes::IMAGE)->nullable();
                $table->string(Attributes::STATUS)->nullable();
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
        Schema::dropIfExists(Tables::SERVICES);
    }
}
