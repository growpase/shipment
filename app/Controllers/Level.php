<?php

namespace App\Controllers;

use App\Models\LevelModel;

class Level extends BaseController
{
    public function save_level()
    {

        $levelModel = new LevelModel();
        // Validate input
        $rules = [
            'level_name' => 'required|min_length[3]|max_length[255]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $this->validator->getErrors()
            ]);
        } else {
            $_POST['status'] = 0;
            $_POST['create_date'] = date('Y-m-d');
            if ($levelModel->insert($_POST)) {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Level saved successfully']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save level']);
            }
        }
    }

    public function edit_level($id)
    {
        $levelModel = new LevelModel();
        $data = $levelModel->find($id);

        echo json_encode($data);
    }

    public function update_level()
    {
        $levelModel = new LevelModel();
        $update = $levelModel->save($_POST);
        if ($update > 0) {
            return $this->response->setJSON(['status' => true, 'message' => 'User Update Successfully']);
        } else {
            return $this->response->setJSON(['status' => false, 'message' => 'Something Went Wrong']);
        }
    }

    public function updatestatus()
    {
        // Get the ID and status from the POST request
        $id = $this->request->getPost('id');
        $status = $this->request->getPost('status');
       
        // Validate the inputs
        if (empty($id) || !is_numeric($status)) {
            return $this->response->setJSON(['status' => false, 'message' => 'Invalid data']);
        }
             
        // Update the status in the database
        $levelModel = new \App\Models\LevelModel(); // Adjust according to your model
        $update = $levelModel->update($id, ['status' => $status]);

        if ($update) {
            return $this->response->setJSON(['status' => true, 'message' => 'Status updated successfully']);
        } else {
            return $this->response->setJSON(['status' => false, 'message' => 'Failed to update status']);
        }
    }
}
