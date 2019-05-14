<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrongsoLHPModels extends Model
{
    protected $table ='table_trongso_lhp';
    protected $fillable = [
        'id_lhp',
        'id_trongso',
        'trongso',
        'trangthai'
    ];
}
