<?php

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(Tables::ATTACHMENTS, function (Blueprint $table) {
            //
            $table->string(Attributes::FILE_LABEL)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Tables::ATTACHMENTS, function (Blueprint $table) {
            //
            $table->dropColumn(Attributes::FILE_LABEL);
        });
    }
};
