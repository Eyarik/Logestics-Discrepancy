<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pis', function (Blueprint $table) {
            $table->id();
            $table->string('part_number');
            $table->text('item_description');
            $table->string('hs_code');
            $table->string('uom');
            $table->string('qty');
            $table->string('usd_unit_price');
            $table->string('total_line_price');
            $table->unsignedBigInteger('item_id')->nullable()->index('IXFK_Pi_Item');

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
        Schema::dropIfExists('pis');
    }
}
