<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsigneesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consignees', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('bank_name', 500)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('tf_number', 100)->nullable();
            $table->string('permit_number', 100)->nullable();
            $table->boolean('isDeleted')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consignees');
    }
}
