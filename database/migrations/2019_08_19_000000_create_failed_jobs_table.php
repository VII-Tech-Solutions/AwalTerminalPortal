<?php

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFailedJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(Tables::FAILED_JOBS)){
            Schema::create(Tables::FAILED_JOBS, function (Blueprint $table) {
                $table->bigIncrements(Attributes::ID);
                $table->text(Attributes::CONNECTION);
                $table->text(Attributes::QUEUE);
                $table->longText(Attributes::PAYLOAD);
                $table->longText(Attributes::EXCEPTION);
                $table->timestamp(Attributes::FAILED_AT)->useCurrent();
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
        Schema::dropIfExists(Tables::FAILED_JOBS);
    }
}
