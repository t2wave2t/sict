<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DotnhapdiemModels extends Model
{
    protected $table ='dotnhapdiem';
    protected $fillable = [
        'tendot',
        'ngaybatdau',
        'ngayketthuc',
        'idlop',
        'trongso',
        'namhoc',
        'hocky',
        'trangthai'
    ];
}
