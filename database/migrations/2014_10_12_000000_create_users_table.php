<?php

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(Tables::USERS)){
            Schema::create(Tables::USERS, function (Blueprint $table) {
                $table->bigIncrements(Attributes::ID);
                $table->string(Attributes::NAME);
                $table->string(Attributes::EMAIL);
                $table->timestamp(Attributes::EMAIL_VERIFIED_AT)->nullable();
                $table->string(Attributes::PASSWORD);
                $table->integer(Attributes::STATUS)->nullable();
                $table->integer(Attributes::USER_TYPE)->nullable();
                $table->rememberToken();
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
        Schema::dropIfExists(Tables::USERS);
    }
}
