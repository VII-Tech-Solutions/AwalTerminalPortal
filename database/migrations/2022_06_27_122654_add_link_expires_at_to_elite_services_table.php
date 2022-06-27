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
        Schema::table(Tables::ELITE_SERVICES, function (Blueprint $table) {
            $table->timestamp(Attributes::LINK_EXPIRES_AT)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Tables::ELITE_SERVICES, function (Blueprint $table) {
            $table->dropColumn(Attributes::LINK_EXPIRES_AT);
        });
    }
};
