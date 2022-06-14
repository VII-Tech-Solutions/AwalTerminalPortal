<?php

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailToBookersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(Tables::BOOKERS, function (Blueprint $table) {
            $table->string(Attributes::EMAIL)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Tables::BOOKERS, function (Blueprint $table) {
            $table->dropColumn(Attributes::EMAIL);
        });
    }
}
