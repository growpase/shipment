<?php

namespace App\Models;
use CodeIgniter\Model;

class RoleModel extends Model{

    protected $table = "tbl_roles";
    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'ID,name'
    ];


    protected $validationRules = [
        'name' => [ 'label'  => 'Role', 'rules'  => 'required|max_length[45]|min_length[2]' ],
    ];

    protected $returnType = \App\Entities\Role::class;
    
    // private function getQuery(){

    //     $this->select($this->table.".*", false);
    // }

    // public function get($id = false){
        
    //     $this->getQuery();
    //     return $this->where([$this->primaryKey=>$id])->first();
    // }

    
}