<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableGiangvien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_giangvien', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_gv');
            $table->string('hodem');
            $table->string('ten');
            $table->string('username');
            $table->string('password');
            $table->datetime('ngaysinh');
            $table->string('phone');
            $table->string('chucdanh');
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
        Schema::dropIfExists('table_giangvien');
    }
}
