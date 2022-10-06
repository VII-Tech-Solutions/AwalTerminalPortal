<?php

use App\Constants\Attributes;
use App\Constants\PaymentStatus;
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
        Schema::create(Tables::ORDERS, function (Blueprint $table) {
            $table->bigIncrements(Attributes::ID);
            $table->string(Attributes::ORDER_ID)->nullable();
            $table->string(Attributes::AMOUNT)->nullable();
            $table->string(Attributes::CURRENCY)->nullable();
            $table->string(Attributes::SUCCESS_INDICATOR)->nullable();
            $table->boolean(Attributes::SESSION_CREATED)->default(false)->nullable();
            $table->longText(Attributes::SUCCESS_URL)->nullable();
            $table->longText(Attributes::ERROR_URL)->nullable();
            $table->longText(Attributes::DESCRIPTION)->nullable();
            $table->longText(Attributes::ERROR_MESSAGE)->nullable();
            $table->longText(Attributes::SESSION_VERSION)->nullable();
            $table->longText(Attributes::UID)->nullable();
            $table->longText(Attributes::CUSTOMER_PHONE_NUMBER)->nullable();
            $table->string(Attributes::GATEWAY)->nullable();
            $table->integer(Attributes::STATUS)->default(PaymentStatus::PENDING)->nullable();
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
        Schema::dropIfExists(Tables::ORDERS);
    }
};
