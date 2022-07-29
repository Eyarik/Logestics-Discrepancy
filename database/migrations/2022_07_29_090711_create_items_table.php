<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->text('item_description')->nullable();
            $table->string('PI', 50)->nullable();
            $table->bigInteger('consignee_id')->nullable()->index('IXFK_Items_Consignees');
            $table->bigInteger('air_discharge_id')->nullable()->index('IXFK_Items_Air_discharge_port');
            $table->bigInteger('sea_discharge_id')->nullable()->index('IXFK_Items_Sea_discharge_port');
            $table->bigInteger('air_loading_id')->nullable()->index('IXFK_Items_Air_loading_port');
            $table->bigInteger('sea_loading_id')->nullable()->index('IXFK_Items_Sea_loading_port');
            $table->bigInteger('bank_detail_id')->nullable()->index('IXFK_Items_Bank_details');
            $table->bigInteger('owner_id')->nullable()->index('IXFK_Items_Owners');
            $table->bigInteger('shipment_mode_id')->nullable()->index('IXFK_Items_Shipment_modes');
            $table->bigInteger('term_id')->nullable()->index('IXFK_Items_Terms');
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
        Schema::dropIfExists('items');
    }
}
