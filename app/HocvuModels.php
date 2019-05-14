<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HocvuModels extends Model
{
    protected $table ='table_hocvu';
    protected $fillable = [
        'masv',
        'namhoc',
        'hocky',
        'diemTB4',
        'diemTB10',
        'diemHB',
        'diemTL4',
        'diemTL10',
        'soTCDK',
        'soTCMoi',
        'soTCTLhocki',
        'soTCTL',
        'xeploai',
        'trangthai'
    ];
}
