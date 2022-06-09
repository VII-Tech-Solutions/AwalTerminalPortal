<?php

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(Tables::ATTACHMENTS)){
            Schema::create(Tables::ATTACHMENTS, function (Blueprint $table) {
                $table->bigIncrements(Attributes::ID);
                $table->string(Attributes::PATH)->nullable();
                $table->integer(Attributes::SERVICE_ID)->nullable();
                $table->integer(Attributes::FORM_ID)->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Tables::ATTACHMENTS);
    }
}
