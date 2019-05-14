<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableSVlophocphan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_SVlophocphan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idlop');
            $table->string('masv');
            $table->double('diem',2);
            $table->string('namhoc');
            $table->string('hocky');
            $table->string('lanhoc');
            $table->datetime('thoigiandk');
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
        Schema::dropIfExists('table_SVlophocphan');
    }
}
