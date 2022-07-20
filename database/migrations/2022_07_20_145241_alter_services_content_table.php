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
        Schema::table(Tables::SERVICES_CONTENT, function (Blueprint $table) {
            $table->dropColumn(Attributes::SECTION_TYPE);
            $table->dropColumn(Attributes::HAS_BULLET_POINTS);
            $table->renameColumn(Attributes::BACKGROUND_IMAGE, Attributes::BACKGROUND_IMAGE_1)->change();
            $table->string(Attributes::BACKGROUND_IMAGE_2)->nullable();
            $table->string(Attributes::BACKGROUND_IMAGE_3)->nullable();
            $table->renameColumn(Attributes::HEADING_TOP, Attributes::HEADING_TOP_1)->change();
            $table->string(Attributes::HEADING_TOP_2)->nullable();
            $table->renameColumn(Attributes::HEADING, Attributes::HEADING_1)->change();
            $table->string(Attributes::HEADING_2)->nullable();
            $table->string(Attributes::HEADING_3)->nullable();
            $table->string(Attributes::HEADING_4)->nullable();
            $table->renameColumn(Attributes::SUBHEADING, Attributes::SUBHEADING_1)->change();
            $table->renameColumn(Attributes::PARAGRAPH, Attributes::PARAGRAPH_1)->change();
            $table->renameColumn(Attributes::COLUMN_1_HEADING, Attributes::COLUMN_1_HEADING_1);
            $table->renameColumn(Attributes::COLUMN_1_PARAGRAPH, Attributes::COLUMN_1_PARAGRAPH_1);
            $table->renameColumn(Attributes::COLUMN_2_HEADING, Attributes::COLUMN_2_HEADING_1);
            $table->renameColumn(Attributes::COLUMN_2_PARAGRAPH, Attributes::COLUMN_2_PARAGRAPH_1);
            $table->string(Attributes::BULLET_POINT_1)->nullable();
            $table->string(Attributes::BULLET_POINT_2)->nullable();
            $table->string(Attributes::BULLET_POINT_3)->nullable();
            $table->string(Attributes::BULLET_POINT_4)->nullable();
            $table->string(Attributes::BULLET_POINT_5)->nullable();
            $table->string(Attributes::BULLET_POINT_6)->nullable();
            $table->string(Attributes::BULLET_POINT_7)->nullable();
            $table->string(Attributes::BULLET_POINT_8)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Tables::SERVICES_CONTENT, function (Blueprint $table) {
            $table->string(Attributes::SECTION_TYPE);
            $table->boolean(Attributes::HAS_BULLET_POINTS)->default(false);
            $table->renameColumn(Attributes::BACKGROUND_IMAGE_1, Attributes::BACKGROUND_IMAGE)->change();
            $table->dropColumn(Attributes::BACKGROUND_IMAGE_2);
            $table->dropColumn(Attributes::BACKGROUND_IMAGE_3);
            $table->renameColumn(Attributes::HEADING_TOP_1, Attributes::HEADING_TOP)->change();
            $table->dropColumn(Attributes::HEADING_TOP_2);
            $table->renameColumn(Attributes::HEADING_1, Attributes::HEADING)->change();
            $table->dropColumn(Attributes::HEADING_2);
            $table->dropColumn(Attributes::HEADING_3);
            $table->dropColumn(Attributes::HEADING_4);
            $table->renameColumn(Attributes::SUBHEADING_1, Attributes::SUBHEADING)->change();
            $table->renameColumn(Attributes::PARAGRAPH_1, Attributes::PARAGRAPH)->change();
            $table->renameColumn(Attributes::COLUMN_1_HEADING_1, Attributes::COLUMN_1_HEADING);
            $table->renameColumn(Attributes::COLUMN_1_PARAGRAPH_1, Attributes::COLUMN_1_PARAGRAPH);
            $table->renameColumn(Attributes::COLUMN_2_HEADING_1, Attributes::COLUMN_2_HEADING);
            $table->renameColumn(Attributes::COLUMN_2_PARAGRAPH_1, Attributes::COLUMN_2_PARAGRAPH);
            $table->dropColumn(Attributes::BULLET_POINT_1);
            $table->dropColumn(Attributes::BULLET_POINT_2);
            $table->dropColumn(Attributes::BULLET_POINT_3);
            $table->dropColumn(Attributes::BULLET_POINT_4);
            $table->dropColumn(Attributes::BULLET_POINT_5);
            $table->dropColumn(Attributes::BULLET_POINT_6);
            $table->dropColumn(Attributes::BULLET_POINT_7);
            $table->dropColumn(Attributes::BULLET_POINT_8);

        });

    }
};
