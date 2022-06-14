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
        Schema::create(Tables::TRANSACTIONS, function (Blueprint $table) {
            $table->id();
            $table->string(Attributes::ORDER_ID)->nullable();
            $table->bigInteger(Attributes::ELITE_SERVICE_ID)->nullable();
            $table->string(Attributes::AMOUNT)->nullable();
            $table->string(Attributes::CREDIMAX_SUCCESS_INDICATOR)->nullable();
            $table->integer(Attributes::PAYMENT_PROVIDER)->nullable();
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
        Schema::dropIfExists(Tables::TRANSACTIONS);
    }
};
