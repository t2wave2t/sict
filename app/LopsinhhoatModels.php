<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LopsinhhoatModels extends Model
{
    protected $table ='table_lopsh';
    protected $fillable = [
        'tenlop',
        'gv_id',
        'soluong',
        'khoahoc_id',
        'ghichu',
        'trangthai'
    ];
}
