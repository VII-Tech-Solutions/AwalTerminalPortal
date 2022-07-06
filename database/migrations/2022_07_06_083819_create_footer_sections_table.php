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
        Schema::create(Tables::FOOTER_SECTION, function (Blueprint $table) {
            $table->bigIncrements(Attributes::ID);
            $table->string(Attributes::BACKGROUND_IMAGE)->nullable();
            $table->string(Attributes::HEADING_TOP)->nullable();
            $table->string(Attributes::HEADING)->nullable();
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
        Schema::dropIfExists(Tables::FOOTER_SECTION);
    }
};
