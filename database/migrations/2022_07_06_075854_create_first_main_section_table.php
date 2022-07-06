<?php

use App\Constants\Tables;
use App\Constants\Attributes;
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
        Schema::create(Tables::FIRST_MAIN_SECTION, function (Blueprint $table) {
            $table->bigIncrements(Attributes::ID);
            $table->string(Attributes::BACKGROUND_IMAGE)->nullable();
            $table->string(Attributes::HEADING)->nullable();
            $table->string(Attributes::PARAGRAPH)->nullable();
            $table->string(Attributes::SQUARE_IMAGE)->nullable();
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
        Schema::dropIfExists(Tables::FIRST_MAIN_SECTION);
    }
};
