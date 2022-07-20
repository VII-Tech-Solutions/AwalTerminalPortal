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
            $table->dropColumn(Attributes::HAS_BULLET_POINTS_1);
            $table->string(Attributes::BULLET_POINT_1)->nullable();
            $table->string(Attributes::BULLET_POINT_2)->nullable();
            $table->string(Attributes::BULLET_POINT_3)->nullable();
            $table->string(Attributes::BULLET_POINT_4)->nullable();
            $table->string(Attributes::BULLET_POINT_5)->nullable();
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
            $table->integer(Attributes::HAS_BULLET_POINTS_1)->default(0);
            $table->dropColumn(Attributes::BULLET_POINT_1);
            $table->dropColumn(Attributes::BULLET_POINT_2);
            $table->dropColumn(Attributes::BULLET_POINT_3);
            $table->dropColumn(Attributes::BULLET_POINT_4);
            $table->dropColumn(Attributes::BULLET_POINT_5);

        });
    }
};
