<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_address', function (Blueprint $table) {
            $table->unsignedBigInteger('cod_client');
            $table->unsignedBigInteger('cod_address');

            $table->foreign('cod_client')->references('clie_id')->on('client');
            $table->foreign('cod_address')->references('addr_id')->on('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_address');
    }
}
