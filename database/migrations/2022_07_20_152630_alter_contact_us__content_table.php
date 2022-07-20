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
        Schema::table(Tables::CONTACT_US_CONTENT, function(Blueprint $table) {
            $table->dropColumn(Attributes::SECTION_TYPE);
            $table->renameColumn(Attributes::BACKGROUND_IMAGE, Attributes::BACKGROUND_IMAGE_1)->change();
            $table->renameColumn(Attributes::HEADING_TOP, Attributes::HEADING_TOP_1)->change();
            $table->renameColumn(Attributes::HEADING, Attributes::HEADING_1)->change();
            $table->string(Attributes::HEADING_2)->nullable();
            $table->renameColumn(Attributes::SUBHEADING, Attributes::SUBHEADING_1)->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Tables::CONTACT_US_CONTENT, function(Blueprint $table) {
            $table->string(Attributes::SECTION_TYPE);
            $table->renameColumn(Attributes::BACKGROUND_IMAGE_1, Attributes::BACKGROUND_IMAGE)->change();
            $table->renameColumn(Attributes::HEADING_TOP_1, Attributes::HEADING_TOP)->change();
            $table->renameColumn(Attributes::HEADING_1, Attributes::HEADING)->change();
            $table->dropColumn(Attributes::HEADING_2);
            $table->renameColumn(Attributes::SUBHEADING_1, Attributes::SUBHEADING)->change();

        });
    }
};
