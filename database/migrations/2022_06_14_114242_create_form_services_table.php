<?php

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Tables::FORM_SERVICES, function (Blueprint $table) {
            $table->id();
            $table->string(Attributes::NAME)->nullable();
            $table->string(Attributes::HOTEL_NAME)->nullable();
            $table->string(Attributes::TIME)->nullable();
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
        Schema::dropIfExists(Tables::FORM_SERVICES);
    }
};
