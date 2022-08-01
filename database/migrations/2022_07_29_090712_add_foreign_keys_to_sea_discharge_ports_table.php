<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSeaDischargePortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sea_discharge_ports', function (Blueprint $table) {
            $table->foreign(['origin_id'], 'FK_Sea_discharge_port_Origins')->references(['id'])->on('origins')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sea_discharge_ports', function (Blueprint $table) {
            $table->dropForeign('FK_Sea_discharge_port_Origins');
        });
    }
}
