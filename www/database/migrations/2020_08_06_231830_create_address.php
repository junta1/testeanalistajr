<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->bigIncrements('addr_id');
            $table->string('addr_zipcode');
            $table->string('addr_public_place');
            $table->string('addr_neighbordhood');
            $table->string('addr_complement');
            $table->string('addr_number');
            $table->string('addr_city');
            $table->string('addr_state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}
