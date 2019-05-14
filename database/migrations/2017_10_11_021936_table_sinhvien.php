<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableSinhvien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_sinhvien', function (Blueprint $table) {
            $table->increments('id');
            $table->string('masv');
            $table->string('hodem');
            $table->string('ten');
            $table->datetime('ngaysinh');
            $table->integer('khoahoc_id');
            $table->integer('lopsh_id');
            $table->integer('nganh_id');
            $table->integer('ctdt_id');
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
        Schema::dropIfExists('table_sinhvien');
    }
}
