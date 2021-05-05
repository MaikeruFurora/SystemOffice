<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->string("t_id",45);
            $table->string("t_date",20);
            $table->string("t_fname",20);
            $table->string("t_mname",20);
            $table->string("t_lname",20);
            $table->string("t_sname",20);
            $table->string("t_kapisanan",20);
            $table->string("t_gender",20);
            $table->string("t_distrito",45);
            $table->string("t_dcode",45)->nullable();
            $table->string("t_lokal",45);
            $table->string("t_lcode",45)->nullable();
            $table->string("t_status",5);
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
        Schema::dropIfExists('transfers');
    }
}
