<?php

namespace App\Models;

use CodeIgniter\Model;

class PlannerModel extends Model
{
    protected $table = "tbl_planner";
    protected $primaryKey = 'id';
    protected $allowedFields = ['month', 'level', 'date', 'content', 'createdate'];

    public function getData($month, $level)
    {
        return $this->select('tbl_planner.*,tbl_level.level_name as levelname')
            ->where('tbl_planner.level', $level)
            ->where('tbl_planner.month', $month)
            ->join('tbl_level', 'tbl_level.id = tbl_planner.level')
            ->findAll();
    }


    public function getPlannerRow($date, $level)
    {
        return $this->select('tbl_planner.*,tbl_level.level_name as levelname')
            ->where('tbl_planner.date', $date)
            ->where('tbl_planner.level', $level)
            ->join('tbl_level', 'tbl_level.id = tbl_planner.level')
            ->get()->getRow();
    }

   
}
