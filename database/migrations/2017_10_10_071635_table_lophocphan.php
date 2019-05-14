<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableLophocphan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_lophocphan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('malop');
            $table->string('tenlop');
            $table->integer('id_hocphan');
            $table->string('soluong');
            $table->integer('id_gv');
            $table->string('tuan');
            $table->string('thu');
            $table->string('tiet');
            $table->string('phong');
            $table->integer('namhoc');
            $table->integer('hocky');
            $table->double('hocphi_hocmoi',2);
            $table->double('hocphi_hoclai',2);
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
        Schema::dropIfExists('table_lophocphan');
    }
}
