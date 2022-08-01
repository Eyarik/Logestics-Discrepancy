<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsagneesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consagnees', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name', 500)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('postalCode', 200)->nullable();
            $table->string('phoneNumber', 200)->nullable();
            $table->string('tf_number', 100)->nullable();
            $table->string('lc_ref', 100)->nullable();
            $table->string('permit_number', 100)->nullable();
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
        Schema::dropIfExists('consagnees');
    }
}
