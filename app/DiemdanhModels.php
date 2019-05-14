<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiemdanhModels extends Model
{
    protected $table ='table_diemdanh';
    protected $fillable = [
        'masv',
        'idlop',
        'ngaynghi',
        'ghichu',
        'trangthai'
    ];
}
