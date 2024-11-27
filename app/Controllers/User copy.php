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
            $_POST['password'] = md5($_POST['password']);
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
        // Get the ID and status from the POST request
        unset($_POST['newpassword']);
        unset($_POST['password']);

        // foreach ($_POST as $key => $value) {
        //     if (empty($value)) {
        //         unset($_POST[$key]);
        //     }
        // }
        // $_POST['updated_at'] = date('Y-m-d');

        // Create $data by filtering $_POST
        $data = [];
        foreach ($_POST as $key => $value) {
            if (is_string($key)) {
                // For keys with default values (e.g., 'updated_at')
                $data[$key] = $value;
            } elseif (!empty($_POST[$value])) {
                // For keys from $_POST that are non-empty
                $data[$value] = $_POST[$value];
            }
        }

        // Check what $data contains for debugging
        var_dump($data); // Optional: for debugging purposes

        exit;

        echo $update = $this->UserModel->save($data);


        exit;
        if ($update) {
            return $this->response->setJSON(['status' => true, 'message' => 'Updated Successfully']);
        } else {
            $db = \Config\Database::connect();
            $lastQuery = $db->getLastQuery();
            log_message('error', 'Failed to update status. Last Query: ' . $lastQuery);

            return $this->response->setJSON(['status' => false, 'message' => 'Failed to update status']);
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
