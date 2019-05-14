<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrongsoModels extends Model
{
    protected $table ='table_trongso';
    protected $fillable = [
        'tentrongso',
        'matrongso',
        'trongso',
        'trangthai'
    ];
}
