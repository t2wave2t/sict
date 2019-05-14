<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableLopsh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_lopsh', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tenlop');
            $table->string('gv_id');
            $table->integer('khoahoc_id');
            $table->text('ghichu');
            $table->boolean('trangthai');
            $table->rememberToken();
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
        Schema::dropIfExists('table_lopsh');
    }
}
