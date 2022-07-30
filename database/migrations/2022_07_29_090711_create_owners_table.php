<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->string('client_name', 50)->nullable();
            $table->string('address', 50)->nullable();
            $table->string('tin_number', 50)->nullable();
            $table->string('attn_name', 50)->nullable();
            $table->string('attn_phone_number', 50)->nullable();
            $table->string('attn_email', 50)->nullable();
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
        Schema::dropIfExists('owners');
    }
}
