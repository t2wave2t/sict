<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaotrinhModels extends Model
{
    protected $table ='giaotrinh';
    protected $fillable = [
        'tengiaotrinh',
        'hocphan',
        'mota',
        'link',
        'id_gv',
        'trangthai'
    ];
}
