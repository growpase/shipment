<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $UserModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function register()
    {
        if (!$this->UserModel->validate($_POST)) {
            $errors = $this->UserModel->errors();
            return $this->response->setJSON(['status' => false, 'errors' =>  $errors]);
        } else {

            $user = new \App\Entities\User($_POST);
            $user->password = $_POST['password'];
            $_POST['password'] = $user->password;
            $_POST['created_at'] = date('Y-m-d');
            $_POST['is_active'] = false;

            $userInsert = $this->UserModel->insert($_POST); // default insert function to store record without model

            if ($userInsert > 0) {
                return $this->response->setJSON(['status' => true, 'message' => 'User Registered Successfully']);
            } else {
                return $this->response->setJSON(['status' => false, 'message' => 'Something Went Wrong']);
            }
        }
    }

    public function edituser($id)
    {
        $data = $this->UserModel->find($id);
        echo json_encode($data);
    }


    public function updateuser()
    {
        if (!$this->UserModel->setValidationForUpdate($_POST)) {
            $errors = $this->UserModel->errors();
            return $this->response->setJSON(['status' => false, 'errors' =>  $errors]);
        } else {
            $update = $this->UserModel->save($_POST);
            if ($update > 0) {
                return $this->response->setJSON(['status' => true, 'message' => 'User Update Successfully']);
            } else {
                return $this->response->setJSON(['status' => false, 'message' => 'Something Went Wrong']);
            }
        }
    }

    public function deleteuser($id)
    {
        $data = $this->UserModel->delete($id);
        echo json_encode(['status' => true, 'message' =>  $data]);
    }

    public function updatestatus()
    {
        // Get the ID and status from the POST request
        $userId = $this->request->getPost('id');
        $status = $this->request->getPost('status');

        // Validate the inputs
        if (empty($userId) || !is_numeric($status)) {
            return $this->response->setJSON(['status' => false, 'message' => 'Invalid data']);
        }

        // Update the status in the database
        $userModel = new \App\Models\UserModel(); // Adjust according to your model
        $update = $userModel->update($userId, ['is_active' => $status]);

        if ($update) {
            return $this->response->setJSON(['status' => true, 'message' => 'Status updated successfully']);
        } else {
            return $this->response->setJSON(['status' => false, 'message' => 'Failed to update status']);
        }
    }
}
