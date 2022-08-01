<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->foreign(['sea_discharge_id'], 'FK_Items_Sea_discharge_port')->references(['id'])->on('sea_discharge_ports')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['air_discharge_id'], 'FK_Items_Air_discharge_port')->references(['id'])->on('air_discharge_ports')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['shipment_mode_id'], 'FK_Items_Shipment_modes')->references(['id'])->on('shipment_modes')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['bank_detail_id'], 'FK_Items_Bank_details')->references(['id'])->on('bank_details')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['owner_id'], 'FK_Items_Owners')->references(['id'])->on('owners')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['sea_loading_id'], 'FK_Items_Sea_loading_port')->references(['id'])->on('sea_loading_ports')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['air_loading_id'], 'FK_Items_Air_loading_port')->references(['id'])->on('air_loading_ports')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['term_id'], 'FK_Items_Terms')->references(['id'])->on('terms')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['consignee_id'], 'FK_Items_Consignees')->references(['id'])->on('consagnees')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['mandatory_doc_id'], 'FK_Items_Mandatory_Documents')->references(['id'])->on('mandatory__documents')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign('FK_Items_Sea_discharge_port');
            $table->dropForeign('FK_Items_Air_discharge_port');
            $table->dropForeign('FK_Items_Shipment_modes');
            $table->dropForeign('FK_Items_Bank_details');
            $table->dropForeign('FK_Items_Owners');
            $table->dropForeign('FK_Items_Sea_loading_port');
            $table->dropForeign('FK_Items_Air_loading_port');
            $table->dropForeign('FK_Items_Terms');
            $table->dropForeign('FK_Items_Consignees');
        });
    }
}
