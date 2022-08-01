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
            $table->id();
            $table->text('item_description')->nullable();
            $table->string('project_name')->nullable();
            $table->string('item_type')->nullable();
            $table->json('PI', 50)->nullable();
            $table->unsignedBigInteger('consignee_id')->nullable()->index('IXFK_Items_Consignees');
            $table->unsignedBigInteger('air_discharge_id')->nullable()->index('IXFK_Items_Air_discharge_port');
            $table->unsignedBigInteger('sea_discharge_id')->nullable()->index('IXFK_Items_Sea_discharge_port');
            $table->unsignedBigInteger('air_loading_id')->nullable()->index('IXFK_Items_Air_loading_port');
            $table->unsignedBigInteger('sea_loading_id')->nullable()->index('IXFK_Items_Sea_loading_port');
            $table->unsignedBigInteger('bank_detail_id')->nullable()->index('IXFK_Items_Bank_details');
            $table->unsignedBigInteger('owner_id')->nullable()->index('IXFK_Items_Owners');
            $table->unsignedBigInteger('shipment_mode_id')->nullable()->index('IXFK_Items_Shipment_modes');
            $table->unsignedBigInteger('term_id')->nullable()->index('IXFK_Items_Terms');
            $table->unsignedBigInteger('mandatory_doc_id')->nullable()->index('IXFK_Items_Mandatory_Documents');
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
        Schema::dropIfExists('items');
    }
}
