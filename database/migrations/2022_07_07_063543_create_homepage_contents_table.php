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
        Schema::create(Tables::HOMEPAGE_CONTENT, function (Blueprint $table) {
            $table->bigIncrements(Attributes::ID);
            $table->integer(Attributes::SECTION_TYPE)->nullable();
            $table->string(Attributes::BACKGROUND_IMAGE)->nullable();
            $table->string(Attributes::HEADING_TOP)->nullable();
            $table->string(Attributes::HEADING)->nullable();
            $table->string(Attributes::SUBHEADING)->nullable();
            $table->longText(Attributes::PARAGRAPH)->nullable();
            $table->string(Attributes::SQUARE_IMAGE)->nullable();
            $table->string(Attributes::IMAGE)->nullable();
            $table->string(Attributes::SECTION_IMAGE)->nullable();
            $table->boolean(Attributes::HAS_BULLET_POINTS)->nullable();
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
        Schema::dropIfExists(Tables::HOMEPAGE_CONTENT);
    }
};
