<?php

namespace App\Models;

use CodeIgniter\Model;

class LevelModel extends Model
{
    protected $table = "tbl_level";
    protected $primaryKey = 'id';
    protected $allowedFields = ['level_no', 'level_name', 'create_date', 'status'];

    protected $returnType    = \App\Entities\Level::class;
}
