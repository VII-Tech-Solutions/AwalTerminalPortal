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
        Schema::table(Tables::GENERAL_AVIATION_CONTENT, function (Blueprint $table) {
            $table->string(Attributes::SECTION_TYPE)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Tables::GENERAL_AVIATION_CONTENT, function (Blueprint $table) {
            $table->dropColumn(Attributes::SECTION_TYPE);
        });
    }
};
