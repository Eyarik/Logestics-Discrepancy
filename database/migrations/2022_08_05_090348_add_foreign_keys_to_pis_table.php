<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pis', function (Blueprint $table) {
            $table->foreign(['item_id'], 'FK_Pi_Items')->references(['id'])->on('items')->onUpdate('CASCADE')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pis', function (Blueprint $table) {
            $table->dropForeign('FK_Pi_Items');

        });
    }
}
