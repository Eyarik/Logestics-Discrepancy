<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirLoadingPortTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('air_loading_port', function (Blueprint $table) {
            $table->id();
            $table->string('country', 300)->nullable();
            $table->string('port_name', 300)->nullable();
            $table->unsignedBigInteger('origin_id')->nullable()->index('IXFK_Air_loading_port_Origins');
            $table->boolean('isDeleted', 50)->nullable()->default(false);
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
        Schema::dropIfExists('air_loading_port');
    }
}
