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
        Schema::table(Tables::HOMEPAGE_CONTENT, function (Blueprint $table) {
            $table->string(Attributes::SECTION_TYPE)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Tables::HOMEPAGE_CONTENT, function (Blueprint $table) {
            $table->integer(Attributes::SECTION_TYPE)->change();
        });
    }
};
