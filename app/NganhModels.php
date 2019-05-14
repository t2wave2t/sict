<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NganhModels extends Model
{
    protected $table ='nganh';
    protected $fillable = [
        'manganh',
        'tennganh',
        'mota',
        'trangthai'
    ];
}
