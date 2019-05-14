<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiangvienModels extends Model
{
    protected $table ='table_giangvien';
    protected $fillable = [
        'ma_gv',
        'hodem',
        'ten',
        'username',
        'ngaysinh',
        'phone',
        'chucdanh',
    ];
}
