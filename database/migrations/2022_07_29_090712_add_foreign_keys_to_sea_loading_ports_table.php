<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSeaLoadingPortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sea_loading_ports', function (Blueprint $table) {
            $table->foreign(['origin_id'], 'FK_Sea_loading_port_Origins')->references(['id'])->on('origins')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sea_loading_ports', function (Blueprint $table) {
            $table->dropForeign('FK_Sea_loading_port_Origins');
        });
    }
}
