<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_details', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('account_holder', 50)->nullable();
            $table->string('iban_number', 50)->nullable();
            $table->string('swift_code', 50)->nullable();
            $table->string('account_number', 50)->nullable();
            $table->string('beneficiary_bank_name', 50)->nullable();
            $table->boolean('isDeleted')->nullable()->default(false);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_details');
    }
}
