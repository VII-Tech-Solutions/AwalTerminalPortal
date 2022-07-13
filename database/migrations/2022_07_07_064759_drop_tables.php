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
        Schema::dropIfExists(Tables::HEADER_SECTION);
        Schema::dropIfExists(Tables::FIRST_MAIN_SECTION);
        Schema::dropIfExists(Tables::SECOND_MAIN_SECTION);
        Schema::dropIfExists(Tables::MINOR_SECTION);
        Schema::dropIfExists(Tables::IMAGE_SECTION);
        Schema::dropIfExists(Tables::FOOTER_SECTION);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
