<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableDiemdanh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_diemdanh', function (Blueprint $table) {
            $table->increments('id');
            $table->string('masv');
            $table->integer('idlop');
            $table->dateTime('ngaynghi');
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
        Schema::dropIfExists('table_diemdanh');
    }
}
