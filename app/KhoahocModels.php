<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhoahocModels extends Model
{
    protected $table ='khoahoc';
    protected $fillable = [
        'khoahoc',
        'trangthai'
    ];
}
