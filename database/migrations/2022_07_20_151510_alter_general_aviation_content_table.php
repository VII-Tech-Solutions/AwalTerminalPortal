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
            $table->dropColumn(Attributes::SECTION_TYPE);
            $table->dropColumn(Attributes::HAS_BULLET_POINTS);
            $table->renameColumn(Attributes::BACKGROUND_IMAGE, Attributes::BACKGROUND_IMAGE_1)->change();
            $table->string(Attributes::BACKGROUND_IMAGE_2)->nullable();
            $table->renameColumn(Attributes::HEADING_TOP, Attributes::HEADING_TOP_1)->change();
            $table->string(Attributes::HEADING_TOP_2)->nullable();
            $table->renameColumn(Attributes::HEADING, Attributes::HEADING_1)->change();
            $table->string(Attributes::HEADING_2)->nullable();
            $table->string(Attributes::HEADING_3)->nullable();
            $table->string(Attributes::HEADING_4)->nullable();
            $table->string(Attributes::HEADING_5)->nullable();
            $table->string(Attributes::HEADING_6)->nullable();
            $table->renameColumn(Attributes::SUBHEADING, Attributes::SUBHEADING_1)->change();
            $table->renameColumn(Attributes::PARAGRAPH, Attributes::PARAGRAPH_1)->change();
            $table->longText(Attributes::PARAGRAPH_2)->nullable();
            $table->longText(Attributes::PARAGRAPH_3)->nullable();
            $table->longText(Attributes::PARAGRAPH_4)->nullable();
            $table->renameColumn(Attributes::SQUARE_IMAGE, Attributes::SQUARE_IMAGE_1)->nullable();
            $table->string(Attributes::SQUARE_IMAGE_2)->nullable();
            $table->renameColumn(Attributes::SECTION_IMAGE, Attributes::SECTION_IMAGE_1)->nullable();
            $table->renameColumn(Attributes::IMAGE, Attributes::IMAGE_1)->change();
            $table->renameColumn(Attributes::TEXT, Attributes::TEXT_1)->nullable();
            $table->string(Attributes::BULLET_POINT_1)->nullable();
            $table->string(Attributes::BULLET_POINT_2)->nullable();
            $table->string(Attributes::BULLET_POINT_3)->nullable();
            $table->string(Attributes::BULLET_POINT_4)->nullable();
            $table->string(Attributes::BULLET_POINT_5)->nullable();
            $table->string(Attributes::BULLET_POINT_6)->nullable();
            $table->renameColumn(Attributes::BIG_IMAGE, Attributes::BIG_IMAGE_1)->nullable();

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
            $table->string(Attributes::SECTION_TYPE);
            $table->boolean(Attributes::HAS_BULLET_POINTS);
            $table->renameColumn(Attributes::BACKGROUND_IMAGE_1, Attributes::BACKGROUND_IMAGE)->change();
            $table->dropColumn(Attributes::BACKGROUND_IMAGE_2);
            $table->renameColumn(Attributes::HEADING_TOP_1, Attributes::HEADING_TOP)->change();
            $table->dropColumn(Attributes::HEADING_TOP_2);
            $table->renameColumn(Attributes::HEADING_1, Attributes::HEADING)->change();
            $table->dropColumn(Attributes::HEADING_2);
            $table->dropColumn(Attributes::HEADING_3);
            $table->dropColumn(Attributes::HEADING_4);
            $table->dropColumn(Attributes::HEADING_5);
            $table->dropColumn(Attributes::HEADING_6);
            $table->renameColumn(Attributes::SUBHEADING_1, Attributes::SUBHEADING)->change();
            $table->renameColumn(Attributes::PARAGRAPH_1, Attributes::PARAGRAPH)->change();
            $table->dropColumn(Attributes::PARAGRAPH_2);
            $table->dropColumn(Attributes::PARAGRAPH_3);
            $table->dropColumn(Attributes::PARAGRAPH_4);
            $table->renameColumn(Attributes::SQUARE_IMAGE_1, Attributes::SQUARE_IMAGE)->nullable();
            $table->dropColumn(Attributes::SQUARE_IMAGE_2);
            $table->renameColumn(Attributes::SECTION_IMAGE_1, Attributes::SECTION_IMAGE)->nullable();
            $table->renameColumn(Attributes::IMAGE_1, Attributes::IMAGE)->change();
            $table->renameColumn(Attributes::TEXT_1, Attributes::TEXT);
            $table->dropColumn(Attributes::BULLET_POINT_1);
            $table->dropColumn(Attributes::BULLET_POINT_2);
            $table->dropColumn(Attributes::BULLET_POINT_3);
            $table->dropColumn(Attributes::BULLET_POINT_4);
            $table->dropColumn(Attributes::BULLET_POINT_5);
            $table->dropColumn(Attributes::BULLET_POINT_6);
            $table->renameColumn(Attributes::BIG_IMAGE_1, Attributes::BIG_IMAGE);

        });
    }
};
