<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SinhvienModels extends Model
{
    protected $table ='table_sinhvien';
    protected $fillable = [
        'masv',
        'hodem',
        'ten',
        'ngaysinh',
        'khoahoc_id',
        'lopsh_id',
        'nganh_id',
        'ctdt_id',
        'trangthai'
    ];
}
