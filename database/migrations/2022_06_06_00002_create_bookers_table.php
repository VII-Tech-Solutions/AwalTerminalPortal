<?php

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(Tables::BOOKERS)) {
            Schema::create(Tables::BOOKERS, function (Blueprint $table) {
                $table->bigIncrements(Attributes::ID);
                $table->string(Attributes::FIRST_NAME)->nullable();
                $table->string(Attributes::LAST_NAME)->nullable();
                $table->string(Attributes::MOBILE_NUMBER)->nullable();
                $table->string(Attributes::COMMENTS)->nullable();
                $table->integer(Attributes::SERVICE_ID)->nullable();
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
        Schema::dropIfExists(Tables::BOOKERS);
    }
}
