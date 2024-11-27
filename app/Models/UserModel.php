<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table = "tbl_user";
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'ID',
        'user_role',
        'name',
        'email',
        'mobile_number',
        'password',
        'job_type',
        'region',
        'is_active',
        'is_logged_in',
        'last_login_at',
        'updated_by',
        'created_by'
    ];
    protected $searchFields = [
        'email',
        'mobile_number'
    ];

    protected $returnType    = \App\Entities\User::class;

    protected $validationRules = [
        'name'              => ['label'  => 'Name', 'rules'  => 'required|max_length[65]|min_length[2]'],
        'mobile_number'     => ['label'  => 'Mobile Number', 'rules'  => 'required|numeric|max_length[12]|min_length[10]|is_unique[tbl_user.mobile_number]'],
        'email'             => ['label'  => 'Email', 'rules'  => 'required|valid_email|is_unique[tbl_user.email]'],
        'user_role'         => ['label'  => 'Role', 'rules'  => 'required'],
    ];

    // Optional: Specify validation messages for the rules
    protected $validationMessages = [
        'name' => [
            'required' => 'Please Enter Name.'
        ],

        'mobile_number' => [
            'required' => 'Please Enter your Valid Mobile Number',
            'exact_length' => 'Mobile number should be exactly 10 digits',
            'is_unique' => 'Mobile number is already registered'
        ],
        'email' => [
            'required' => 'Enter Your Valid Email',
            'valid_email' => 'Email format is invalid',
            'is_unique' => 'Email is already registered. Please try Another one'
        ],
        'password' => [
            'required' => 'Please Set Strong Password'
        ],
        'user_role' => [
            'required' => 'Please Select Anyone Role.'
        ],
        'region' => [
            'required' => 'Please Select Region'
        ],
    ];

    //validation for update function.....
    public function setValidationForUpdate($data)
    {
        // Modify the validation rules for update
        $this->validationRules['name'] = 'required|max_length[65]|min_length[2]'; // Remove `is_unique` for updates
        $this->validationRules['email'] = 'required|valid_email'; // Remove `is_unique` for updates
        $this->validationRules['mobile_number'] = 'required|numeric|max_length[12]|min_length[10]'; // Remove `is_unique` for updates
        $this->validationRules['user_role'] = 'required'; // Remove `is_unique` for updates
        return $this->validate($data);
    }

    public function getByHandlerName($name)
    {
        $this->select("tbl_user.ID");
        $this->where('tbl_user.name', $name);
        $this->where('tbl_user.user_role', 2);
        $qry = $this->get()->getRow();
        return $qry;
    }

    public function getQuery()
    {
        $this->select("tbl_user.*,tbl_roles.ID as role_id, tbl_roles.name as role_name", false);
        $this->join("tbl_roles", "tbl_roles.ID = " . $this->table . ".user_role", 'left', false);
        $this->where('tbl_user.user_role !=', 1);
        $this->orderBy('tbl_user.ID', 'DESC');
        $qry = $this->get()->getResult();
        return $qry;
    }

    //Login Functions
    public function checkLogin($loginData = false)
    {
        $this->select("tbl_user.*,tbl_roles.ID as role_id, tbl_roles.name as role_name", false);
        $this->join("tbl_roles", "tbl_roles.ID = " . $this->table . ".user_role", 'left', false);
        $where = array(
            "tbl_user.email" => $loginData["email"],
            "tbl_user.is_active" => 1,
        );
        return $this->where($where)->first();
    }

    public function login($userId)
    {
        $user = new \App\Entities\User();
        $user->ID = $userId;
        $user->is_logged_in  = 1;
        $user->last_login_at = date('Y-m-d h:i:s', time());
        return $this->save($user);
    }

    // public function login($userId)
    // {
    //     // Debug: Check if userId is provided and valid
    //     if (!$userId || !is_numeric($userId)) {
    //         echo "Invalid user ID provided.";
    //         exit;
    //     }

    //     // Create a new User entity
    //     $user = new \App\Entities\User();

    //     // Debug: Check if the User entity was created successfully
    //     if (!$user) {
    //         echo "Failed to create User entity.";
    //         exit;
    //     }

    //     $user->ID = $userId;
    //     $user->is_logged_in = 1;

    //     // Debug: Print the timestamp before setting
    //     $timestamp = date('Y-m-d h:i:s', time());
    //     echo "Setting last_login_at to: $timestamp";
    //     $user->last_login_at = $timestamp;

    //     // Save the user and check for errors
    //     if (!$this->save($user)) {
    //         echo "Failed to save user. Errors: ";
    //         print_r($this->errors());
    //         exit;
    //     }

    //     // Debug: Indicate successful save
    //     echo "User login status updated successfully.";
    // }


    public function logout($userId)
    {

        $user = new \App\Entities\User();
        $user->ID = $userId;
        $user->is_logged_in = 0;

        $this->save($user);
    }
}
