<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NamhocModels extends Model
{
    protected $table ='table_namhoc_hocky';
    protected $fillable = [
        'nambatdau',
        'namketthuc',
        'hocky',
        'hienhanh',
        'trangthai'
   ];
}

