<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HocphanModels extends Model
{
    protected $table ='table_hocphan';
    protected $fillable = [
        'mahocphan',
        'tenhocphan',
        'id_hocphan',
        'soTC',
        'trangthai'
    ];
}
