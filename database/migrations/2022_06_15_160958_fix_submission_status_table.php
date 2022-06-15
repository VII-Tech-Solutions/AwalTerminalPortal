<?php

use App\Constants\Attributes;
use App\Constants\Tables;
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
        //
        if (!Schema::hasColumn(Tables::SUBMISSION_STATUS, 'deleted_at')) {
            Schema::table(Tables::SUBMISSION_STATUS, function (Blueprint $table) {
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
        //
        if (Schema::hasColumn(Tables::SUBMISSION_STATUS, 'deleted_at')) {
            Schema::table(Tables::SUBMISSION_STATUS, function (Blueprint $table) {
                $table->dropColumn('deleted_at');
            });
        }
    }
};
