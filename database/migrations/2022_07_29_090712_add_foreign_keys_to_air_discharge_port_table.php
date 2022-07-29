<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAirDischargePortTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('air_discharge_port', function (Blueprint $table) {
            $table->foreign(['origin_id'], 'FK_Air_discharge_port_Origins')->references(['id'])->on('origins')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('air_discharge_port', function (Blueprint $table) {
            $table->dropForeign('FK_Air_discharge_port_Origins');
        });
    }
}
