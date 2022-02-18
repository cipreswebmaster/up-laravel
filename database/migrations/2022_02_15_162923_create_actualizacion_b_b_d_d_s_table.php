<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActualizacionBBDDSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actualizacion_b_b_d_d_s', function (Blueprint $table) {
            $table->id();
            $table->string("table");
            $table->string("reference");
            $table->text("previous_state");
            $table->text("new_state");
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
        Schema::dropIfExists('actualizacion_b_b_d_d_s');
    }
}
