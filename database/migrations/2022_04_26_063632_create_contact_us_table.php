<?php

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(Tables::CONTACT_US)){
            Schema::create(Tables::CONTACT_US, function (Blueprint $table) {
                $table->bigIncrements(Attributes::ID);
                $table->string(Attributes::FIRST_NAME)->nullable();
                $table->string(Attributes::LAST_NAME)->nullable();
                $table->string(Attributes::EMAIL)->nullable();
                $table->longText(Attributes::MESSAGE)->nullable();
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
        Schema::dropIfExists(Tables::CONTACT_US);
    }
}
