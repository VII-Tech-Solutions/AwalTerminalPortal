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
        Schema::create(Tables::SERVICES_CONTENT, function (Blueprint $table) {
            $table->bigIncrements(Attributes::ID);
            $table->string(Attributes::SECTION_TYPE)->nullable();
            $table->string(Attributes::BACKGROUND_IMAGE)->nullable();
            $table->string(Attributes::HEADING_TOP)->nullable();
            $table->string(Attributes::HEADING)->nullable();
            $table->string(Attributes::SUBHEADING)->nullable();
            $table->longText(Attributes::PARAGRAPH)->nullable();
            $table->longText(Attributes::QUOTE)->nullable();
            $table->string(Attributes::IMAGE)->nullable();
            $table->string(Attributes::COLUMN_1_HEADING)->nullable();
            $table->longText(Attributes::COLUMN_1_PARAGRAPH)->nullable();
            $table->string(Attributes::COLUMN_2_HEADING)->nullable();
            $table->longText(Attributes::COLUMN_2_PARAGRAPH)->nullable();
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
        Schema::dropIfExists(Tables::SERVICES_CONTENT);
    }
};
