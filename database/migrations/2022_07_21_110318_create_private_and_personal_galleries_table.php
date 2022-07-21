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
        Schema::create(Tables::PRIVATE_AND_PERSONAL_GALLERY, function (Blueprint $table) {
            $table->bigIncrements(Attributes::ID);
            $table->string(Attributes::IMAGE)->nullable();
            $table->string(Attributes::CAPTION)->nullable();
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
        Schema::dropIfExists(Tables::PRIVATE_AND_PERSONAL_GALLERY);
    }
};
