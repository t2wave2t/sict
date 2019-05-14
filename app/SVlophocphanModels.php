<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SVlophocphanModels extends Model
{
    protected $table ='table_svlophocphan';
    protected $fillable = [
        'idlop',
        'masv',
        'diem',
        'diemt4',
        'diemt10',
        'diemchu',
        'namhoc',
        'hocky',
        'lanhoc',
        'thoigiandk',
        'trangthai',
        'remember_token'
    ];
}
