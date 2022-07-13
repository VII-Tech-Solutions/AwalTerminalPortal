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
        Schema::create(Tables::BULLET_POINTS_CONTENT, function (Blueprint $table) {
            $table->bigIncrements(Attributes::ID);
            $table->string(Attributes::SECTION_TYPE)->nullable();
            $table->string(Attributes::TEXT)->nullable();
            $table->integer(Attributes::SECTION_CONTENT_ID)->nullable();
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
        Schema::dropIfExists(Tables::BULLET_POINTS_CONTENT);
    }
};
