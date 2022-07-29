<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeaDischargePortTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sea_discharge_port', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('country', 50)->nullable();
            $table->string('port_name', 50)->nullable();
            $table->string('code', 50)->nullable();
            $table->bigInteger('origin_id')->nullable()->index('IXFK_Sea_discharge_port_Origins');
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
        Schema::dropIfExists('sea_discharge_port');
    }
}
