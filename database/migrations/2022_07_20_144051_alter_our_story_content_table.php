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
        Schema::table(Tables::OUR_STORY_CONTENT, function (Blueprint $table) {
            $table->dropColumn(Attributes::SECTION_TYPE);
            $table->renameColumn(Attributes::BACKGROUND_IMAGE, Attributes::BACKGROUND_IMAGE_1)->change();
            $table->string(Attributes::BACKGROUND_IMAGE_2)->nullable();
            $table->string(Attributes::BACKGROUND_IMAGE_3)->nullable();
            $table->renameColumn(Attributes::HEADING_TOP, Attributes::HEADING_TOP_1)->change();
            $table->string(Attributes::HEADING_TOP_2)->nullable();
            $table->renameColumn(Attributes::HEADING, Attributes::HEADING_1)->change();
            $table->string(Attributes::HEADING_2)->nullable();
            $table->string(Attributes::HEADING_3)->nullable();
            $table->string(Attributes::HEADING_4)->nullable();
            $table->string(Attributes::HEADING_5)->nullable();
            $table->string(Attributes::HEADING_6)->nullable();
            $table->renameColumn(Attributes::SUBHEADING, Attributes::SUBHEADING_1)->change();
            $table->string(Attributes::SUBHEADING_2)->nullable();
            $table->renameColumn(Attributes::PARAGRAPH, Attributes::PARAGRAPH_1)->change();
            $table->longText(Attributes::PARAGRAPH_2)->nullable();
            $table->longText(Attributes::PARAGRAPH_3)->nullable();
            $table->longText(Attributes::PARAGRAPH_4)->nullable();
            $table->string(Attributes::QUOTE_1)->nullable();
            $table->renameColumn(Attributes::IMAGE, Attributes::IMAGE_1)->change();
            $table->string(Attributes::IMAGE_2)->nullable();
            $table->renameColumn(Attributes::COLUMN_1_HEADING, Attributes::COLUMN_1_HEADING_1);
            $table->renameColumn(Attributes::COLUMN_1_PARAGRAPH, Attributes::COLUMN_1_PARAGRAPH_1);
            $table->renameColumn(Attributes::COLUMN_2_HEADING, Attributes::COLUMN_2_HEADING_1);
            $table->renameColumn(Attributes::COLUMN_2_PARAGRAPH, Attributes::COLUMN_2_PARAGRAPH_1);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Tables::HOMEPAGE_CONTENT, function(Blueprint $table) {
            $table->string(Attributes::SECTION_TYPE);
            $table->renameColumn(Attributes::BACKGROUND_IMAGE_1, Attributes::BACKGROUND_IMAGE)->change();
            $table->dropColumn(Attributes::BACKGROUND_IMAGE_2);
            $table->dropColumn(Attributes::BACKGROUND_IMAGE_3);
            $table->renameColumn(Attributes::HEADING_TOP_1, Attributes::HEADING_TOP)->change();
            $table->dropColumn(Attributes::HEADING_TOP_2);
            $table->renameColumn(Attributes::HEADING_1, Attributes::HEADING)->change();
            $table->dropColumn(Attributes::HEADING_2);
            $table->dropColumn(Attributes::HEADING_3);
            $table->dropColumn(Attributes::HEADING_4);
            $table->dropColumn(Attributes::HEADING_5);
            $table->dropColumn(Attributes::HEADING_6);
            $table->renameColumn(Attributes::SUBHEADING_1, Attributes::SUBHEADING)->change();
            $table->dropColumn(Attributes::SUBHEADING_2);
            $table->renameColumn(Attributes::PARAGRAPH_1, Attributes::PARAGRAPH)->change();
            $table->dropColumn(Attributes::PARAGRAPH_2);
            $table->dropColumn(Attributes::PARAGRAPH_3);
            $table->dropColumn(Attributes::PARAGRAPH_4);
            $table->dropColumn(Attributes::QUOTE_1);
            $table->renameColumn(Attributes::IMAGE_1, Attributes::IMAGE)->change();
            $table->dropColumn(Attributes::IMAGE_2);
            $table->renameColumn(Attributes::COLUMN_1_HEADING_1, Attributes::COLUMN_1_HEADING);
            $table->renameColumn(Attributes::COLUMN_1_PARAGRAPH_1, Attributes::COLUMN_1_PARAGRAPH);
            $table->renameColumn(Attributes::COLUMN_2_HEADING_1, Attributes::COLUMN_2_HEADING);
            $table->renameColumn(Attributes::COLUMN_2_PARAGRAPH_1, Attributes::COLUMN_2_PARAGRAPH);

        });

    }
};
