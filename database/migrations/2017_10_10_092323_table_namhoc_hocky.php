<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableNamhocHocky extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_namhoc_hocky', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nambatdau');
            $table->string('namkethuc');
            $table->string('hockyhienhanh');
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
        Schema::dropIfExists('table_namhoc_hocky');
    }
}
