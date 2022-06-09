<?php

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(Tables::ABOUT_US)){
            Schema::create(Tables::ABOUT_US, function (Blueprint $table) {
                $table->bigIncrements(Attributes::ID);
                $table->string(Attributes::TITLE)->nullable();
                $table->longText(Attributes::DESCRIPTION)->nullable();
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
        Schema::dropIfExists(Tables::ABOUT_US);
    }
}
