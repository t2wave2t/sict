<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LophocphanModels extends Model
{
    protected $table ='table_lophocphan';
    protected $fillable = [
        'malop',
        'tenlop',
        'id_hocphan',
        'soluong',
        'id_gv',
        'lhp_id',
        'tuan',
        'thu',
        'tiet',
        'phong',
        'namhoc',
        'hocky',
        'hocphi_hocmoi',
        'hocphi_hoclai',
        'ghichu',
        'trangthai',
        'sent',
        'thoigiannhapdiem'
    ];
}
