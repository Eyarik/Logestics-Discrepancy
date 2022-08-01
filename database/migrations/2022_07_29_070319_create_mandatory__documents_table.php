<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMandatoryDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mandatory__documents', function (Blueprint $table) {
            $table->id();
            $table->integer('comertial_invoice_original');
            $table->integer('comertial_invoice_copy');
            $table->integer('packing_list_original');
            $table->integer('packing_list_copy');
            $table->integer('cirtificate_of_origin_original');
            $table->integer('cirtificate_of_origin_copy');
            $table->integer('bill_of_loading_original');
            $table->integer('bill_of_loading_copy');
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
        Schema::dropIfExists('mandatory__documents');
    }
}
