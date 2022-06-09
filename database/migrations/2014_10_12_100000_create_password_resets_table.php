<?php

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(Tables::PASSWORD_RESETS)){
            Schema::create(Tables::PASSWORD_RESETS, function (Blueprint $table) {
                $table->string(Attributes::EMAIL)->index();
                $table->string(Attributes::TOKEN);
                $table->timestamp(Attributes::CREATED_AT)->nullable();
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
        Schema::dropIfExists(Tables::PASSWORD_RESETS);
    }
}
